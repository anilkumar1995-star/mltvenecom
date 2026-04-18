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
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'avatar_file' => 'nullable|image|max:2048',
                'phone' => 'nullable|string|max:255',
            ];

            // If updating password
            if ($request->filled('password')) {
                $rules['old_password'] = 'required';
                $rules['password'] = 'required|string|min:8|confirmed';
            }

            $validated = $request->validate($rules);

            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? $user->phone,
            ];

            if ($request->filled('password')) {
                if (!\Hash::check($request->old_password, $user->password)) {
                    if ($request->ajax()) {
                        return response()->json(['status' => false, 'message' => 'Current password does not match.'], 422);
                    }
                    return back()->withErrors(['old_password' => 'Current password does not match.'])->withInput();
                }
                $data['password'] = \Hash::make($request->password);
            }

            if ($request->hasFile('avatar_file')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('avatar_', $request->file('avatar_file'));
                if ($upload['status']) {
                    $data['avatar'] = $upload['data']['target_file'];
                } else {
                    if ($request->ajax()) {
                        return response()->json(['status' => false, 'message' => 'Avatar upload failed: ' . ($upload['message'] ?? 'Unknown error')], 422);
                    }
                    return back()->with('error', 'Avatar upload failed: ' . ($upload['message'] ?? 'Unknown error'))->withInput();
                }
            }

            $user->update($data);

            if ($request->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Profile updated successfully.',
                    'avatar_url' => isset($data['avatar']) ? \App\Helpers\ImageHelper::getImageUrl() . $user->avatar : null
                ]);
            }

            return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->validator->errors()->first(), 'errors' => $e->validator->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Unable to update profile.'], 500);
            }
            return back()->withErrors(['error' => 'Unable to update profile.'])->withInput();
        }
    }
}
