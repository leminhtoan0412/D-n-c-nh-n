@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm danh mục</h1>
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
                            <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="inputImage">Hình ảnh:</label>
                                    <input class="form-control-file" id="inputImage" type="file" name="image">
                                    @if ($errors->has('image'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tên danh mục:</label>
                                    <input class="form-control" id="inputName" name="name" type="text"
                                        placeholder="Nhập tên danh mục">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-success" type="submit">Thêm</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
