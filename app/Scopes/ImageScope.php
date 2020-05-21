<?php

namespace App\Scopes;

use App\Models\Attachment;
use App\Repositories\interfaces\AttachmentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ImageScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->addSelect(['img' => Attachment::ofUserImage($model, $model->getTable() . '.id', Attachment::PROFILE_PICTURE)]);
    }
}
