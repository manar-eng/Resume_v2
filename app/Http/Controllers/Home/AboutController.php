<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Image;


class AboutController extends Controller
{
    //
    public function aboutpage(){

        $about = About::find(1);
        return view('admin.about_page.about_page_all',compact('about'));
    }

    public function updateabout(Request $request){
        $about_id =$request->id;
  
        if ($request->file('about_image')){
          $image = $request->file('about_image');
          $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_image);
          $save_url ='upload/home_about/'.$name_image;
  
             About::findorfail($about_id)->update([
            'title' => $request->title,
            'short_title' => $request->short_title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'about_image' => $save_url,

  
          ]);
          $notification = array(
            'message' => 'About page updated with image successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        }else
        {
            About::findorfail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            
          ]);
          $notification = array(
            'message' => 'About page updated without image successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        }
        
  
      }


      public function homeabout(){

        $about = About::find(1);
        return view ('frontend.about_page',compact('about'));
      }

      public function aboutmultiimage(){

        return view ('admin.about_page.multi_image');
      }

      public function StoreMultiImage(Request $request){

        $image =$request->file('multi_image');

        foreach ($image as $multi_image) {

             $name_image = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
          Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$name_image);
          $save_url ='upload/multi/'.$name_image;
  
          MultiImage::insert([
            'multi_image' => $save_url,
             'created_at' => Carbon::Now()
  
          ]);
        }
          $notification = array(
            'message' => 'Multi Images Inserted successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.multi.image')->with($notification);
        
      }

      public function AllMultiImage(){
        $all_multi_image = MultiImage::all();
        return view('admin.about_page.all_multi_image',compact('all_multi_image'));
      }

      public function EditMultiImage($id){

        $multi_image = MultiImage::findorfail($id);
        return view ('admin.about_page.edit_multi_image',compact('multi_image'));

      }

      public function UpdateMultiImage(Request $request){

        $multi_image_id =$request->id;
  
        if ($request->file('multi_image')){
          $image = $request->file('multi_image');
          $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(220,220)->save('upload/multi/'.$name_image);
          $save_url ='upload/multi/'.$name_image;
  
          MultiImage::findorfail($multi_image_id)->update([
            
            'multi_image' => $save_url,

  
          ]);
          $notification = array(
            'message' => ' updated  image successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.multi.image')->with($notification);
        }

      }

      public function DeleteMultiImage($id){
        $multi = MultiImage::findorfail($id);
        $img = $multi->multi_image;
        unlink($img);
        MultiImage::findorfail($id)->delete();

        $notification = array(
            'message' => ' image deleted successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

      }
    
      
}
