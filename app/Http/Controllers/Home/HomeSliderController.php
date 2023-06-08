<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class HomeSliderController extends Controller
{
    //
    public function HomeSlider(){
      $homeslide = HomeSlide::find(1);
      return view('admin.home_slide.home_slide_all',compact('homeslide'));
    }

    public function UpdateSlider(Request $request){
      $slide_id =$request->id;

      if ($request->file('home_image')){
        $image = $request->file('home_image');
        $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_image);
        $save_url ='upload/home_slide/'.$name_image;

        HomeSlide::findorfail($slide_id)->update([
          'title' => $request->title,
          'short_title' => $request->short_title,
          'video_url' => $request->video_url,
          'home_image' => $save_url,

        ]);
        $notification = array(
          'message' => 'Home slide updated with image successflly',
          'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
      }else
      {
        HomeSlide::findorfail($slide_id)->update([
          'title' => $request->title,
          'short_title' => $request->short_title,
          'video_url' => $request->video_url,
          
        ]);
        $notification = array(
          'message' => 'Home slide updated without image successflly',
          'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
      }
      

    }
}
