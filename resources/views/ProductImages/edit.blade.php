@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sửa ảnh sản phẩm</h1>
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
                                action="{{ route('product_images.update', ['product_image' => $images]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hình sản phẩm</label>
                                        <img src="{{ $images->path }}" style="width:300px; height: 300px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Hình ảnh:</label>
                                    <input class="form-control-file" id="inputImage" type="file" name="image">
                                    @if ($errors->has('image'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>

                                <button class="btn btn-success" type="submit">Lưu</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
