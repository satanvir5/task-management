<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public static function getTaskOfUser(){
        return self::where('user_id',auth()->user()->id)->get();
    }

    public function assignUser()
    {
        return $this->belongsTo(User::class, 'assigned_user', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
