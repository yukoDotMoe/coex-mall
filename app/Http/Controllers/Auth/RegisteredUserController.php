<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Factory;

class RegisteredUserController extends Controller
{
    public function __construct()
    {

        $this->firebase = (new Factory)
            ->withServiceAccount(__DIR__. '/serviceAccount.json')
            ->withDatabaseUri(config('services.firebase.database_url'))
            ->createAuth();

    }
    /**
     * Display the registration view.
     */
    public function create(Request $request)
    {

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9]+$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $referral =  $request->cookie('referral');

        $user = User::create([
            'name' => $request->username,
            'email' => $request->username,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'promo_code' => $referral
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function storeSms(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'promo_code' => ['nullable'],
            'token' => ['required']
        ]);

        try {
            $verifiedIdToken = $this->firebase->verifyIdToken($request->token);
        } catch (FailedToVerifyToken $e) {
            abort(501, 'Đăng nhập thất bại');
        }

        $newUser = false;

        $uid = $verifiedIdToken->claims()->get('sub');
        $user = $this->firebase->getUser($uid);
        if (empty($user->phoneNumber)) abort(401, 'Lỗi thông tin đăng nhập');
        $phoneNumber = str_replace("+84", "0", $user->phoneNumber);
        $userServer = User::where('username', $phoneNumber)->first();

        if (empty($userServer))
        {
            $newUser = true;
            $newUserElo = new User();
            $newUserElo->email = $phoneNumber;
            $newUserElo->name = $phoneNumber;
            $newUserElo->username = $phoneNumber;
            $newUserElo->promo_code = $request->promo_code;
            $newUserElo->password = Hash::make($phoneNumber);
            $newUserElo->save();

            $userServer = User::where('username', $phoneNumber)->first();
            event(new Registered($userServer));
        }else{
            $userServer->update(['password' => Hash::make($request->password)]);
        }

        if (!$newUser && $userServer->banned == 1)
        {
            abort(401, 'Lỗi thông tin đăng nhập');
        }



        Auth::loginUsingId($userServer->id);

        return ApiController::response(200, [
            'redirect_url' => route('dashboard'),
            'is_new' => $newUser
        ]);
    }
}
