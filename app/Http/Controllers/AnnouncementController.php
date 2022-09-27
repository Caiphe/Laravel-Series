<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementRequest;

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
        $announcement->update($data);

        return back()->with('success', 'Announcement updates successfully');
    }
}
