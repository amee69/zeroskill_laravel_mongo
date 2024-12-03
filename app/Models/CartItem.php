<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class CartItem extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'cart_id',       // Link to the cart
//         'product_id',    // Link to the product
//         'quantity',      // Quantity of the product
//         'price',
//     ];

//     /**
//      * Get the cart that owns the item.
//      */
//     public function cart()
//     {
//         return $this->belongsTo(Cart::class, 'cart_id');
//     }

//     /**
//      * Get the product for the cart item.
//      */
//     public function product()
//     {
//         return $this->belongsTo(Product::class, 'product_id');
//     }
// }
