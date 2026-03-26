<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VendorSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if (!$store) {
            return redirect()->route('frontend.vendor.dashboard')->with('error', 'Store not found.');
        }

        return view('frontend.vendor.settings.index', compact('store', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if (!$store) {
            return redirect()->route('frontend.vendor.dashboard')->with('error', 'Store not found.');
        }

        $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'nullable|string|max:191',
            'email' => 'nullable|email|max:191',
            'logo_file' => 'nullable|image|max:2048',
            'cover_file' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['logo_file', 'cover_file', '_token', '_method']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('logo_file')) {
            $logoUpload = ImageHelper::imageUploadHelper('store_logo', $request->file('logo_file'));
            if ($logoUpload['status']) {
                $data['logo'] = $logoUpload['data']['target_file'];
            }
        }

        if ($request->hasFile('cover_file')) {
            $coverUpload = ImageHelper::imageUploadHelper('store_cover', $request->file('cover_file'));
            if ($coverUpload['status']) {
                $data['cover_image'] = $coverUpload['data']['target_file'];
            }
        }

        $store->update($data);

        return back()->with('success', 'Settings updated successfully.');
    }
}
