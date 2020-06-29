<?php

namespace App\Models;

use App\Repositories\interfaces\AttachmentRepository;
use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use ModelHasLogs;

    const  PROFILE_PICTURE = 1;
    const  DOCTOR_DOCUMENT = 2;
    const  DOCTOR_Logo = 3;
    const  MEDICAL_HISTORY = 4;
    const  MESSAGE_FILE = 5;
    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('file', 'model_id', 'model_type', 'ext', 'type', 'name');

    public function model()
    {
        return $this->morphTo('model');
    }

    public function scopeOfModelType(Builder $builder, $value): void
    {

        $builder->where('model_type', $value);
    }


    public function scopeOfUserImage(Builder $builder, Model $model, $column, $type = 1): void
    {
        $builder->limit(1)
            ->select('file')
            ->OfModelType(
                app(AttachmentRepository::class)->getMorphedAlias((new \ReflectionClass($model))->getName())
            )
            ->where('type', $type)
            ->whereColumn('model_id', $column)
            ->latest();

    }


}
