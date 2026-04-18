<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin-layouts.profile', compact('user'));
    }

    public function update(Request $request)        
    {
        $user = Auth::user();

        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'avatar' => 'nullable|image|max:2048',
                'phone' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('avatar')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('avatar_', $request->file('avatar'));
                if ($upload['status']) {
                    $data['avatar'] = $upload['data']['target_file'];
                }
            }

            $user->update($data);


            return redirect()->route('admin.profile.edit')->with('success', 'Profile updated.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to update profile. Check logs for details.'])->withInput();
        }
    }
}
