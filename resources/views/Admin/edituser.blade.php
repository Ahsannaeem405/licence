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
                <form action="{{route('updateUserInfo')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-12 py-2">
                        <label for=""><b>Profile Image:</b></label>

                    <input name="file" type="file"  class="dropify" data-height="100" required />
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Name</b></label>
                        <input type="text" name="id" hidden value="{{ isset($user->id) ? $user->id : '' }}">
                        <input type="text" name="name" required value="{{ isset($user->name) ? $user->name : '' }}" placeholder="Name" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Email</b></label>
                        <input type="email" name="email" required value="{{ isset($user->email) ? $user->email : '' }}" placeholder="Email" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Mobile #</b></label>
                        <input type="text" name="mobile" required value="{{ isset($user->phone) ? $user->phone : '' }}" placeholder="Number" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Billing Address</b></label>
                        <input type="text" name="address" required value="{{ isset($user->billing_address) ? $user->billing_address : '' }}" placeholder="Billing Address" class="form-control mt-1">
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
                        <textarea name="info" required id="" value="" class="form-control mt-1" rows="3" placeholder="Billing Information"> {{ isset($user->billing_info) ? $user->billing_info : '' }}</textarea>

                    </div>
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
