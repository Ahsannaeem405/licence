@extends('layout.layout')


@section('content')
    <section>


        <div class="container-fluid py-3 px-5">
            <div class="row">
                <div class="col-12 py-2">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus-circle text-light"></i> Add License/Certificate</button>
                   {{-- <div class="row">
                       <div class="col-md-4 offset-md-8 col-12">
                            <a href="#" class="Cardancor">
                        <div class="py-4 border_radius bg_card text-dark animation-y mx-auto active1">
                            <h5><i class="fas fa-plus-circle text-primary"></i> Add License/Certificate</h5>
                        </div>
                    </a>
                       </div>

                   </div> --}}
                </div>
                    @if(Session::has("success"))
                 <div class="alert alert-success text-center" role="alert">
                  <strong>Successful!</strong> {{Session::get("success")}}
                 
                </div>
                    @endif

                {{-- <div class="col-md-4 col-12 mt-5 text-center ">
                    <a href="#" class="Cardancor">
                    <div class="py-4 border_radius bg_card2 text-dark animation-y">
                        <h5><i class="fas fa-check-circle text-success"></i> Active Certification</h5>
                    </div>
                </a>
                </div>


                <div class="col-md-4 col-12 mt-5 text-center ">
                    <a href="#" class="Cardancor">
                    <div class="py-4 border_radius bg_card3 text-dark animation-y">
                        <h5><i class="fas fa-clock text-warning"></i> Expiring Soon</h5>
                    </div>
                </a>
                </div>


                <div class="col-md-4 col-12 mt-5 text-center ">
                    <a href="#" class="Cardancor">
                    <div class="py-4 border_radius bg_card4 text-dark animation-y">
                        <h5><i class="fas fa-times-circle text-danger"></i> Expired Certification</h5>
                    </div>
                </a>
                </div> --}}



            </div>
            {{-- nav tabs --}}
            
            <div class="row">
                <div class="col-12 pt-3 text-center">
                    <h3 class="d-md-none d-block">Certificate/License</h3>
                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link border-end border_radius0 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-check-circle text-success"></i> <span class="d-md-inline d-none"> Active Certification</span>
                          <span class="badge bg-danger rounded-circle d-md-inline d-none"> {{$license->count()}} </span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link border-end border_radius0" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-clock text-warning"></i> <span class="d-md-inline d-none"> Expiring Soon</span> 
                           </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link border_radius0" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-times-circle text-danger"></i> <span class="d-md-inline d-none"> Expired Certification </span><span class="badge bg-danger rounded-circle d-md-inline d-none">{{ $expired->count() }}</span></button>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        @if(!$license->count())
                       <div class="image-fluid">
                          <img src="{{ asset('empty.png') }}" alt="">
                       </div>
                       @endif
                        <div class="d-flex">
                        <form align='center' id="sortForm" method="POST" action="{{ route('sortBy') }}" class="form w-20 text-center m-auto" style="width: 300px;">
                        @csrf
                        <!-- <label for="sorting">Sort by</label> -->
                            <select id="sorting" name="sorting" class="form-select" aria-label="Default select example">
                                <option value="" selected>Sort by.....</option>
                                <option value="asc">Ascending </option>
                                <option value="desc">Descending  </option>
                            </select>
                        </form>

                        <form action="{{ route('filter') }}" method="POST" class="m-auto d-flex"   style="width: 300px;">
                        @csrf
                            <input type="text" class="form-control" name="filterData" placeholder="Search...">
                            <input type="submit" class="btn btn-primary"  value="Search">
                        </form>
                        </div>
                        

                        @foreach($license as $show)
                        
                            <div class="row py-2 px-2 my-4 border_radius">
                                <div class="col-md-4 col-12 mt-3 ">
                                   
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @php
                                            $docs = json_decode($show->document)
                                            @endphp
                                            @php
                                                $x=1;
                                            @endphp
                                            @foreach($docs as $imgs)
                                          <div class="carousel-item @if ($x==1)
                                              active
                                          @endif">
                                            <img src="{{asset('uploadFile/'.$imgs)}}" class="d-block w-100" alt="...">
                                          </div>
                                          @php
                                              $x++;
                                          @endphp
                                          @endforeach
                                          <!-- <div class="carousel-item">
                                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                                          </div>
                                          <div class="carousel-item">
                                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                                          </div> -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                      </div>

                                </div>
                                <div class="col-md-8 col-12 mt-3 p-md-5 d-flex align-items-center justify-content-around">

                                        <div class="p-2">
                                            <h3>{{$show->name}}</h3>
                                            <!-- <h3 class="mt-2">American Red Cross</h3> -->
                                            <p class="mt-2 text-dark">
                                                {{$show->detail}}
                                            </p>
                                            <p class="mt-2 text-dark p_bold"><strong class="text-danger">Expiry</strong>: <span class="text-primary">{{$show->expiry}}</span></p>

                                        </div>
                                        <div>
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal{{$show->id}}"><i class="fas fa-edit"></i> Edit</button><br>
                                            <button class="btn btn-success mt-4 w-100 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal{{$loop->iteration}}"><i class="fas fa-eye"></i> View</button><br>

                                            <a href="{{ route('license-del', ['id' => $show->id]) }}" id="delete" class="btn btn-danger mt-4 w-100 confirmDel"><i class="fas fa-trash"></i> Delete</a>

                                        </div>



                                </div>
                            </div>

                           

                            


                            <!-- View Model -->
                            <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row py-2 px-2 my-2 border_radius">
                <div class="col-md-6 col-12 mt-3 ">

                    <div id="carouselExampleControls4" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        @php
                                            $docs = json_decode($show->document)
                                            @endphp
                                            @php
                                                $x=1;
                                            @endphp
                                            @foreach($docs as $imgs)
                                          <div class="carousel-item @if ($x==1)
                                              active
                                          @endif">
                                            <img src="{{asset('uploadFile/'.$imgs)}}" class="d-block w-100" alt="...">
                                          </div>
                                          @php
                                              $x++;
                                          @endphp
                                          @endforeach
                         
                          <!-- <div class="carousel-item">
                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                          </div> -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls4" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls4" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>

                </div>
                <div class="col-md-6 col-12 mt-3 p-md-5 d-flex align-items-center justify-content-around">


                    <div class="p-2">
                        <h3>{{ $show->name }}</h3>
                        <!-- <h3 class="mt-2">American Red Cross</h3> -->
                        <p class="mt-2 text-dark">
                            {{$show->detail}}
                        </p>
                        <p class="mt-2 text-dark p_bold">Expires {{$show->expiry}}</p>

                    </div>




                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
                            <!-- End view model -->


                            <!-- Update model -->
                            <div class="modal fade" id="editModal{{$show->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Update License/Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">Update License/Certificate</h2>
                            <p>Fill all form field to go to next step</p>
                            <form id="msform" method="post" action="{{ route('update') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>License</strong></li>
                                    <li id="personal"><strong>Details</strong></li>
                                    <li id="payment"><strong>Image</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">License/Certificate Name:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">License Name: *</label>
                                        <input type="text" name="name" value="{{$show->name}}"  id="license_name" placeholder="License/Certificate Name" />
                                    </div> <input type="button" id="next1" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Certificate Detail:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">Detail: *</label>
                                        <textarea name="detail" value="" id="license_detail" class="form-control" rows="5" placeholder="Enter Detail of Certificate">{{$show->detail}}</textarea>
                                        <label for="license_expiry" class="fieldlabels">License Expiry *</label>
                                        <input type="date" name="expiry" value="{{$show->expiry}}" id="license_expiry" >
                                        <input type="text" hidden name="id" value="{{$show->id}}" id="license_expiry" >
                                    </div> <button type="button" id="next2" name="next" class="next action-button" value="Next" >Next </button>
                                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row image_div">
                                            <div class="col-7">
                                                <h2 class="fs-title">Image Upload:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary float-end add_image" type="button" id="add_image">Add Image</button>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn float-end my-3 visibility_none"><i class="fas fa-trash text-danger"></i></button>
                                                    </div>
                                                </div>
                                                <input name="file[]" id="license_file" type="file" class="dropify" data-height="100"  />
                                            </div>
                                        {{-- </div>   <input name="file" id="license_file" type="file"  class="dropify" data-height="100"  /> --}}
                                    </div> <input type="submit" id="finish" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Finish:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                        <div class="row justify-content-center">
                                            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div> 
                                        </div> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer border-0">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div> --}}
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Edit New License/Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">Edit License/Certificate</h2>
                            <p>Fill all form field to go to next step</p>
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>License</strong></li>
                                    <li id="personal"><strong>Details</strong></li>
                                    <li id="payment"><strong>Image</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">License/Certificate Name:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">License Name: *</label> <input type="text" name="name" placeholder="License/Certificate Name" />
                                    </div> <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Certificate Detail:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">Detail: *</label> <textarea name="detail" id="" class="form-control" rows="5" placeholder="Enter Detail of Certificate"></textarea>
                                    </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Image Upload:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                        </div>   <input name="file1" type="file"  class="dropify"  data-height="100" required />
                                    </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Finish:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                        <h4 class="purple-text text-center"><strong>SUCCESS !</strong></h4> <br>
                                        {{-- <div class="row justify-content-center">
                                            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                        </div> <br><br> --}}
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer border-0">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div> --}}
      </div>
    </div>
  </div>
                            <!-- end update model -->
                        @endforeach


                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                        @if(empty($soon))
                       <div class="image-fluid">
                          <img src="{{ asset('empty.png') }}" alt="">
                       </div>
                       @endif
                            @foreach($soon as $expSoon)
                            <div class="row py-2 px-2 my-4 border_radius">
                                <div class="col-md-4 col-12 mt-3 ">
                                    {{-- <div class="">
                                        <img src="{{asset('img/PA-Medical-License.jpg')}}" class="img-fluid" alt="">

                                    </div> --}}
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                        @php
                                            $docs = json_decode($show->document)
                                            @endphp
                                            @php
                                                $x=1;
                                            @endphp
                                            @foreach($docs as $imgs)
                                          <div class="carousel-item @if ($x==1)
                                              active
                                          @endif">
                                            <img src="{{asset('uploadFile/'.$imgs)}}" class="d-block w-100" alt="...">
                                          </div>
                                          @php
                                              $x++;
                                          @endphp
                                          @endforeach
                                          <!-- <div class="carousel-item active">
                                            <img src="{{asset('uploads/'.$expSoon['document'])}}" class="d-block w-100" alt="...">
                                          </div> -->
                                          <!-- <div class="carousel-item">
                                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                                          </div>
                                          <div class="carousel-item">
                                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                                          </div> -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                      </div>

                                </div>
                                <div class="col-md-8 col-12 mt-3 p-md-5 d-flex align-items-center justify-content-around">


                                    <div class="p-2">
                                    <h1>
  <span href="" class="typewrite text-danger bold shadow shadow-lg" data-period="2000" data-type='[ "Expriring Soon", "Expriring Soon", "Expriring Soon", "Expriring Soon" ]'>
    <span class="wrap"></span>
                                    </span>
