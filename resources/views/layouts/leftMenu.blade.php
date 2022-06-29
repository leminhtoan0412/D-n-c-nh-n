<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('vendors/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/storage/{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('accounts.show', ['account' => Auth::user()]) }}"
                    class="d-block">{{ Auth::user()->full_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('accounts.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Tài khoản
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-border-all"></i>
                        <p>
                            Danh mục
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>

              

                <li class="nav-item">
                    <a href="{{ route('product_images.index') }}" class="nav-link">
                        <i class="nav-icon far fa-images"></i>
                        <p>
                            Ảnh sản phẩm
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Đơn hàng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('invoices.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoices.processing') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn chờ xử lý</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoices.being_transported') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn đang vận chuyển</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoices.completed') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn đã hoàn thành</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoices.cancelled') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn đã hủy</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('shippings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                        <p>
                            Đơn vị vận chuyển
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('reviews.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Bình luận và đánh giá
                        </p>
                    </a>
                </li>

                <li class="nav-item mt-4">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>
                            Đăng xuất
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

        <!-- /.sidebar -->
</aside>
