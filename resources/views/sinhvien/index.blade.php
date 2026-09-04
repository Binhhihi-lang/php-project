{{-- Kế thừa layout --}}
@extends('layouts.layoutmaster')

@push('styles')
<style>
    h1 {
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even){ background-color: #f2f2f2 }
    th {
        background-color: #04AA6D;
        color: white;
    }
</style>
@endpush

@section('content')
    <h1>Danh sách sinh viên</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Tuổi</th>
            <th>Email</th>
        </tr>
        @foreach($sinhviens as $sinhvien)
        <tr>
            <td>{{ $sinhvien['id'] }}</td>
            <td>{{ $sinhvien['name'] }}</td>
            <td>{{ $sinhvien['age'] }}</td>
            <td>{{ $sinhvien['email'] }}</td>
        </tr>
        @endforeach
    </table>
    
@endsection

@push('scripts')
<script>
    console.log('Script chỉ chạy ở trang danh sách sinh viên ');
</script>
@endpush