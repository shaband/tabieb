<?php

namespace App\Traits;


use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ModelHasImage
{

    /**
     * Model $this
     * @return MorphOne
     */
    public function image(): MorphOne
    {

        return $this->morphOne(Attachment::class, 'model')->where('type', Attachment::PROFILE_PICTURE);
    }


    /*attributes*/

    public function getImgAttribute()
    {
        return optional($this->image)->file ?? 'https://www.shankarainfra.com/img/avatar.png';
    }
}
