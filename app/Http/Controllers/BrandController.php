<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    //

    public function AllBrand(){

        $brands  = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request){

        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png'



        ],[
            'brand_name.required'=> 'Please Input Brand Name ',//my own
            'brand_image.min' =>'No appropriate file',
        ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $img_location = 'images/brand/';
        $last_img = $img_location.$img_name;
        $brand_image->move($img_location,$img_name);



        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_image' =>$last_img,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'The Brand successfully Added');


    }

    public function Edit($id){

            $brands = Brand::find($id);
            return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id ){

        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',




        ],[
            'brand_name.required'=> 'Please Input Brand Name ',//my own
            'brand_image.min' =>'No appropriate file',
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){

            $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $img_location = 'images/brand/';
        $last_img = $img_location.$img_name;
        $brand_image->move($img_location,$img_name);



        unlink($old_image);
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' =>$last_img,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'The Brand successfully Updated');

        }else{

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' =>Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'The Brand successfully Updated');

        }


    }

    public function Delete($id){

       $img =  Brand::find($id);
       $old_image = $img->brand_image;

       unlink($old_image);

       Brand::find($id)->delete();

       return Redirect()->back()->with('success', 'Deleted successfuly');





    }














    public function Logout(){
        Auth::logout();

        return redirect('login')->with('success', 'Logout successfully');



    }

}
