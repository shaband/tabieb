<?php

namespace App\Models;

use App\Notifications\Patient\Auth\ResetPassword;
use App\Notifications\Patient\Auth\VerifyEmail;
use App\Traits\HashPassword;
use App\Traits\HasVerificationCode;
use App\Traits\ModelHasImage;
use App\Traits\ModelHasLogs;
use App\Traits\PushImage;
use HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Patient extends Authenticatable implements JWTSubject
{
    use Notifiable, HasVerificationCode, HashPassword, ModelHasImage, ModelHasLogs, CausesActivity, UsersOnlineTrait;

    protected $table = 'patients';

    public $timestamps = true;

    protected $fillable = array('username', 'first_name', 'last_name', 'email', 'phone', 'password', 'civil_id', 'social_security_id', 'blocked_at', 'blocked_reason', 'birthdate', 'social_security_expired_at', 'district_id', 'area_id', 'block_id', 'email_verified_at', 'phone_verified_at', 'verification_code', 'last_login', 'gender', 'fb_token', 'google_token', 'reset_password_code');


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
        'phone_verified_at' => 'datetime',
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

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function image()
    {
        return $this->morphOne(Attachment::class, 'model')->where('type', 1);
    }

    public function files()
    {
        return $this->morphMany(Attachment::class, 'model')->where('type', 2);
    }

    public function providers()
    {
        return $this->morphMany(AuthModelProvider::class, 'model');
    }

    public function medical_histories()
    {
        return $this->hasMany(MedicalHistory::class, 'patient_id')
            ->with(['file:file,ext', 'creator', 'category:name_ar,name_en']);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function patient_answers()
    {
        return $this->hasMany(PatientAnswer::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'model');
    }

    public function social_security()
    {
        return $this->belongsTo(SocialSecurity::class);
    }

    public function fcm_tokens()
    {
        return $this->morphMany(Device::class, 'model')->where('device_type', Device::TOKEN_TYPE_FCM);
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function receivesBroadcastNotificationsOn()
    {
        return 'App.notifications.patient.'. $this->id;
    }
}
