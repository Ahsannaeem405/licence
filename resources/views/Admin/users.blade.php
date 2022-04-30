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

                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 129px;">Phone #</th>


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
                                            <td>{{$user->phone}}</td>


                                            <td>
                                                <a href="{{route('editUser', ['id' => $user->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                                <a href="{{route('deleteUser', ['id' => $user->id])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
        } );
    </script>
    @endsection
@endsection
