<?php

namespace App\Models;

use App\Notifications\PharamacyRep\Auth\ResetPassword;
use App\Notifications\PharamacyRep\Auth\VerifyEmail;
use App\Traits\HashPassword;
use App\Traits\HasVerificationCode;
use App\Traits\ModelHasImage;
use App\Traits\ModelHasLogs;
use HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;

class PharmacyRep extends Authenticatable
{

    use  HashPassword, ModelHasImage, HasVerificationCode, ModelHasLogs, CausesActivity, UsersOnlineTrait;

    protected $table = 'pharmacy_reps';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'blocked_at', 'blocked_reason', 'pharmacy_id', 'email_verified_at', 'phone_verified_at', 'verification_code','role');


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
     * @param string $token
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

    public function pharmacy()
    {
        return $this->belongsTo('App\Models\Pharmacy');
    }

    public function prescription()
    {
        return $this->hasMany('App\Models\Prescription');
    }

}
