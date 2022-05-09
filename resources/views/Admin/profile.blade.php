
@extends('Admin.layout.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                @if(Session::has("success"))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <form action="{{route('userInfo')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-12 py-2">
                        <label for=""><b>Profile Image:</b></label>

                    <input name="file" type="file"  class="dropify" data-height="100" />
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Name</b></label>
                        <input type="text" name="id" hidden value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}">
                        <input type="text" name="name" required value="{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}" placeholder="Name" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Email</b></label>
                        <input type="email" name="email" required value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}" placeholder="Email" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Mobile #</b></label>
                        <input type="text" name="mobile" required value="{{ isset(Auth::user()->phone) ? Auth::user()->phone : '' }}" placeholder="Number" class="form-control mt-1">
                    </div>
                    @if(Auth::user()->role == "user")
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Billing Address</b></label>
                        <input type="text" name="address" required value="{{ isset(Auth::user()->billing_address) ? Auth::user()->billing_address : '' }}" placeholder="Billing Address" class="form-control mt-1">
                    </div>
                    <!-- <div class="col-md-6 col-12 py-2">
                        <label for=""><b>New Password</b></label>
                        <input type="password"  placeholder="Password" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Confirm Password</b></label>
                        <input type="password" placeholder="Password" class="form-control mt-1">
                    </div> -->
                    <div class="col-12 py-2">
                        <label for=""><b>Billing Information</b></label>
                        <textarea name="info" required id="" value="" class="form-control mt-1" rows="3" placeholder="Billing Information"> {{ isset(Auth::user()->billing_info) ? Auth::user()->billing_info : '' }}</textarea>

                    </div>
                    @endif
                    <div class="col-12 py-3">
                        <button class="btn btn-primary float-right">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
@endsection
