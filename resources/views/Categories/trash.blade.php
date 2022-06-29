@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh mụ đã xóa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh mục</li>
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
                                    <a href="{{ route('categories.index') }}" class="btn btn-danger">Quay lại</a>
                                </div>
                                {{-- <div class="col-3">
                                    <form action="">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control"
                                                placeholder="Nhập tên">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-success btn-flat"><i
                                                        class="fas fa-search"></i></button>
                                            </span>
                                            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-flat"><i
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
                                            <th>Hình ảnh</th>
                                            <th>Tên danh mục</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $c)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td><img src="{{ $c->image }}" alt=""></td>
                                                <td>{{ $c->name }}</td>
                                                <td> {{ $c->created_at }}</td>
                                                <td>{{ $c->updated_at }}</td>
                                                <td class="project-actions">
                                                    <a class="btn btn-success btn-sm restore"
                                                        href="{{ route('categories.restore', ['id' => $c->id]) }}">
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
                                {{ $category->links() }}
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
