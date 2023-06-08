@extends('admin.admin_master')
@section('admin')

<div class="page-content">
     <div class="container-fluid">
     <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <center>
                                    <img  class="rounded-circle avatar-xl" src="{{(!empty($admindata->profile_image))? url('upload/admin_images/'.$admindata->profile_image):url('upload/No_Image_Available.jpg') }}" alt="Card image cap">
</center>
                                    <div class="card-body">
                                        <h4 class="card-title">Name :{{$admindata->name}}</h4>
                                        <hr>
                                        <h4 class="card-title">Email :{{$admindata->email}}</h4>
                                        <hr>
                                        <h4 class="card-title">Username :{{$admindata->username}}</h4>
                                        <hr>
                                        <a href="{{ route('edit.profile')}}" class="btn btn-primary waves-effect waves-light"> Edit Profile</a>


                                        <!-- <p class="card-text">This is a wider card with supporting text below as a
                                            natural lead-in to additional content. This content is a little bit
                                            longer.</p>
                                        <p class="card-text">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </p> -->
                                    </div>
                                </div>
                            </div>
        
                            
        
                        </div>
</div>
</div>

@endsection