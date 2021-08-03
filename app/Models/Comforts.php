<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comforts extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'comfort_types_id'];

    public $timestamps = false;
}
