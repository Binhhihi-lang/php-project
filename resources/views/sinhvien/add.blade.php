{{-- resources/views/sinhvien/add.blade.php --}}
@extends('layouts.layoutmaster')

@push('styles')
<style>
    .form-box{
        max-width: 480px;
        background: var(--paper-2);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 28px;
    }
    .form-group{ margin-bottom: 18px; }
    .form-group label{
        display:block;
        font-size:13px;
        font-weight:600;
        margin-bottom:6px;
        color: var(--ink);
    }
    .form-group input{
        width:100%;
        padding:10px 12px;
        border:1px solid var(--line);
        border-radius:8px;
        font-size:13.5px;
        font-family:'Inter', sans-serif;
        outline:none;
        transition:border-color .15s ease;
    }
    .form-group input:focus{ border-color:var(--gold); }
    .btn-submit{
        background: var(--navy);
        color:#F5F1E8;
        border:none;
        padding:10px 22px;
        border-radius:8px;
        font-size:13.5px;
        font-weight:600;
        cursor:pointer;
        transition:background .15s ease;
    }
    .btn-submit:hover{ background: var(--navy-2); }
    .error-box{
        background:#FBEAEA;
        border:1px solid #E8B4B4;
        color:#A33;
        padding:12px 14px;
        border-radius:8px;
        font-size:13px;
        margin-bottom:18px;
    }
    .error-box ul{ margin-left:18px; margin-top:4px; }
</style>
@endpush

@section('content')
    <div class="page-title">Thêm sinh viên</div>
    <div class="page-sub">Nhập thông tin sinh viên mới vào danh sách.</div>

    {{-- Hiển thị lỗi validate (nếu có) --}}
    @if ($errors->any())
        <div class="error-box">
            <strong>Có lỗi xảy ra:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-box">
        <form action="{{ route('sinhvien.store') }}" method="POST">
            {{-- Bắt buộc phải có @csrf khi dùng form POST trong Laravel --}}
            @csrf

            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nguyễn Văn A">
            </div>

            <div class="form-group">
                <label for="age">Tuổi</label>
                <input type="number" id="age" name="age" value="{{ old('age') }}" placeholder="20">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ten@example.com">
            </div>

            <button type="submit" class="btn-submit">Lưu sinh viên</button>
        </form>
    </div>
@endsection