@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Đang giao</h1>
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


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered  text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã hóa đơn</th>
                                            <th>Tên khách hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice as $inv)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $inv->code }}</td>
                                                <td>{{ $inv->account->full_name }}</td>
                                                <td>{{ $inv->total }}</td>
                                                <td>
                                                    @if ($inv->status == 2)
                                                        Đang vận chuyển

                                                    @endif
                                                </td>
                                                <td>{{ $inv->created_at }}</td>
                                                <td class="project-actions">
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('invoices.show', ['invoice' => $inv]) }}">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                        Xem
                                                    </a>
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ route('invoices.complete', ['id' => $inv]) }}">
                                                        <i class="fas fa-check"></i>
                                                        Đã giao
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                {{ $invoice->links() }}
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
