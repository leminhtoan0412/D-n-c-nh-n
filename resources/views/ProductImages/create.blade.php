@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm ảnh sản phẩm</h1>
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
                            <form method="post" action="{{ route('product_images.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="selectProduct">Chọn sản phẩm</label>
                                        <select class="form-control" name="product_id">
                                            <option value="" class="text-center">-------Chọn sản phẩm------</option>
                                            @foreach ($product as $prd)
                                                <option value="{{ $prd->id }}">{{ $prd->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product_id'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('product_id') }}
                                            </div>
                                        @endif
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

                                <button class="btn btn-success" type="submit">Thêm</button>
                                <a href="{{ route('product_images.index') }}" class="btn btn-secondary">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
