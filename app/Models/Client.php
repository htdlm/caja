<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'nombre',
        'fecha',
        'monto',
        'depositado',
        'credito',
        'estatus',
        'pago',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'datetime',
        'monto' => 'float',
        'depositado' => 'float',
        'credito' => 'float'
    ];
}
