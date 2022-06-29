@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm sản phẩm</h1>
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
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin chung</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="form-group">
                                    <label for="inputCode">Mã sản phẩm</label>
                                    <input type="text" name="code" id="inputCode" class="form-control">
                                    @if ($errors->has('code'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tên sản phẩm</label>
                                    <input type="text" name="name" id="inputName" class="form-control">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Mô tả</label>
                                    <textarea id="inputDescription" class="form-control" rows="4"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 103px;"
                                        name="description"></textarea>
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="category_id" class="form-control custom-select">
                                        <option value="">--Chọn--</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('category_id') }}
                                        </div>
                                    @endif
                                    <label>Danh mục phụ</label>
                                    <select name="sub_category_id" class="form-control custom-select">
                                        <option value="">--Chọn--</option>
                                        @foreach ($sub_category as $sc)
                                            <option value="{{ $sc->id }}">{{ $sc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputPrice">Giá</label>
                                    <input type="number" name="price" id="inputPrice" class="form-control">
                                    @if ($errors->has('price'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                                <div class=" form-group">
                                    <label for="inputQuantity">Số lượng</label>
                                    <input type="number" name="quantity" id="inputQuantity" class="form-control">
                                    @if ($errors->has('quantity'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('quantity') }}
                                        </div>
                                    @endif
                                </div>
                        
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Chi tiết sản phẩm</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputCPUT">CPU</label>
                                    <input type="text" name='cpu' id="inputCPUT" class="form-control">
                                    @if ($errors->has('cpu'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('cpu') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputRam">RAM</label>
                                    <input type="text" name="ram" id="inputRam" class="form-control">
                                    @if ($errors->has('ram'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('ram') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputStorage">Ổ cứng</label>
                                    <input type="text" name="storage" id="inputStorage" class="form-control">
                                    @if ($errors->has('storage'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('storage') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputVGA">VGA</label>
                                    <input type="text" name="vga" id="inputVGA" class="form-control">
                                    @if ($errors->has('vga'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('vga') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputScreen">Màn hình</label>
                                    <input type="text" name="screen" id="inputScreen" class="form-control">
                                    @if ($errors->has('screen'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('screen') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputBattery">Pin</label>
                                    <input type="text" name="battery" id="inputBattery" class="form-control">
                                    @if ($errors->has('battery'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('battery') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputOS">Hệ điều hành</label>
                                    <input type="text" name="os" id="inputOS" class="form-control">
                                    @if ($errors->has('os'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('os') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <input type="submit" value="Lưu" class="btn btn-success">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
