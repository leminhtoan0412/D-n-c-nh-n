@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sửa danh mục</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="post"
                                action="{{ route('sub_categories.update', ['sub_category' => $sub_category]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="inputName">Tên danh mục:</label>
                                    <input class="form-control" id="inputName" name="name" type="text"
                                        placeholder="Nhập tên danh mục" value="{{ $sub_category->name }}">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-success" type="submit">Lưu</button>
                                <a href="{{ route('categories.show', ['category' => $category]) }}"
                                    class="btn btn-secondary">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
