@extends('admin.layouts.app')
@section('title', 'Show Messages')

@section('admin-content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Messages</h3>
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
                  <h2><strong>Full Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</h2>
                        <br>
                        <h2><strong>Email:</strong> {{ $contact->email }}</h2>
                        <br>
                        <h2><strong>Date:</strong> {{ $contact->created_at->format('Y-m-d H:i A') }}</h2>
                        <br>
                        <h2><strong>Message Content:</strong></h2>
                        <p class="lead" style="white-space: pre-line;">{{ $contact->message }}</p>
                        
                        <hr>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Back to Messages</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection