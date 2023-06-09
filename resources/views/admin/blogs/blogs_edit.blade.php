@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>

<div class="page-content">
     <div class="container-fluid">
     <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      <form method = "post" action="{{route ('update.blog')}}" enctype="multipart/form-data">
                                    @csrf

                                       <input type="hidden" name="id" value="{{$blogs ->id}}">
                                        <h4 class="card-title"> Edit Blog Page</h4>
                                        <!--Name-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                                            <div class="col-sm-10">
                                            <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                                    <option selected="">Open this select menu</option>
                                                    @foreach($category as $cat)
                                                    <option value="{{$cat->id}}" {{ $cat->id == $blogs->blog_category_id ? 'selected' :''}}>{{$cat->blog_gategory}}</option>
                                                    @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <!--title-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                                            <div class="col-sm-10">
                                                <input name ="blog_title" class="form-control" value="{{$blogs->blog_title}}" type="text"  id="example-text-input">
                                                @error('blog_title')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    <!--tage-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tage</label>
                                            <div class="col-sm-10">
                                                <input name ="blog_tags" value="{{$blogs->blog_tags}}" class="form-control" type="text"  data-role="tagsinput">
                                                @error('blog_tags')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <!-- description-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                                            <div class="col-sm-10">
                                            <textarea id="elm1"  name="blog_description">{{$blogs->blog_description}} </textarea>
                                            
                                        </div>
                                        </div>


                                       <!--image-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                                            <div class="col-sm-10">
                                                <input name ="blog_image" value="{{$blogs->blog_image}}" class="form-control" type="file"  id="image">
                                                @error('blog_image')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--view Image-->
                                       <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                            <img id="blog_image" class="rounded avatar-lg" src="{{asset($blogs->blog_image) }}" alt="Card image cap">
                                            </div>
                                        </div>
                                       
                                        <input type ="submit" class="btn btn-info waves-effect waves-light" value ="Update Blog Data">

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



