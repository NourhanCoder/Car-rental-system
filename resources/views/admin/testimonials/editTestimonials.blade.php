@extends('admin.layouts.app')
@section('title', 'Edit Testimonials')

@section('admin-content')

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage Testimonials</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
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
									<h2>Edit Testimonial</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        @method('PUT')

                                        <!-- Name -->
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required="required" class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Position -->
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="position">Position <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="position" name="position" value="{{ old('position', $testimonial->position) }}" required="required" class="form-control @error('position') is-invalid @enderror">
                                                @error('position')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <textarea id="content" name="content" required="required" class="form-control @error('content') is-invalid @enderror">{{ old('content', $testimonial->content) }}</textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <!-- Published -->
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Published</label>
                                            <div class="checkbox col-md-6 col-sm-6" style="padding-top: 6px;">
                                                <label>
                                                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $testimonial->is_published) ? 'checked' : '' }} class="flat">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @if ($testimonial->image)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Current Image" width="100" class="img-thumbnail">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary">Cancel</a>
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