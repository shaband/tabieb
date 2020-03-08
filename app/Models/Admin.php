<?php

namespace App\Models;

use App\Notifications\Admin\Auth\ResetPassword;
use App\Notifications\Admin\Auth\VerifyEmail;
use App\Traits\HashPassword;
use App\Traits\ModelHasImage;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{

    use Notifiable, HasRoles, HashPassword, ModelHasImage, ModelHasLogs, CausesActivity;
    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'blocked_at', 'blocked_reason');


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

    /*relashions*/
    /*attributes*/

    public function getRoleAttribute()
    {

        return optional($this->roles)->first();
    }

}
