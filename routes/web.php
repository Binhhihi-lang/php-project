<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopHocController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/gioi-thieu', function () {
    return '<h1>Đây là trang Giới thiệu</h1><p>Nội dung tùy ý ở đây</p>';
});
Route::get('/them-sinh-vien', function () {
    return view('sinhvien.add');
});
Route::get('/sinhvien1', function () {
    return view('sinhvien.index', [
        'title' => 'Danh sách sinh viên'
    ]);
});

// thêm 2 tham số vào route
Route::get('/layout1', function () {
    return view('layout.layout1', [
        'title'        => 'Trang chủ LaptopShop',
        'content' => 'Đây là nội dung được truyền từ Route sang view.',
        'contentAlert' => '<script>alert("Xin chào! Chào mừng bạn đến với LaptopShop.");</script>'
    ]);
});


Route::get('/sinhvien', [SinhVienController::class, 'index']);

Route::get('/sinhvien-detail/{id?}', [SinhVienController::class, 'getID'])->where('id', '[0-9]+');

Route::get('/sinhvien/show/{tuoi?}/{hoten?}', [SinhVienController::class, 'show'])->where('tuoi', '[0-9]+')->where('hoten', '[A-Za-z]+');


// form thêm sinh viên
Route::get('/sinhvien/add', [SinhVienController::class, 'add'])->name('sinhvien.add');

// gắn 1 cái tên định danh (sinhvien.store) cho route này,
// tách biệt hoàn toàn với URL thật POST (/sinhvien)
Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store');


// lớp học 
Route::get('/lophoc', [LopHocController::class, 'index'])->name('lophoc.index');
Route::get('/lophoc/them', [LopHocController::class, 'create'])->name('lophoc.create');
Route::post('/lophoc', [LopHocController::class, 'store'])->name('lophoc.store');
Route::get('/lophoc/{id}/sua', [LopHocController::class, 'edit'])->name('lophoc.edit');
Route::put('/lophoc/{id}', [LopHocController::class, 'update'])->name('lophoc.update');
Route::delete('/lophoc/{id}', [LopHocController::class, 'destroy'])->name('lophoc.destroy');
