<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return inertia('Admin/Settings/Index',[
            'camera_dir' => $settings->camera_dir
        ]);
    }

    public function update(Request $request,GeneralSettings $settings)
    {
        $request->validate([
            'camera_dir' => 'required|string'
        ]);
        $settings->camera_dir = $request->input('camera_dir');
        $settings->save();

        putenv("CAMERA_DIR=$settings->camera_dir");
        return redirect()->back();
    }
}
