<?php

namespace App\Http\Controllers\Camera;

use App\Http\Controllers\Controller;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RecordController extends Controller
{
    public function index($camera)
    {
    }

    public function getVideos($path)
    {
        $path = \Storage::disk('camera')->path(str_replace('-','/',$path));

        if (!File::exists($path)) {
            abort(404);
        }
/*
        $ffmpeg = FFMpeg::create(array(
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ));
        $video = $ffmpeg->open($path);
        $format = new \FFMpeg\Format\Video\WebM();
//
        $video->save($format, storage_path('tmpvideo/export_video.webm'));

        dd($video);*/
        $stream = new \App\Http\VideoStream($path);

        return response()->stream(function() use ($stream) {
            $stream->start();
        });
    }

    public function show($camera, $record)
    {
        $camdir = config('filesystems.disks.camera.root');
        if($camdir == ""){
            flash('Kamera ana dizini güncelleyiniz.')->error();
        }
        $cameras = \Storage::disk('camera')->directories();
        $camdirs = \Storage::disk('camera')->directories($camera);

        $records = \Storage::disk('camera')->files($camera.'/'.$record);

        return inertia('Camera/Show',[
            'camera_dir' => $camdir,
            'camera' => $camera,
            'camdirs' => $camdirs,
            'cameras' => $cameras,
            'record' => $record,
            'records' => $records
        ]);
    }

    public function destroy($camera, $record)
    {
        //
    }
}
