@extends('admin.layouts.app')
@section('title', 'Users List')

@section('admin-content')


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
                <h3>Manage <small>Users</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
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
                    <h2>List of Users</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Registration Date</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Active</th>
                          <th>Role</th>
                          <th>Edit</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->formatted_created_at }}</td>
                          <td>{{ $user->full_name }}</td>
                          <td>{{ $user->user_name }}</td>
                          <td>{{ $user->email }}</td>

                          {{-- Role --}}
                          <td>
                            @if($user->is_admin)
                            <span class="badge badge-success">Admin</span>
                            @else
                            <span class="badge badge-secondary">User</span>
                            @endif
                          </td>

                          {{-- status --}}
                          <td>
                            @if($user->is_active)
                            <span class="badge badge-success">Yes</span>
                            @else
                            <span class="badge badge-secondary">No</span>
                            @endif
                          </td>

                          <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}">
                            <img src="{{ asset('admin/images/edit.png') }}" alt="Edit">
                            </a>
                          </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                    
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection