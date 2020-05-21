<?php

namespace App\Traits;


use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ModelHasImage
{

    use PushImage;

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
        return $this->attributes['img'] ??
           // optional($this->image()->select('file')->first())->file ??
            'https://www.shankarainfra.com/img/avatar.png';
    }
}
