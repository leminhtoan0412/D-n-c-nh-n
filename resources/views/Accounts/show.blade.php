@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('accounts.update', ['account' => $account]) }}" enctype="multipart/form-data">
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Ảnh đại diện</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img src="{{ $account->avatar }}" class="img-account-profile rounded-circle mb-2"
                                style="width:300px;height:300px;">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG không quá 5 MB</div>
                            <!-- Profile picture upload button-->
                            <div class="custom-file">
                                <input type="file" name="image" id="avatars">
                            </div>
                            @if ($errors->has('image'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Tài khoản #{{ $account->id }}</div>
                        <div class="card-body">
                            @csrf
                            @method('PATCH')
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Họ tên</label>
                                <input class="form-control" id="inputUsername" name="fullname" type="text"
                                    placeholder="Nhập họ và tên" value="{{ $account->full_name }}">
                                @if ($errors->has('fullname'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('fullname') }}
                                    </div>
                                @endif
                            </div>
                            <!-- Form Row-->
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                    <input class="form-control" id="inputEmailAddress" name="email" type="email"
                                        placeholder="Nhập email" value="{{ $account->email }}">
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Mật khẩu</label>
                                    <input class="form-control" id="inputLocation" type="password" name="password"
                                        placeholder="nhập mật khẩu" value="{{ $account->password }}">
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Điện thoại</label>
                                    <input class="form-control" id="inputPhone" type="tel" name="phone"
                                        placeholder="Nhập số điện thoại" value="{{ $account->phone }}">
                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Ngày sinh</label>
                                    <input class="form-control" id="inputBirthday" type="date" name="birthday"
                                        placeholder="Enter your birthday" value="{{ $account->birthday }}">
                                    @if ($errors->has('birthday'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('birthday') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email address)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Địa chỉ</label>
                                    <input class="form-control" id="inputEmailAddress" name="address" type="text"
                                        placeholder="Nhập địa chỉ của bạn" value="{{ $account->address }}">
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Giới tinh</label>
                                        <div class="custom-control custom-radio">
                                            <input value="0" class="custom-control-input" type="radio" id="customRadio1"
                                                name="sex" @if ($account->sex == 0)
                                            checked
                                            @endif>
                                            <label for="customRadio1" class="custom-control-label">Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input value="1" class="custom-control-input" type="radio" id="customRadio2"
                                                name="sex" @if ($account->sex == 1)
                                            checked
                                            @endif>
                                            <label for="customRadio2" class="custom-control-label">Nữ</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input value="2" class="custom-control-input" type="radio" id="customRadio3"
                                                name="sex" @if ($account->sex == 2)
                                            checked
                                            @endif>
                                            <label for="customRadio3" class="custom-control-label">Khác</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Form Row-->

                            <!-- Save changes button-->

                            <button class="btn btn-success" type="submit">Lưu</button>
                            <a href="/accounts" class="btn btn-primary">Xong</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

