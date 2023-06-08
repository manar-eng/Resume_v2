<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogGategory;
use Image;
//use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    //
    public function AllBlog(){
        $blogs = Blog::latest()->get();
        return view ('admin.blogs.blogs_all',compact('blogs'));

    }

    public function AddBlog(){
        $category =BlogGategory::orderby('blog_gategory','ASC')->get();
        return view ('admin.blogs.blogs_add',compact('category'));

    }

    public function StoreBlog(Request $request){

        $image = $request->file('blog_image');
        $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(430,327)->save('upload/blog/'.$name_image);
        $save_url ='upload/blog/'.$name_image;

        Blog::insert([
          'blog_category_id' => $request->blog_category_id,
          'blog_title' => $request->blog_title,
          'blog_tags' => $request->blog_tags,
          'blog_description' => $request->blog_description,
          'blog_image' => $save_url,
          'created_at' => Carbon::Now(),
          

        ]);
        $notification = array(
          'message' => 'Blog Data Inserted Successflly',
          'alert-type' => 'success'
      );
      return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id){
        $blogs = Blog::findorfail($id);
        $category = BlogGategory::orderby('blog_gategory','ASC')->get();
        return view ('admin.blogs.blogs_edit',compact('blogs','category'));

    }

    public function UpdateBlog(Request $request){
        $blog_id =$request->id;
  
        if ($request->file('blog_image')){
          $image = $request->file('blog_image');
          $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(430,327)->save('upload/blog/'.$name_image);
          $save_url ='upload/blog/'.$name_image;
  
          Blog::findorfail($blog_id)->update([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
          ]);
          $notification = array(
            'message' => 'Blog Data Updated With Image Successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog')->with($notification);
        }else
        {
            Blog::findorfail($blog_id)->update([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            
            
          ]);
          $notification = array(
            'message' => 'Blog Data updated Without Image Successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog')->with($notification);
        }

    }

    public function DeleteBlog($id){
        $blog_id = Blog::findorfail($id);
        $img = $blog_id->blog_image;
        unlink($img);
        Blog::findorfail($id)->delete();

        $notification = array(
            'message' => '  Deleted Successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function BlogDetails($id){
      $allblogs = Blog::latest()->limit(5)->get();
      $blog_id = Blog::findorfail($id);
      $category = BlogGategory::orderby('blog_gategory','ASC')->get();

      return view ('frontend.home_all.blog_details',compact('blog_id','allblogs','category'));

    }

    public function CategoryBlog($id){
      $categoryname = BlogGategory::findorfail($id);
      $blogpost = Blog::where('blog_category_id',$id)->orderby('id','DESC')->get();
      $allblogs = Blog::latest()->limit(5)->get();
      $category = BlogGategory::orderby('blog_gategory','ASC')->get();

      return view('frontend.cat_blog_details',compact('blogpost','allblogs','category','categoryname'));
    }

    public function HomeBlog(){
      $allblogs = Blog::latest()->get();
      $category = BlogGategory::orderby('blog_gategory','ASC')->get();

      return view('frontend.blog',compact('allblogs','category'));
    }


}
