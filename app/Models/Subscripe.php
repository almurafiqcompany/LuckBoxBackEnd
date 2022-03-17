<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscripe extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'counter',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
