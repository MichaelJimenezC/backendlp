<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    // Definir qué campos pueden ser asignados masivamente
    protected $fillable = [
        'name',         // Nombre de la categoría
        'description',  // Descripción de la categoría
    ];
    public function products()
{
    return $this->hasMany(Product::class);
}

}
