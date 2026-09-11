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
        $lophocs = LopHoc::paginate($perPage)->withQueryString(); // LopHoc extend từ Model nên có các hàm đó 

        return view('lophoc.index', [
            'title'   => 'Danh sách lớp học', // 
            'lophocs' => $lophocs // data gửi sang 
        ]);
    }
    public function create()
    {
        return view('lophoc.create', [
            'title' => 'Thêm lớp học'
        ]);
    }

    // 
    public function store(Request $request)
    {

        // validate dữ liệu
        $request->validate([
            'ten_lop'   => 'required|string|max:255',
            'ma_lop'    => 'required|string|max:255|unique:lop_hocs,ma_lop',
            'giao_vien' => 'required|string|max:255',
            'si_so'     => 'required|integer|min:1',
            'ghi_chu'   => 'nullable|string',
        ]);



        // Cách 2 : khởi tạo đối tượng mới và gán giá trị cho từng thuộc tính từ tên của input
        // $lophoc = new LopHoc();
        // $lophoc->ten_lop = $request->input('ten_lop');
        // $lophoc->ma_lop = $request->input('ma_lop');
        // $lophoc->giao_vien = $request->input('giao_vien');
        // $lophoc->ghi_chu = $request->input('ghi_chu');
        // $lophoc->si_so = $request->input('si_so');
        // $lophoc->trang_thai = $request->input('trang_thai', 0); // mặc định là 0 nếu không có giá trị
        // $lophoc->save();

        // chuyển trang từ trang thêm mới sang trang danh sách lớp học và hiển thị thông báo thành công

        try {
            // Cách 1 : dùng phương thức create() của Model LopHoc
            // LopHoc::create($request->all()); // $request->all() trả về tất cả dữ liệu từ form gửi lên
            // Cách 2 : dùng phương thức create() của Model LopHoc với chỉ định các trường cần thiết
            LopHoc::create($request->only(['ten_lop', 'ma_lop', 'giao_vien', 'ghi_chu', 'si_so', 'trang_thai']));
            return redirect()->route('lophoc.index')
                ->with('success', 'Thêm lớp học thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi khi thêm mới lớp học: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi khi thêm mới lớp học: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi khi thêm mới lớp học: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $lophoc = LopHoc::findOrFail($id);

        return view('lophoc.edit', [
            'title'  => 'Sửa lớp học',
            'lophoc' => $lophoc
        ]);
    }
    public function update(Request $request, $id)
    {
        $lophoc = LopHoc::findOrFail($id);

        $request->validate([
            'ten_lop'   => 'required|string|max:255',
            'ma_lop'    => 'required|string|max:255|unique:lop_hocs,ma_lop,' . $id,
            'giao_vien' => 'required|string|max:255',
            'si_so'     => 'required|integer|min:1',
            'ghi_chu'   => 'nullable|string',
        ]);

        $lophoc->update([
            'ten_lop'    => $request->ten_lop,
            'ma_lop'     => $request->ma_lop,
            'giao_vien'  => $request->giao_vien,
            'si_so'      => $request->si_so,
            'ghi_chu'    => $request->ghi_chu,
            'trang_thai' => $request->has('trang_thai'),
        ]);

        return redirect()->route('lophoc.index')
            ->with('success', 'Cập nhật lớp học thành công!');
    }

    public function destroy($id)
    {
        $lophoc = LopHoc::findOrFail($id);
        $lophoc->delete();

        return redirect()->route('lophoc.index')
            ->with('success', 'Đã xóa lớp học thành công!');
    }
}
