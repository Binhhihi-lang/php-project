<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinhVienController extends Controller
{

    private $sinhviens = [
        ['id' => 1, 'name' => 'Nguyễn Văn A', 'age' => 20, 'email' => 'nguyenvana@example.com'],
        ['id' => 2, 'name' => 'Trần Thị B', 'age' => 21, 'email' => 'tranthib@example.com'],
        ['id' => 3, 'name' => 'Lê Văn C', 'age' => 22, 'email' => 'levanc@example.com']
    ];

    //
    public function index()
    {
        return view('sinhvien.index', [
            'title' => 'Danh sách sinh viên',
            'sinhviens' => $this->sinhviens
        ]);
    }



    public function show($ten = "Chu Binh", $tuoi = 20)
    {
        return "Tên sinh viên: " . $ten . ", Tuổi: " . $tuoi;
    }

    // thông tin sinh viên theo id 
    public function getID($id = "")
    {
        // thay foreach bằng collection sẽ tối ưu hơn 
        $sinhvien = collect($this->sinhviens)->firstWhere('id', $id);

        //Thêm if else để không lỗi : Trying to access array offset on null
        if ($sinhvien) {
            return "Thông tin sinh viên: Tên: " . $sinhvien['name'] . ", Tuổi: " . $sinhvien['age'] . ", Email: " . $sinhvien['email'];
        } else {
            return "Không tìm thấy sinh viên với ID: " . $id;
        }
    }

    // hàm mở ra trang thêm sinh viên 
    public function add()
    {
        return view('sinhvien.add');
    }

    // xử lý form thêm sinh viên 
    public function store(Request $request)
    {
        dd($request->all()); // Dùng để debug dữ liệu nhận được từ form

        // // Validate dữ liệu nhập vào
        // $request->validate([
        //     'name'  => 'required|string|max:255',
        //     'age'   => 'required|integer|min:1',
        //     'email' => 'required|email',
        // ]);

        // // Vì bạn đang dùng mảng tạm (chưa nối database),
        // // ở đây chỉ demo — chưa lưu được thật sự vì $sinhviens
        // // được khởi tạo lại mỗi lần request mới
        // $newId = count($this->sinhviens) + 1;

        // $sinhVienMoi = [
        //     'id'    => $newId,
        //     'name'  => $request->name,
        //     'age'   => $request->age,
        //     'email' => $request->email,
        // ];

        // // return để kiểm tra tạm thời
        // return "Đã nhận dữ liệu: " . json_encode($sinhVienMoi, JSON_UNESCAPED_UNICODE);
    }
}
