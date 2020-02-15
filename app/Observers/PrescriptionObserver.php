<?php

namespace App\Observers;

use App\Models\Prescription;

class prescriptionObserver
{
    public function saving(Prescription $prescription)
    {

        $prescription->code = rand(000000000, 999999999);
    }
}
