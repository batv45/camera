<?php

namespace App\Http\Controllers\Camera;

use App\Http\Controllers\Controller;
use App\Models\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CameraController extends Controller
{
    public function index()
    {
        $camdir = config('filesystems.disks.camera.root');
        if($camdir == ""){
            flash('Kamera ana dizini güncelleyiniz.')->error();
        }
        $cameras = \Storage::disk('camera')->directories();

        return inertia('Camera/Index',[
            'camera_dir' => $camdir,
            'cameras' => $cameras
        ]);
    }

    public function show($id)
    {
        $camdir = config('filesystems.disks.camera.root');
        if($camdir == ""){
            flash('Kamera ana dizini güncelleyiniz.')->error();
        }
        $cameras = \Storage::disk('camera')->directories();
        $camdirs = \Storage::disk('camera')->directories($id);

        return inertia('Camera/Show',[
            'camera_dir' => $camdir,
            'camera' => $id,
            'camdirs' => $camdirs,
            'cameras' => $cameras
        ]);
    }


    public function destroy($id)
    {
        //
    }
}
