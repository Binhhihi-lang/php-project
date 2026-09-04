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

    /* .pagination{ display:flex; gap:6px; list-style:none; padding:0; }
    .pagination li a, .pagination li span{
    display:inline-block; padding:6px 12px; border-radius:6px;
    border:1px solid var(--line); color:var(--ink); text-decoration:none; font-size:13px;
    }
    .pagination li.active span{ background:var(--navy); color:#fff; border-color:var(--navy); }
    .pagination li.disabled span{ color:var(--ink-muted); } */

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

</style>
@endpush

@section('content')
    <div class="page-title">Danh sách lớp học</div>
    <div class="page-sub">Dữ liệu lấy trực tiếp từ bảng lop_hocs.</div>

    <table>
        <tr>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Giáo viên</th>
            <th>Sĩ số</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
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
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center; color:var(--ink-muted);">Chưa có lớp học nào.</td>
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