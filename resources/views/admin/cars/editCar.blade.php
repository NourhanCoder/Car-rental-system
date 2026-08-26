@extends('admin.layouts.app')
@section('title', 'Edit Car')

@section('admin-content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Manage Cars</h3>
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
                            <h2>Edit Car</h2>
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
                            <form action="{{ route('admin.cars.update', $car->id) }}" method="POST"
                                enctype="multipart/form-data" class="form-horizontal form-label-left">
                                @csrf
                                @method('PUT')

                                <!-- Title -->
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="title" name="title"
                                            value="{{ old('title', $car->title) }}"
                                            class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="4">{{ old('content', $car->content) }}</textarea>
                                        @error('content')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Luggage -->
                                <div class="item form-group">
                                    <label for="luggage" class="col-form-label col-md-3 col-sm-3 label-align">Luggage <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="luggage" class="form-control @error('luggage') is-invalid @enderror"
                                            type="number" name="luggage" value="{{ old('luggage', $car->luggage) }}">
                                        @error('luggage')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Doors -->
                                <div class="item form-group">
                                    <label for="doors" class="col-form-label col-md-3 col-sm-3 label-align">Doors <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="doors" class="form-control @error('doors') is-invalid @enderror"
                                            type="number" name="doors" value="{{ old('doors', $car->doors) }}">
                                        @error('doors')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Passengers -->
                                <div class="item form-group">
                                    <label for="passengers" class="col-form-label col-md-3 col-sm-3 label-align">Passengers
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="passengers"
                                            class="form-control @error('passengers') is-invalid @enderror" type="number"
                                            name="passengers" value="{{ old('passengers', $car->passengers) }}">
                                        @error('passengers')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="item form-group">
                                    <label for="price" class="col-form-label col-md-3 col-sm-3 label-align">Price <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="price" class="form-control @error('price') is-invalid @enderror"
                                            type="number" step="0.01" name="price"
                                            value="{{ old('price', $car->price) }}">
                                        @error('price')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Discount Price -->
                                <div class="item form-group">
                                    <label for="discount_price"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Discount Price</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="discount_price"
                                            class="form-control @error('discount_price') is-invalid @enderror"
                                            type="number" step="0.01" name="discount_price"
                                            value="{{ old('discount_price', $car->discount_price) }}">
                                        @error('discount_price')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                                            id="status">
                                            <option value="">Select Status</option>
                                            <option value="available"
                                                {{ old('status', $car->status ?? '') == 'available' ? 'selected' : '' }}>
                                                Available</option>
                                            <option value="rented"
                                                {{ old('status', $car->status ?? '') == 'rented' ? 'selected' : '' }}>
                                                Rented</option>
                                            <option value="maintenance"
                                                {{ old('status', $car->status ?? '') == 'maintenance' ? 'selected' : '' }}>
                                                Maintenance</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Active Checkbox -->
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="is_active" value="1"
                                                    {{ old('is_active', $car->is_active) ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="image">Image</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="file" id="image" name="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        @if ($car->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image"
                                                    style="width: 200px; max-height: 150px; object-fit: cover;"
                                                    class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Category Dynamic Select -->
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_id">Category
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $car->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <a href="{{ route('admin.cars.index') }}" class="btn btn-primary">Cancel</a>
                                        <button type="submit" class="btn btn-success">Update</button>
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
