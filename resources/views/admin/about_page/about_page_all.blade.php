@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
     <div class="container-fluid">
     <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      <form method = "post" action="{{route ('update.about')}}" enctype="multipart/form-data">
                                    @csrf

                                    <input type ="hidden" name ="id" value="{{$about->id}}">
                                       
                                        <h4 class="card-title"> About Page</h4>
                                        <!--title-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input name ="title" class="form-control" type="text" value="{{$about ->title}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <!--short_title-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                            <div class="col-sm-10">
                                                <input name ="short_title" class="form-control" type="text" value="{{$about ->short_title}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <!--short description-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                            <div class="col-sm-10">
                                            <textarea required="" name="short_description" class="form-control" rows="5"> {{$about ->short_description}}</textarea>
                                            </div>
                                        </div>
                                        <!--long description-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                            <div class="col-sm-10">
                                            <textarea id="elm1"  name="long_description"> {{$about ->long_description}}</textarea>                                            </div>
                                        </div>


                                       <!--about_image-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                                            <div class="col-sm-10">
                                                <input name ="about_image" class="form-control" type="file"  id="image">
                                            </div>
                                        </div>
                                        <!--view Image-->
                                       <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                            <img id="about_image" class="rounded avatar-lg" src="{{(!empty($about->about_image))? url($about->about_image):url('upload/No_Image_Available.jpg') }}" alt="Card image cap">
                                            </div>
                                        </div>
                                       
                                        <input type ="submit" class="btn btn-info waves-effect waves-light" value ="Update About Page">

                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                                  
</div>
</div>
<script  type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#Showimage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
    </script>
@endsection



