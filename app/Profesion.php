<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model {

    protected $table = 'profesion';

    protected $fillable = [ 
        'prof_id', 
        'prof_nombre',
    ];
}
