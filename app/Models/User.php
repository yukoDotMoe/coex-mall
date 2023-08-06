<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'mat_truoc',
        'mat_sau',
        'address',
        'promo_code',
        'phone',
        'banned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getWallet()
    {
        $userWalet = Wallet::where('user_id',$this->id)->first();
        if (isset($userWalet)) {
            return $userWalet;
        }
        $userWalet = new Wallet;
        $userWalet->user_id = $this->id;
        $userWalet->amount = 0;
        $userWalet->amount_freeze = 0;
        $userWalet->amount_availability = 0;
        $userWalet->created_at = now();
        $userWalet->updated_at = now();
        $userWalet->save();
        return $userWalet;
    }

    public function balance()
    {
        $wallet = $this->getWallet();
        return $wallet->amount;
    }

    public function balanceFormated()
    {
        $wallet = $this->getWallet();
        return number_format($wallet->amount, 0, '', ',');
    }

    public function is_verify()
    {
        return !empty($this->mat_truoc) && !empty($this->mat_sau);
    }

    public function getBank()
    {
        return UserBank::where('user_id', $this->id)->first();
    }

    public function getReact($type)
    {
        $wallet = $this->getWallet();
            return ($type == 1) ? $wallet->vote : $wallet->like;
    }
}
