<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    //
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'parent_phone'];

    public function class()
    {
        return $this->belongsTo(class1::class, 'id');
    }
}
