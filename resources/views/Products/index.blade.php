@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
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
                                <div class="col-8">
                                    <a href="{{ route('products.create') }}" class="btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Thêm</a>
                                    <a href="{{ route('products.trash') }}" class="btn btn-danger">Danh sách đã xóa</a>
                                </div>
                                <div class="col-4">
                                    <form action="">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control"
                                                placeholder="Nhập tên hoặc mã sản phẩm">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-success btn-flat"><i
                                                        class="fas fa-search"></i></button>
                                            </span>
                                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-flat"><i
                                                    class="fas fa-redo-alt"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered  text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá(VNĐ)</th>
                                            <th>Số lượng</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $prd)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $prd->code }}</td>
                                                <td>{{ $prd->name }}</td>
                                                <td>{{ number_format($prd->price) }}</td>
                                                <td>{{ $prd->quantity }}</td>
                                                <td>{{ $prd->created_at }}</td>
                                                <td>{{ $prd->updated_at }}</td>
                                                <td class="project-actions">
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('products.show', ['product' => $prd]) }}">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                        Xem
                                                    </a>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('products.edit', ['product' => $prd]) }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Sửa
                                                    </a>
                                                    <form action="{{ route('products.destroy', ['product' => $prd]) }}"
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
                            <div class="row">
                                {{ $product->links() }}
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
