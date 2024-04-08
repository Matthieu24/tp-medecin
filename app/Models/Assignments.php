<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'patient_id', 'room_id', 'date', 'end_date'];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class);
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}