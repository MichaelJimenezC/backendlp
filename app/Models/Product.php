<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category_id', 'user_id']; // Asegúrate de incluir user_id

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación con el usuario (autor del producto)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
