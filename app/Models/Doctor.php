<?php

namespace App\Models;

use App\Notifications\Doctor\Auth\ResetPassword;
use App\Notifications\Doctor\Auth\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;

    protected $table = 'doctors';
    public $timestamps = true;
    protected $fillable = array('first_name_en', 'last_name_en', 'last_name_ar', 'first_name_ar', 'discription_ar', 'discription_en', 'title_ar', 'title_en', 'email', 'password', 'phone', 'category_id', 'price', 'last_login', 'email_verified_at', 'phone_verified_at', 'civil_id', 'verification_code', 'gender');

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
    public function category()
    {
        return $this->belongsTo('Models\Category', 'category_id');
    }

    public function sub_categories()
    {
        return $this->belongsToMany('Models\Category', 'doctor_category');
    }

    public function schedules()
    {
        return $this->hasMany('Models\Schedule');
    }

    public function reservation()
    {
        return $this->hasMany('Models\Reservation');
    }

    public function chats()
    {
        return $this->hasMany('Models\Chat');
    }

    public function ratings()
    {
        return $this->hasMany('Models\Rating');
    }

    public function image()
    {
        return $this->hasOne('Models\Attachment')->where('type',1);
    }

    public function papers()
    {
        return $this->hasMany('Models\Attachment')->where('type',2);
    }

}
