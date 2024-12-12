<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class class1 extends Model
{
    //
    use HasFactory;

    protected $fillable = ['grade_level', 'room_number'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
