<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded  = [];

    public function especialidade() {
        return $this->belongsTo('App\Models\Especialidade');
    }

    public function consultas() {
        return $this->belongsToMany('App\Models\Consulta');
    }    
}
