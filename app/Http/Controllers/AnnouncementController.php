<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('announcement',[
            'announcement' => Announcement::first(),
        ]);
    }

    public function edit()
    {
        return view('edit-announcement', [
            'announcement' => Announcement::first()
        ]);
    }

    public function update(AnnouncementRequest $request)
    {
        $data = $request->validated();
        $announcement = Announcement::first();

        if($request->imageUpload){
            $requestImage = $request->file('imageUpload');
            $image = Image::make($requestImage);
            $image->resize(600, null, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $path = config('filesystems.disks.public.root').'/'.$requestImage->hashName();

            $image->save($path);
            $data['imageUpload'] = $requestImage->hashName(); 
        }

        if($request->imageUploadFilePond){
            $newFilename = Str::after($request->imageUploadFilePond, 'tmp/');
            Storage::disk('public')->move($request->imageUploadFilePond, "images/$newFilename");
            $data['imageUploadFilePond'] = "images/$newFilename";
        }

        $announcement->update($data);

        return back()->with('success', 'Announcement updates successfully');
    }

    public function upload(Request $request)
    {
        if($request->imageUploadFilePond){
            $path = $request->file('imageUploadFilePond')->store('tmp', 'public');
        }

        return $path;
    }
}
