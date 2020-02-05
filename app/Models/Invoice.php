<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoices';
    public $timestamps = true;
    protected $fillable = array('reservation_id', 'patient_id', 'type', 'gateway', 'amount', 'gateway_invoice_id');

    public function reservation()
    {
        return $this->belongsTo('Models\Reservation');
    }

    public function patient()
    {
        return $this->belongsTo('Models\Patient');
    }

}
