@extends('layouts.layoutmaster')

@push('styles')
<style>
    table{ border-collapse: collapse; width: 100%; }
    th, td{ text-align: left; padding: 10px; border-bottom: 1px solid var(--line); }
    th{ background-color: var(--navy); color: #F5F1E8; }
    tr:nth-child(even){ background-color: var(--paper-2); }
    .badge{
        display:inline-block; padding:3px 10px; border-radius:20px;
        font-size:11.5px; font-weight:600;
    }
    .badge-active{ background:#DFF3E3; color:#1E7B3C; }
    .badge-inactive{ background:#FBEAEA; color:#A33; }

    .per-page-select{
        padding:8px 12px;
        border:1px solid var(--line);
        border-radius:8px;
        background:#fff;
        color:var(--ink);
        font-size:13px;
        font-family:'Inter', sans-serif;
        cursor:pointer;
        outline:none;
    }
    .per-page-select:hover{ border-color:var(--gold); }

    /* ===== Thanh trên bảng: nút thêm ===== */
    .table-toolbar{
        display:flex;
        justify-content:flex-end;
        margin-bottom:14px;
    }
    .btn-add{
        display:inline-flex;
        align-items:center;
        gap:6px;
        background: var(--navy);
        color:#F5F1E8;
        border:none;
        padding:9px 18px;
        border-radius:8px;
        font-size:13.5px;
        font-weight:600;
        text-decoration:none;
        transition:background .15s ease;
    }
    .btn-add:hover{ background: var(--navy-2); }

    /* ===== Cột thao tác ===== */
    .action-group{ display:flex; gap:8px; }
    .btn-edit,
    .btn-delete{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:6px 14px;
        border-radius:6px;
        font-size:12.5px;
        font-weight:600;
        text-decoration:none;
        border:1px solid transparent;
        cursor:pointer;
        font-family:'Inter', sans-serif;
    }
    .btn-edit{
        background:#FFF6E4;
        color:#8A6A0E;
        border-color:#E9D6A0;
    }
    .btn-edit:hover{ background:#FCEBC4; }
    .btn-delete{
        background:#FBEAEA;
        color:#A33;
        border-color:#E8B4B4;
    }
    .btn-delete:hover{ background:#F6D6D6; }
</style>
@endpush

@section('content')
    <div class="page-title">Danh sách lớp học</div>
    <div class="page-sub">Dữ liệu lấy trực tiếp từ bảng lop_hocs.</div>


    {{-- Nút thêm lớp học, đặt trên bảng --}}
    <div class="table-toolbar">
        <a href="{{ route('lophoc.create') }}" class="btn-add">+ Thêm lớp học</a>
    </div>

    <table>
        <tr>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Giáo viên</th>
            <th>Sĩ số</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>

        @forelse ($lophocs as $lop)
        <tr>
            <td>{{ $lop->ma_lop }}</td>
            <td>{{ $lop->ten_lop }}</td>
            <td>{{ $lop->giao_vien }}</td>
            <td>{{ $lop->si_so }}</td>
            <td>{{ $lop->ghi_chu ?? '—' }}</td>
            <td>
                @if ($lop->trang_thai)
                    <span class="badge badge-active">Đang hoạt động</span>
                @else
                    <span class="badge badge-inactive">Ngừng hoạt động</span>
                @endif
            </td>
            <td>
                <div class="action-group">
                    <a href="{{ route('lophoc.edit', $lop->id) }}" class="btn-edit">Sửa</a>

                    <form action="{{ route('lophoc.destroy', $lop->id) }}" method="POST"
                          onsubmit="return confirm('Bạn có chắc muốn xóa lớp {{ $lop->ten_lop }} không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align:center; color:var(--ink-muted);">Chưa có lớp học nào.</td>
        </tr>
        @endforelse
    </table>

    {{-- bắt số lượng bản ghi mỗi trang --}}
    <select
    onchange="window.location.href='{{ url()->current() }}?per_page=' + this.value"
    class="per-page-select">

    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / trang</option>
    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / trang</option>
    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 / trang</option>
</select>

    <div style="margin-top: 20px;">
        {{ $lophocs->links() }}
    </div>
@endsection