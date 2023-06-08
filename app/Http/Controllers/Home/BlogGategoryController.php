<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogGategory;
class BlogGategoryController extends Controller
{
    //
    public function AllBlogGategory(){
        $blog_gategory = BlogGategory::latest()->get();
        return view ('admin.blog_gategory.blog_gategory_all',compact('blog_gategory'));

    }

    public function AddBlogGategory(){
        return view ('admin.blog_gategory.blog_gategory_add');

    }

    public function StoreBlogGategory(Request $request){
        $request->validate([
            'blog_gategory' =>'required',
        ]);

        BlogGategory::insert([
            'blog_gategory' => $request->blog_gategory,
        ]);
        $notification = array(
          'message' => 'Blog Gategory Inserted successflly',
          'alert-type' => 'success'
      );
      return redirect()->route('all.blog.gategory')->with($notification);

    }

    public function EditBlogGategory($id){

        $blog_gategory = BlogGategory::findorfail($id);
        return view ('admin.blog_gategory.blog_gategory_edit',compact('blog_gategory'));

    }


    public function UpdateBlogGategory(Request $request){
        $blog_gategory_id=$request->id;
        BlogGategory::findorfail($blog_gategory_id)->update([
            'blog_gategory' => $request->blog_gategory,

        ]);

        $notification = array(
            'message' => 'Blog Gategory updated successflly',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.gategory')->with($notification);


    }

    public function DeleteBlogGategory($id){
        BlogGategory::findorfail($id)->delete();

        $notification = array(
            'message' => ' Blog Gategory Deleted Successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