</h1>
                                    <!-- <marquee  width="100%" direction="left" height="100px">Expiring Soon</marquee> -->
                                        <h3>{{$expSoon["name"]}}</h3>
                                        <!-- <h3 class="mt-2">American Red Cross</h3> -->
                                        <p class="mt-2 text-dark">
                                            {{$expSoon["detail"]}}
                                        </p>
                                        <p class="mt-2 text-dark p_bold"><span class="text-danger bold">Expiry:</span> {{$expSoon["expiry"]}}</p>

                                    </div>
                                        <!-- <div>
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fas fa-edit"></i> Edit</button><br>
                                            <button class="btn btn-warning mt-4 w-100 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fas fa-eye"></i> View</button><br>

                                            <button class="btn btn-danger mt-4 w-100 delete"><i class="fas fa-trash"></i> Delete</button>

                                        </div> -->



                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        @if(!$expired->count())
                       <div class="image-fluid">
                          <img src="{{ asset('empty.png') }}" alt="">
                       </div>
                       @endif

                        @foreach($expired as $output)
                            <div class="row py-2 px-2 my-4 border_radius">
                                <div class="col-md-4 col-12 mt-3 ">
                                    {{-- <div class="">
                                        <img src="{{asset('img/PA-Medical-License.jpg')}}" class="img-fluid" alt="">

                                    </div> --}}
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                        @php
                                            $docs = json_decode($output->document)
                                            @endphp
                                            @php
                                                $x=1;
                                            @endphp
                                            @foreach($docs as $imgs)
                                          <div class="carousel-item @if ($x==1)
                                              active
                                          @endif">
                                            <img src="{{asset('uploadFile/'.$imgs)}}" class="d-block w-100" alt="...">
                                          </div>
                                          @php
                                              $x++;
                                          @endphp
                                          @endforeach
                                          {{-- <div class="carousel-item active">
                                            <img src="{{asset('uploads/'.$output->document)}}" class="d-block w-100" alt="...">
                                          </div> --}}



                                          <!-- <div class="carousel-item">
                                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                                          </div>
                                          <div class="carousel-item">
                                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                                          </div> -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                      </div>

                                </div>
                                <div class="col-md-8 col-12 mt-3 p-md-5 d-flex align-items-center justify-content-around">


                                    <div class="p-2">
                                        <h3>{{$output->name}}</h3>
                                        <!-- <h3 class="mt-2">American Red Cross</h3> -->
                                        <p class="mt-2 text-dark">
                                            {{$output->detail}}
                                        </p>
                                        <p class="mt-2 text-dark p_bold"><span class="text-danger">Expired: </span> {{$output->expiry}}</p>

                                    </div>
                                        <div>
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#expireEditModal{{$output->id}}"><i class="fas fa-edit"></i> Edit</button><br>
                                            <button class="btn btn-warning mt-4 w-100 text-light" data-bs-toggle="modal" data-bs-target="#expireModal{{$loop->iteration}}"><i class="fas fa-eye"></i> View</button><br>

                                            <a href="{{ route('license-del', ['id' => $output->id]) }}" id="delete" class="btn btn-danger mt-4 w-100 confirmDel"><i class="fas fa-trash"></i> Delete</a>

                                        </div>



                                </div>
                            </div>



                             <!-- View Model -->
                             <div class="modal fade" id="expireModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row py-2 px-2 my-2 border_radius">
                <div class="col-md-6 col-12 mt-3 ">

                    <div id="carouselExampleControls4" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{asset('uploads/'.$output->document)}}" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="{{asset('img/PA-Medical-License.jpg')}}" class="d-block w-100" alt="...">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls4" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls4" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>

                </div>
                <div class="col-md-6 col-12 mt-3 p-md-5 d-flex align-items-center justify-content-around">


                    <div class="p-2">
                        <h3>{{ $output->name }}</h3>
                        <!-- <h3 class="mt-2">American Red Cross</h3> -->
                        <p class="mt-2 text-dark">
                            {{$output->detail}}
                        </p>
                        <p class="mt-2 text-dark p_bold">Expires {{$output->expiry}}</p>

                    </div>




                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
                            <!-- End view model -->


                            <!-- Update model -->
                            <div class="modal fade" id="expireEditModal{{$output->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Update License/Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">Update License/Certificate</h2>
                            <p>Fill all form field to go to next step</p>
                            <form id="msform" method="post" action="{{ route('update') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>License</strong></li>
                                    <li id="personal"><strong>Details</strong></li>
                                    <li id="payment"><strong>Image</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">License/Certificate Name:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">License Name: *</label>
                                        <input type="text" name="name" value="{{$output->name}}"  id="license_name" placeholder="License/Certificate Name" />
                                    </div> <input type="button" id="next1" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Certificate Detail:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">Detail: *</label>
                                        <textarea name="detail" value="" id="license_detail" class="form-control" rows="5" placeholder="Enter Detail of Certificate">{{$output->detail}}</textarea>
                                        <label for="license_expiry" class="fieldlabels">License Expiry *</label>
                                        <input type="date" name="expiry" value="{{$output->expiry}}" id="license_expiry" >
                                        <input type="text" hidden name="id" value="{{$output->id}}" id="license_expiry" >
                                    </div> <button type="button" id="next2" name="next" class="next action-button" value="Next" >Next </button>
                                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row image_div">
                                            <div class="col-7">
                                                <h2 class="fs-title">Image Upload:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary float-end add_image" type="button" id="add_image">Add Image</button>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn float-end my-3 visibility_none"><i class="fas fa-trash text-danger"></i></button>
                                                    </div>
                                                </div>
                                                <input name="file[]" id="license_file" type="file" class="dropify" data-height="100"  />
                                            </div>
                                        </div>
                                        {{-- <input name="file" id="license_file" type="file"  class="dropify" data-height="100"  /> --}}
                                    </div> <input type="submit" id="finish" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Finish:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                                <img src="data:image/png;base64,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" alt="">

                                        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                        <div class="row justify-content-center">
                                            {{-- <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div> --}}
                                        </div> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <img src="data:image/png;base64,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" alt="">
                                                <h5 class="purple-text text-center">You Have Successfully added your license</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer border-0">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div> --}}
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Edit New License/Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">Edit License/Certificate</h2>
                            <p>Fill all form field to go to next step</p>
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>License</strong></li>
                                    <li id="personal"><strong>Details</strong></li>
                                    <li id="payment"><strong>Image</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">License/Certificate Name:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">License Name: *</label> <input type="text" name="name" placeholder="License/Certificate Name" />
                                    </div> <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Certificate Detail:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">Detail: *</label> <textarea name="detail" id="" class="form-control" rows="5" placeholder="Enter Detail of Certificate"></textarea>
                                    </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Image Upload:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                        </div>   <input name="file1" type="file"  class="dropify" data-height="100" required />
                                    </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Finish:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                        <h4 class="purple-text text-center"><strong>SUCCESS !</strong></h4> <br>
                                        {{-- <div class="row justify-content-center">
                                            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                        </div> <br><br> --}}
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer border-0">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div> --}}
      </div>
    </div>
  </div>
                            <!-- end update model -->
                            @endforeach
                        </div>
                      </div>

                </div>
            </div>
        </div>
    </section>
    {{-- <section>
        <div class="container-fluid py-2 px-5">
            <div class="row py-2 px-2">
                <div class="col-md-5 col-12 mt-3 ">
                    <div class="">
                        <img src="{{asset('img/PA-Medical-License.jpg')}}" class="img-fluid" alt="">

                    </div>

                </div>
                <div class="col-md-7 col-12 mt-3 p-md-5 d-flex align-items-center">

                        <div>
                            <h3>Pediatric Life Support</h3>
                            <h3 class="mt-2">American Red Cross</h3>
                            <p class="mt-2 text-dark p_bold">Expires 06/30/2023</p>
                            <a href="#" class="btn btn-primary mt-4">Read More </a>
                        </div>



                </div>
            </div>
        </div>
    </section> --}}
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Add New License/Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">Add New License/Certificate </h2>
                            <p>Fill all form field to go to next step</p>
                            <form id="msform" method="post" action="{{ route('license') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>License</strong></li>
                                    <li id="personal"><strong>Details</strong></li>
                                    <li id="payment"><strong>Image</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">License/Certificate Name:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">License Name: *</label>
                                        <input type="text" name="name"  id="license_name" placeholder="License/Certificate Name" />
                                    </div> <input type="button" id="next1" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Certificate Detail:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">Detail: *</label>
                                        <textarea name="detail" id="license_detail" class="form-control" rows="5" placeholder="Enter Detail of Certificate"></textarea>
                                        <label for="license_expiry" class="fieldlabels">License Expiry *</label>
                                        <input type="date" name="expiry" id="license_expiry" >
                                    </div> <button type="button" id="next2" name="next" class="next action-button" value="Next" >Next </button>
                                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row image_div">
                                            <div class="col-7">
                                                <h2 class="fs-title">Image Upload:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary float-end add_image" type="button" id="add_image">Add Image</button>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn float-end my-3 visibility_none"><i class="fas fa-trash text-danger"></i></button>
                                                    </div>
                                                </div>
                                                <input name="file[]" id="license_file" type="file" class="dropify" data-height="100"  />
                                            </div>
                                        {{-- </div>   <input name="file[]" id="license_file" type="file" multiple   class="dropify" data-height="100"  /> --}}
                                    </div> <input type="submit" id="finish" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Finish:</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                        <div class="row justify-content-center">
                                            {{-- <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div> --}}
                                        </div> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5 class="purple-text text-center">You Have Successfully added license</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer border-0">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div> --}}
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Edit New License/Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">Edit License/Certificate</h2>
                            <p>Fill all form field to go to next step</p>
                            <form id="msform">
                            <!-- <form id=""> -->

                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>License</strong></li>
                                    <li id="personal"><strong>Details</strong></li>
                                    <li id="payment"><strong>Image</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">License/Certificate Name:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">License Name: *</label> <input type="text" name="name" placeholder="License/Certificate Name" />
                                    </div> <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Certificate Detail:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div> <label class="fieldlabels">Detail: *</label> <textarea name="detail" id="" class="form-control" rows="5" placeholder="Enter Detail of Certificate"></textarea>
                                    </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Image Upload:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                        </div>   <input name="file1" type="file"  class="dropify" data-height="100" required />
                                    </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="fs-title">Finish:</h4>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                        <h4 class="purple-text text-center"><strong>SUCCESS !</strong></h4> <br>
                                        {{-- <div class="row justify-content-center">
                                            <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                        </div> <br><br> --}}
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer border-0">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div> --}}
      </div>
    </div>
  </div>



  <!-- Modal -->


  

@endsection

@section("custom-js")
<script>
    $(document).ready(function(){

        $("#sorting").on("change", function(){
            // alert("helo");
            $("#sortForm").submit();
        });

        $(".confirmDel").on("click", function(){
            return confirm("If you want to delete press OK");
        });


        $(document).on('click', '.del', function() {
            $(this).closest( ".drop_div" ).remove();

        $(this).closest('#removeTr').remove();


       
    });
//         $( ".del" ).click(function() {
//   alert( "Handler for .click() called." );

//     $(this).closest( ".drop_div" ).remove();
// });

        $( ".add_image" ).click(function() {


            $('.image_div').append(`  <div class="col-6 mt-2 drop_div">
                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn float-end my-3 del"><i class="fas fa-trash text-danger"></i></button>
                                                    </div>
                                                </div>
                                                <input name="file[]" id="license_file" type="file" class="dropify" data-height="100"  />
                                            </div>`);
                                            $('.dropify').dropify();
});
    });

    //made by vipul mirajkar thevipulm.appspot.com
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>


@endsection
