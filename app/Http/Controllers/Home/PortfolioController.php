<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Portfolio;
//use Illuminate\Support\Carbon;
use Image;

class PortfolioController extends Controller
{
    //
    public function AllPortfolio(){

        $portfolio = Portfolio::latest()->get();
        return view ('admin.portfolio.portfolio_all',compact('portfolio'));

    }

    public function AddPortfolio(){
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request){
        $request->validate([
            'portfolio_name' =>'required',
            'portfolio_title' =>'required',
            'portfolio_image' =>'required',
        ],[
            'portfolio_name.required' => 'Portfolio Name Is Required ',
            'portfolio_title.required' => 'Portfolio Title Is Required ',
            'portfolio_image.required' => 'Portfolio Image Is Required ',


        ]);

        $image = $request->file('portfolio_image');
        $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_image);
        $save_url ='upload/portfolio/'.$name_image;

        Portfolio::insert([
          'portfolio_name' => $request->portfolio_name,
          'portfolio_title' => $request->portfolio_title,
          'portfolio_description' => $request->portfolio_description,
          'portfolio_image' => $save_url,
          'created_at' => Carbon::Now(),

        ]);
        $notification = array(
          'message' => 'Portfolio Data Inserted successflly',
          'alert-type' => 'success'
      );
      return redirect()->route('all.portfolio')->with($notification);

    }

    public function EditPortfolio($id){
        $portfolio = Portfolio::findorfail($id);
        return view ('admin.portfolio.portfolio_edit',compact('portfolio'));


    }

    public function UpdatePortfolio(Request $request){
        $portfolio_id =$request->id;
  
        if ($request->file('portfolio_image')){
          $image = $request->file('portfolio_image');
          $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_image);
          $save_url ='upload/portfolio/'.$name_image;
  
          Portfolio::findorfail($portfolio_id)->update([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
          ]);
          $notification = array(
            'message' => 'Portfolio Data updated with image successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.portfolio')->with($notification);
        }else
        {
            Portfolio::findorfail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            
          ]);
          $notification = array(
            'message' => 'Portfolio Data updated without image successflly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function DeletePortfolio($id){
        $portfolio = Portfolio::findorfail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);
        Portfolio::findorfail($id)->delete();

        $notification = array(
            'message' => '  Deleted Successflly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

      }


      public function PortfolioDetails($id){
        $portfolio = Portfolio::findorfail($id);
        return view ('frontend.portfolio_details',compact('portfolio'));
      }

      public function HomePortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('frontend.portfolio',compact('portfolio'));
      }
    
}
