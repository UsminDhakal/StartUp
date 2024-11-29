<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasInvest extends Model
{
    use HasFactory;
    public function getUser(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function getTopic(){
        return $this->belongsTo(Topic::class, "topic_id", "id");
    }
}
