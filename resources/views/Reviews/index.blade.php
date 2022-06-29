@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bình luận và đánh giá</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bình luận và đánh giá</li>
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
                                    <a href="{{ route('reviews.trash') }}" class="btn btn-danger">Danh sách đã xóa</a>
                                </div>
                                <div class="col-3">
                                    <form action="">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control"
                                                placeholder="Nhập tên">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-success btn-flat"><i
                                                        class="fas fa-search"></i></button>
                                            </span>
                                            <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-flat"><i
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
                                            <th>Tên khách hàng</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Số sao</th>
                                            <th>Bình luận</th>
                                            <th>Ngày bình luận</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($review as $r)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $r->account->full_name }}</td>
                                                <td>{{ $r->product->code }}</td>
                                                <td>
                                                    @for (; 0 < $r->vote; $r->vote--)
                                                        <i class="fas fa-star fa-color"></i>
                                                    @endfor
                                                </td>
                                                <td>{{ $r->comments }}</td>
                                                <td>{{ $r->created_at }}</td>
                                                <td class="project-actions">
                                                    <form action="{{ route('reviews.destroy', ['review' => $r]) }}"
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
                                {{ $review->links() }}
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
