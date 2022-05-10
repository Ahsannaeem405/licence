@extends('Admin.layout.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                @if(Session::has("success"))
                                <div class="alert alert-success shadow shadow-lg"> {{Session::get("success")}} </div>
                                @endif
                                <!-- <div>Helo</div> -->
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

                                                <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 129px;">Phone #</th> -->

                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 129px;">Role</th>

                                                <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 129px;">Assets</th> -->


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
                                            <th rowspan="1" colspan="1">Phone #</th>


                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach ($users as $user )
                                        @php
                                          $i++;
                                        @endphp
                                        <tr class="odd">
                                            <td class="sorting_1">{{$i}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <!-- <td>{{$user->phone}}</td> -->
                                            <td> 
                                            <div class="dropdown show">
  <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        @php 
                                                        $urole = strtoupper($user->user_role)
                                                       
                                                        @endphp
                                                        {{$urole}}
  </a>

                                         <div class="dropdown-menu shadow shadow-lg" aria-labelledby="dropdownMenuLink">
                                                    @if(Auth::user()->user_role == "super_admin")
                                                    <a class="dropdown-item" href="{{ route('updateRole', ['role' => 'admin', 'id' => $user->id]) }}"> Admin </a>
                                                    @endif

                                                    @if(Auth::user()->user_role == "super_admin" ||Auth::user()->user_role == "admin")
                                                    <a class="dropdown-item" href="{{ route('updateRole', ['role' => 'csr', 'id' => $user->id]) }}"> CSR </a>
                                                    @endif

                                                    @if(Auth::user()->user_role == "super_admin" ||Auth::user()->user_role == "admin" ||Auth::user()->user_role == "csr")
                                                    <a class="dropdown-item" href="{{ route('updateRole', ['role' => 'client', 'id' => $user->id]) }}"> Client </a>
                                                    @endif
                                                  
                                                      
                                                       
                                               
   
                                             </div>
                                        </div>
                                              
                                            </td>

                                            <!-- <td><a href="" class=""> View</a></td> -->


                                            <td>
                                                <a href="{{route('editUser', ['id' => $user->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                                <a href="{{route('deleteUser', ['id' => $user->id])}}" class="btn btn-danger confirmDelete"><i class="fas fa-trash"></i></a>
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
    <!-- /.container-fluid -->

    @section("custom-js")
    <script>
        $(document).ready( function () {
            // alert("helo")
            $('#myTable').DataTable();

            $(".confirmDelete").on("click",function(){
                return confirm("Are you sure to delete this user ?");
            })
        } );
    </script>
    @endsection
@endsection
