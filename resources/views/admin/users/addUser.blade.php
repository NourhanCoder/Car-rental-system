@extends('admin.layouts.app')
@section('title', 'Add User')

@section('admin-content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Manage Users</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add User</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="#">Settings 1</a></li>
                                        <li><a class="dropdown-item" href="#">Settings 2</a></li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />


                            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
                                class="form-horizontal form-label-left">
                                @csrf

                                {{-- Full Name --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="full_name">Full Name
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                            class="form-control @error('full_name') is-invalid @enderror">
                                        @error('full_name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Username --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="user_name">Username
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}"
                                            class="form-control @error('user_name') is-invalid @enderror">
                                        @error('user_name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="item form-group">
                                    <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="email" class="form-control @error('email') is-invalid @enderror"
                                            type="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Active Checkbox --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
                                    <div class="col-md-6 col-sm-6 style-checkbox">
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ old('is_active', true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                                {{-- Role --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="role">Role <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id="role" name="role"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option value="">Select Role...</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User
                                            </option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Image Upload --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Profile
                                        Image</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="file" id="image" name="image"
                                            class="form-control-file @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="text-danger small d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Cancel</a>
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /page content -->
@endsection
