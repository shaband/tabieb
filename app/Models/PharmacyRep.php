<?php

namespace App\Models;

use App\Notifications\PharamacyRep\Auth\ResetPassword;
use App\Notifications\PharamacyRep\Auth\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PharmacyRep extends Authenticatable
{

    protected $table = 'pharmacy_reps';
    public $timestamps = true;
    protected $fillable = array('pharmacy_id', 'email_verified_at', 'phone_verified_at', 'verification_code');


    use Notifiable;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
    public function pharamacy()
    {
        return $this->belongsTo('App\Models\Pharmacy');
    }

    public function prescription()
    {
        return $this->hasMany('App\Models\Prescription');
    }

}
