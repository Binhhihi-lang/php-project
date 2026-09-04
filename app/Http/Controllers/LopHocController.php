<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use Illuminate\Http\Request;

class LopHocController extends Controller
{
    public function index(Request $request)
    {
        // Gọi Model -> Model tự động query xuống bảng lop_hocs trong Database
        // $lophocs = LopHoc::all(); // gọi phương thức tĩnh , trả về toàn bộ bản ghi 
        //$lophocs = LopHoc::paginate(10); // 10 dòng mỗi trang
        $perPage = $request->input('per_page', 10);
        $lophocs = LopHoc::paginate($perPage)->withQueryString();

        return view('lophoc.index', [
            'title'   => 'Danh sách lớp học', // 
            'lophocs' => $lophocs // data gửi sang 
        ]);
    }
}
