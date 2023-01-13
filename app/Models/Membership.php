<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
