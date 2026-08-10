<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionPrecio extends Model
{
    protected $fillable = ['clave', 'valor', 'descripcion'];

    public static function obtener(string $clave): float
    {
        $config = self::where('clave', $clave)->first();
        return $config ? (float) $config->valor : 0.0;
    }
}
