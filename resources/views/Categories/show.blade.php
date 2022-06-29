@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $category->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Danh mục</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
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
                            <a href="{{ route('sub_categories.create', ['category' => $category]) }}"
                                class="btn btn-success"><i class="fas fa-plus-circle"></i> Thêm</a>
                            <a href="{{ route('sub_categories.trash', ['id' => $category->id]) }}"
                                class="btn btn-danger">Danh sách đã xóa</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered  text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên danh mục phụ</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub_category as $sc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sc->name }}</td>
                                            <td>{{ $sc->created_at }}</td>
                                            <td>{{ $sc->updated_at }}</td>
                                            <td class="project-actions">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('sub_categories.edit', [$sc]) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Sửa
                                                </a>
                                                <form
                                                    action="{{ route('sub_categories.destroy', ['sub_category' => $sc]) }}"
                                                    method="post" class="btn delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Xoá" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i>
                                                        Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

@endsection
