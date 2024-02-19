<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    const ROOT="root";
    const ADMIN="admin";
    const OPERADOR="operador";

    protected $fillable = [
        'name',
        'guard_name',
    ];
}
