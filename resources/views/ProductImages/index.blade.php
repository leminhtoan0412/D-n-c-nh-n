@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ảnh sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Ảnh sản phẩm</li>
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
                            <a href="{{ route('product_images.create') }}" class="btn btn-success"><i
                                    class="fas fa-plus-circle"></i> Thêm</a>
                            <a href="{{ route('product_images.trash') }}" class="btn btn-danger">Danh sách đã xóa</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered  text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($images as $img)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $img->product->code }}</td>
                                                <td><img src="{{ $img->path }}" style="height: 100px; width: 100px">
                                                </td>
                                                <td>{{ $img->created_at }}</td>
                                                <td>{{ $img->updated_at }}</td>
                                                <td class="project-actions">
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('product_images.edit', ['product_image' => $img]) }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Sửa
                                                    </a>
                                                    <form
                                                        action="{{ route('product_images.destroy', ['product_image' => $img]) }}"
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
                                {{ $images->links() }}
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
