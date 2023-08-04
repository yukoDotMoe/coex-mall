<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {

        $this->firebase = (new Factory)
            ->withServiceAccount(__DIR__. '/serviceAccount.json')
            ->withDatabaseUri(config('services.firebase.database_url'))
            ->createAuth();

    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginWithPhone(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            $verifiedIdToken = $this->firebase->verifyIdToken($request->token);
        } catch (FailedToVerifyToken $e) {
            return ApiController::response(401, [], 'Đăng nhập thất bại.');
        }

        $newUser = false;

        $uid = $verifiedIdToken->claims()->get('sub');
        $user = $this->firebase->getUser($uid);
        if (empty($user->phoneNumber)) return ApiController::response(401, [], 'Lỗi thông tin đăng nhập.');
        $phoneNumber = str_replace("+84", "0", $user->phoneNumber);
        $userServer = User::where('username', $phoneNumber)->first();

        if (empty($userServer))
        {
            $newUser = true;
            $newUserElo = new User();
            $newUserElo->email = $phoneNumber;
            $newUserElo->name = $phoneNumber;
            $newUserElo->username = $phoneNumber;
            $newUserElo->password = Hash::make($phoneNumber);
            $newUserElo->save();

            $userServer = User::where('username', $phoneNumber)->first();
        }

        if ($userServer->banned == 1)
        {
            return ApiController::response(500, [], 'Lỗi thông tin đăng nhập.');
        }

        Auth::loginUsingId($userServer->id);

        return ApiController::response(200, [
            'redirect_url' => route('dashboard'),
            'is_new' => $newUser
        ]);
    }
}
