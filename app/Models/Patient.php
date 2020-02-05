<?php

namespace App\Models;

use App\Notifications\Patient\Auth\ResetPassword;
use App\Notifications\Patient\Auth\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{

    use Notifiable;
    protected $table = 'patients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'civil_id', 'social_security_id', 'blocked_at', 'blocked_reason', 'birthdate', 'district_id', 'area_id', 'block_id', 'phone_verified_at', 'verification_code', 'last_login', 'gender', 'fb_token', 'google_token');


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

    public function district()
    {
        return $this->belongsTo('Models\Distrcit', 'district_id');
    }

    public function area()
    {
        return $this->belongsTo('Models\Area', 'area_id');
    }

    public function block()
    {
        return $this->belongsTo('Models\Blocks', 'block_id');
    }

    public function image()
    {
        return $this->morphOne('Models\Attachment')->where('type',1);
    }

    public function files()
    {
        return $this->morphMany('Models\Attachment')->where('type',2);
    }

    public function reservations()
    {
        return $this->hasMany('Models\Reservation');
    }

    public function ratings()
    {
        return $this->hasMany('Models\Rating');
    }

    public function chats()
    {
        return $this->hasMany('Models\Chat');
    }

    public function invoices()
    {
        return $this->hasMany('Models\Invoice');
    }

    public function patient_answers()
    {
        return $this->hasMany('Models\PatientAnswer');
    }

    public function prescription()
    {
        return $this->hasOne('Models\Prescription');
    }

    public function social_security()
    {
        return $this->belongsTo('Models\SocialSecurity');
    }

}
