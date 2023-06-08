@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
     <div class="container-fluid">
     <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      <form method = "post" action="{{route ('update.blog.gategory')}}" >
                                    @csrf
                                    <input type="hidden" name ="id" value="{{$blog_gategory->id}}">

                                       
                                        <h4 class="card-title"> Add Blog Gategory</h4> <br><br>
                                        <!--Name-->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Gategory Name</label>
                                            <div class="col-sm-10">
                                                <input name ="blog_gategory" class="form-control" type="text" value="{{ $blog_gategory -> blog_gategory}}" id="example-text-input">
                                                @error('blog_gategory')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                       
                                        
                                       


                                      
                                       
                                        <input type ="submit" class="btn btn-info waves-effect waves-light" value ="Update Blog Gategory ">

                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                                  
</div>
</div>

@endsection



