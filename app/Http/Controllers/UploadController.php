<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function upload()
    {
        $images = Image::get();
        return view('upload', compact('images'));
    }
    public function uploadImages(Request $request)
    {

        $request->validate([
            'images' => 'required',
//            'images.*' => 'image|mimes:png, jpg, jpeg, gif',
        ]);

        if ($request->hasFile('images'))
        {
            foreach ($request->images as $image)
            {
                $imageName = $image->getClientOriginalName();
                $imageExt = $image->getClientOriginalExtension();
                $newName = uniqid('', true).'.'.$imageExt;
                $image->move('uploads', $newName);

                $images = new Image();
                $images->image = $newName;
                $images->save();


            }
        }
        return back()->with('success', "Uploaded successfully!");
    }

    //Ajax

    public function showForm()
    {
        $images = Image::get();
        return view('upload-ajax', compact('images'));
    }
    public function storeImages(Request $request)
    {
        if ($request->ajax())
        {
            $request->validate([
                'images' => 'required',
//            'images.*' => 'image|mimes:png, jpg, jpeg, gif',
            ]);

            if ($request->hasFile('images'))
            {
                foreach ($request->images as $image)
                {
                    $imageName = $image->getClientOriginalName();
                    $imageExt = $image->getClientOriginalExtension();
                    $newName = uniqid('', true).'.'.$imageExt;
                    $image->move('uploads', $newName);

                    $images = new Image();
                    $images->image = $newName;
                    $images->save();
                }

                $images = Image::get();

                return view('images', compact('images'));
            }
        }
    }
}
