<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $guarded = [];

    public function record()
    {
        return $this->hasMany(Record::class, 'id', 'record_id');
    }
}
