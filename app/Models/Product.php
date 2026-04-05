<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // Bắt buộc khai báo tên bảng có MSSV
    protected $table = '23810310263_products';

    protected $fillable = [
        'category_id', 
        'name', 
        'slug', 
        'description', 
        'price', 
        'stock_quantity', 
        'image_path', 
        'status',
        'discount_percent' // Trường sáng tạo của bạn
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
