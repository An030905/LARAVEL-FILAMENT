<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 1. Khai báo đúng tên bảng theo yêu cầu (MSSV)
    protected $table = '23810310263_categories';

    // 2. Cho phép lưu dữ liệu vào các cột này
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active'
    ];

    // 3. QUAN TRỌNG: Định nghĩa quan hệ 1 - Nhiều (Một danh mục có nhiều sản phẩm)
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
