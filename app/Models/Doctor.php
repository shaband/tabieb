<?php

namespace App\Models;

use App\Notifications\Doctor\Auth\ResetPassword;
use App\Notifications\Doctor\Auth\VerifyEmail;
use App\Traits\ColumnTranslation;
use App\Traits\HashPassword;
use App\Traits\ModelHasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Doctor extends Authenticatable implements JWTSubject
{
    use Notifiable, ColumnTranslation, ModelHasImage, HashPassword;

    const  GENDER_MALE = 1;
    const  GENDER_FEMALE = 2;
    protected $table = 'doctors';
    public $timestamps = true;
    protected $fillable = array('first_name_en', 'last_name_en', 'last_name_ar', 'first_name_ar', 'description_ar', 'description_en', 'title_ar', 'title_en', 'email', 'password', 'phone', 'category_id', 'price', 'period', 'last_login', 'email_verified_at', 'phone_verified_at', 'civil_id', 'verification_code', 'remember_token', 'gender', 'blocked_at', 'blocked_reason',);


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
        'price' => 'integer',
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

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_categories() :BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'doctor_category');
    }

    public function schedules():HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function reservation():HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function chats():HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function ratings():HasMany
    {
        return $this->hasMany(Rating::class);
    }


    public function papers():HasMany
    {
        return $this->hasMany('App\Models\Attachment')->where('type', 2);
    }

    /*attributes*/

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {

            return $this->first_name_ar . ' ' . $this->last_name_ar;
        }
        return $this->first_name_en . ' ' . $this->last_name_ar;


    }


    /*scopes*/

    public function scopeBlocked(Builder $builder): void
    {
        $builder->where('blocked_at', '!=', null);
    }

    public function scopeAvailable(Builder $builder): void
    {
        $builder->where('blocked_at', null);
    }


    public function fcm_tokens()
    {
        return $this->morphMany(Device::class, 'model')->where('device_type', Device::TOKEN_TYPE_FCM);
    }
}


