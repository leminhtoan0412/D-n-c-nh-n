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

    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        @if (!empty($product->images[0]))
                            <img src=" {{ $product->images[0]->path }}" class="product-image" alt="Product Image">
                        @endif
                    </div>
                    <div class="col-12 product-image-thumbs">
                        @foreach ($product->images as $img)
                            <div class="product-image-thumb active">
                                <img src="{{ $img->path }}" alt="">
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $product->name }}</h3>
                    <p><b>Mã sản phẩm:</b> {{ $product->code }}</p>
                    <hr>
                    <h4>Thông tin sản phẩm</h4>
                    <div>
                        <span>CPU: {{ $product->cpu }}</span><br>
                        <span>RAM: {{ $product->ram }}</span><br>
                        <span>Ổ cứng: {{ $product->storage }}</span><br>
                        <span>VGA: {{ $product->vga }}</span><br>
                        <span>Màn hình: {{ $product->screen }}</span><br>
                        <span>PIN: {{ $product->battery }}</span><br>
                        <span>OS: {{ $product->operating_system }}</span><br>
                        <span>Hãng sản xuất: {{ $product->category->name }}</span><br>
                    </div>
                    <div class="bg-gray py-2 px-3 mt-4">

                        <h2 class="mb-0">
                            Giá: {{ number_format($product->price) }} đ
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                            role="tab" aria-controls="product-desc" aria-selected="true">Mô tả </a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                        aria-labelledby="product-desc-tab">
                        {{ $product->description }} </div>
                </div>
            </div>
            <ol class="breadcrumb float-sm-right">
                <a href="{{ route('products.index') }}" class="btn btn-danger">Quay lại</a>
            </ol>
        </div>
        <!-- /.card-body -->
        
    </div>
    
    
@endsection
