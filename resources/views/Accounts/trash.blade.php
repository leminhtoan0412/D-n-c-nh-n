@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tài khoản đã xóa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tài khoản</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9">
                                    <a href="{{ route('accounts.index') }}" class="btn btn-danger">Quay lại</a>
                                </div>
                                {{-- <div class="col-3">
                                    <form action="{{ route('accounts.trash') }}">
                                        <div class="input-group ">
                                            <input type="search" name="search" class="form-control"
                                                placeholder="Nhập tên hoặc email">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-success btn-flat"><i
                                                        class="fas fa-search"></i></button>
                                            </span>
                                            <a href="{{ route('accounts.trash') }}" class="btn btn-primary btn-flat"><i
                                                    class="fas fa-redo-alt"></i></a>
                                        </div>
                                    </form>
                                </div> --}}

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered  text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>SĐT</th>
                                            <th>IsAdmin</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($account as $a)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $a->full_name }}</td>
                                                <td>{{ $a->email }}</td>
                                                <td>{{ $a->phone }}</td>
                                                @if ($a->is_admin == 1)
                                                    <td><input type="checkbox" checked disabled></td>
                                                @else
                                                    <td><input type="checkbox" disabled></td>
                                                @endif

                                                <td> {{ $a->created_at }}</td>
                                                <td>{{ $a->updated_at }}</td>
                                                <td>
                                                    <a class="btn btn-success btn-sm restore"
                                                        href="{{ route('accounts.restore', ['id' => $a->id]) }}">
                                                        <i class="fas fa-redo-alt"></i>
                                                        Khôi phục
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                {{ $account->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
