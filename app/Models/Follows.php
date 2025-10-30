<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ngo_id'] ;

    public function ngo(){
        return $this->belongsToMany(Ngo::class);
    }
}
