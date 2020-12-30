<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class Product extends Model
{
    use HasFactory;

    public function cartItem()
    {
        return $this->hasOne(CartItem::class);
    }

}
