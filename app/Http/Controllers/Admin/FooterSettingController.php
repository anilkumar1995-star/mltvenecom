<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterSetting;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;

class FooterSettingController extends Controller
{
    public function index()
    {
        $settings = FooterSetting::first();
        return view('admin.settings.footer.index', compact('settings'));
    }

    public function edit()
    {
        $settings = FooterSetting::first();
        return view('admin.settings.footer.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = FooterSetting::first() ?? new FooterSetting();
        $data = $request->except('_token', 'footer_logo');
        
        $settings->fill($data);
        $settings->user_id = auth()->id() ?? 1; // Set current user or fallback to 1 

        if ($request->hasFile('footer_logo')) {
            $upload = ImageHelper::imageUploadHelper('footer_logo_', $request->file('footer_logo'));
            if ($upload['status']) {
                $settings->footer_logo = $upload['data']['target_file'];
            } else {
                return redirect()->back()->with('error', 'Logo upload failed: ' . $upload['message']);
            }
        }

        $settings->save();

        return redirect()->route('admin.footer-settings.index')->with('success', 'Footer settings updated successfully!');
    }
}
