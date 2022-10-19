<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $casts = [
        'otherPhones' => 'array'
    ];

    protected $dates = ['dateBirth'];  
    
    protected $guarded  = [];

    public function consultaAsParticipant() {
        return $this->belongsToMany('App\Models\Consulta');
    }     
}
