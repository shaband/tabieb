<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{

    protected $table = 'prescription_items';
    public $timestamps = true;
    protected $fillable = array('prescription_id', 'medicine', 'dose', 'description');

    public function prescription()
    {
        return $this->belongsTo('App\Models\Prescription');
    }

}
