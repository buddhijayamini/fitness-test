<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table = 'records';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
