@extends('Admin.layout.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                <div class="row">
                    <div class="col-12 py-2">
                        <label for=""><b>Profile Image:</b></label>

                    <input name="file1" type="file"  class="dropify" data-height="100" required />
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Name</b></label>
                        <input type="text" value="{{ isset($user->name) ? $user->name : '' }}" placeholder="Name" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Email</b></label>
                        <input type="email" value="{{ isset($user->email) ? $user->email : '' }}" placeholder="Email" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Number</b></label>
                        <input type="text" value="{{ isset($user->phone) ? $user->phone : '' }}" placeholder="Number" class="form-control mt-1">
                    </div>
                    <div class="col-md-6 col-12 py-2">
                        <label for=""><b>Billing Address</b></label>
                        <input type="text" value="{{ isset($user->billing_address) ? $user->billing_address : '' }}" placeholder="Billing Address" class="form-control mt-1">
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
                        <textarea name="" id="" value="{{ isset($user->name) ? $user->name : '' }}" class="form-control mt-1" rows="3" placeholder="Billing Information"></textarea>

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
