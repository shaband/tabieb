<?php

namespace App\Models;

use App\Notifications\Doctor\Auth\ResetPassword;
use App\Notifications\Doctor\Auth\VerifyEmail;
use App\Traits\ColumnTranslation;
use App\Traits\HashPassword;
use App\Traits\ModelHasImage;
use App\Traits\ModelHasLogs;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Tymon\JWTAuth\Contracts\JWTSubject;
use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

class Doctor extends Authenticatable implements JWTSubject
{
    use Notifiable, ColumnTranslation, ModelHasImage, HashPassword, ModelHasLogs, CausesActivity, UsersOnlineTrait;


    const  GENDER_MALE = 1;
    const  GENDER_FEMALE = 2;
    protected $table = 'doctors';
    public $timestamps = true;
    const  KEYWORDS = [
        'first_name_en', 'last_name_en', 'last_name_ar', 'first_name_ar',
        'title_ar', 'title_en'
    ];
    protected $fillable = array('first_name_en', 'last_name_en', 'last_name_ar', 'first_name_ar', 'description_ar', 'description_en', 'title_ar', 'title_en', 'email', 'password', 'phone', 'category_id', 'price', 'period', 'last_login', 'email_verified_at', 'phone_verified_at', 'civil_id', 'verification_code', 'remember_token', 'gender', 'blocked_at', 'blocked_reason', 'license_number'
    , 'reset_password_code'
    );


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
        return $this->belongsTo(Category::class);
    }

    public function sub_categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'doctor_category');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class)
            ->with(['reservations' => function ($reservation) {
                $reservation->where('status', Reservation::STATUS_ACCEPTED);
            }, 'doctor']);
    }

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }


    public function papers(): MorphMany
    {
        return $this->MorphMany(Attachment::class, 'model')->where('type', Attachment::DOCTOR_DOCUMENT);
    }


    public function favourites()
    {
        return $this->belongsToMany(Doctor::class, 'favourites', 'doctor_id', 'patient_id');
    }

    /**
     * Model $this
     * @return MorphOne
     */
    public function logo_image(): MorphOne
    {

        return $this->morphOne(Attachment::class, 'model')->where('type', Attachment::DOCTOR_Logo);
    }

    public function fcm_tokens()
    {
        return $this->morphMany(Device::class, 'model')->where('device_type', Device::TOKEN_TYPE_FCM);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'doctor_id');
    }


    /*attributes*/

    public function getLogoAttribute()
    {

        return $this->logo_image()->select('file')->first('file')->file ?? asset('design/images/doctor-logo.png');
    }

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {

            return $this->first_name_ar . ' ' . $this->last_name_ar;
        }
        return $this->first_name_en . ' ' . $this->last_name_en;
    }

    public function getWeaklySchedulesAttribute()
    {
        $today = CarbonImmutable::now();
        $week_dates = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $today->addDays($i);
            $day_number = $day->dayOfWeek + 1;
            $schedules = $this->schedules->where('day', $day_number);
            $appointments = [];
            foreach ($schedules as $schedule) {
                $times = $schedule->reservation_times;
                $appointments = array_merge($appointments, $times);
            }
            $week_dates[$day_number] = ['day' => $day, 'times' => $appointments];
        }
        return $week_dates;
    }

    public function getAvailableOnAttribute()
    {
        $schedules = $this->weakly_schedules;
        $available_day = collect($schedules)->where('times', '!=', [])->where('times.has_reservation', 0)->first();
        return optional($available_day);
    }

    public function getAvailableDayAttribute()
    {
        $available = $this->available_on;
        return optional($available['day'] ?? null);
    }

    public function getAvailableTimeAttribute()
    {
        $available = $this->available_on;
        return collect($available['times'])->first() ?? [];
    }

    public function getIsFavouriteAttribute()
    {
        $is_favourite = false;
        if (auth()->guard('patient_api')->check()) {

            $is_favourite = auth()->guard('patient_api')->user()->favourites()->where('doctor_id', $this->id)->exists();
        } elseif (auth()->guard('patient')->check()) {
            $is_favourite = auth()->guard('patient')->user()->favourites()->where('doctor_id', $this->id)->exists();
        };
        return $is_favourite;
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


    public function scopeOfKeyWord(Builder $query, $value): void
    {

        $query->when($value != null, function (Builder $builder) use ($value) {
            $builder->where(function ($builder) use ($value) {
                foreach (static::KEYWORDS as $keyword) {
                    $builder->orWhere($keyword, 'like', "%$value%");
                }
            });
        });
    }

    public function scopeOfCategory(Builder $query, $value): void
    {
        $query->when($value != null, function (Builder $builder) use ($value) {
            $builder->Where('category_id', $value);
            $builder->orWhereHas('sub_categories', function (Builder $q) use ($value) {
                $q->where('id', $value);
            });
        });
    }

    /**
     *  add is_favourite  to the select of doctor
     * @param Builder $query
     * @param null $patient_id
     */
    public function scopeOfIsFavourite(Builder $query, $patient_id = null): void
    {
        if ($patient_id == null) {
            if (auth()->guard('patient_api')->check()) {
                $patient_id = auth()->guard('patient_api')->id();
            } elseif (auth()->guard('patient')->check()) {
                $patient_id = auth()->guard('patient')->id();
            };
        }
        $query->addSelect([
            'is_favourite' => Favourite::query()->limit(1)->selectRaw('true')->whereColumn('favourites.doctor_id', 'doctors.id')->where('favourites.patient_id', $patient_id)]);


    }

    public function scopeOfBetweenTime(Builder $query, $from = null, $to = null): void
    {
        $query->when($from != null, function (Builder $builder) use ($from) {
            $builder->WhereHas('schedules', function (Builder $q) use ($from) {
                $q->where('from_time', '<=', $from);
                $q->where('to_time', '>=', $from);
            });
        });
        $query->when($to != null, function (Builder $builder) use ($to) {
            $builder->WhereHas('schedules', function (Builder $q) use ($to) {
                $q->where('to_time', '<=', $to);
                $q->where('to_time', '>=', $to);
            });
        });
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.notifications.doctor.' . $this->id;
    }
}
