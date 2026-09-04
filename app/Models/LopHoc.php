<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;
    // protected $table = 'lop_hocs';
    // được phép 
    protected $fillable = [
        'ten_lop',
        'ma_lop',
        'giao_vien',
        'ghi_chu',
        'si_so',
        'trang_thai',
    ];
}
