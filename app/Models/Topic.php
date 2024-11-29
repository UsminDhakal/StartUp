<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    public function getAmount(){
        return $this->hasMany(UserHasInvest::class, "topic_id", "id")->where("type", 1);
    }

}
