@extends('Admin.layout.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Assets</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="myTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" style="width: 179px;">
                                                #</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 274px;">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 129px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Age: activate to sort column ascending"
                                                style="width: 59px;"></th>

                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 109px;">Action</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">No</th>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Age</th>

                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        @foreach($license as $show)
                                        <tr class="odd">
                                            <td class="sorting_1"> {{$loop->iteration}} </td>
                                            <td> {{$show->name}} </td>
                                            <td>{{$show->email}}</td>
                                            <td>{{$show->phone}}</td>
                                            <td>
                                            <a href="{{url('admin/user_assets', ['id' => $show->id])}}" class="btn btn-primary">View Assets</a>
                                            </td>

                                            
                                        </tr>
                                        @endforeach
                                        <!-- <tr class="even">
                                            <td class="sorting_1">2</td>
                                            <td>Rock</td>
                                            <td>Rock619@gmail.com</td>
                                            <td>41</td>

                                            <td>
                                                {{-- <a href="{{url('admin/edituser')}}" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal1">View Assets</a> --}}
                                                <a href="{{url('admin/user_assets')}}" class="btn btn-primary">View Assets</a>

                                                {{-- <button class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                                            </td>
                                        </tr> -->


                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
    <!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assets</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-12 text-center">
                <h4>License Detail</h4>
              </div>
              <div class="col-12 text-center">
                    <img src="{{asset('img/license.jpg')}}" width="60%" class="rounded" alt="">
                    <a href="{{asset('img/license.jpg')}}" class="float-right" download>Download</a>
              </div>
              <div class="col-md-6 col-12 pt-2">
                  <label for=""><b>Name</b></label>
                  <h6>Usman</h6>
              </div>
              <div class="col-md-6 col-12 pt-2">
                <label for=""><b>Issue date</b></label>
                <h6>16/02/2019</h6>

              </div>
              <div class="col-md-6 col-12 pt-2">
                <label for=""><b>Expire date</b></label>
                <h6>16/02/2025</h6>

              </div>
              <div class="col-md-6 col-12 pt-2">
                <label for=""><b>Blood Group</b></label><br>
                <b class="text-danger">A+</b>

              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
@section("custom-js")
    <script>
        $(document).ready( function () {
            // alert("helo")
            $('#myTable').DataTable();
        } );
    </script>
    @endsection