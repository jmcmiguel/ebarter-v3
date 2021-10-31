<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Post;
use App\Models\ReportImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request){
        Validator::make($request->all(), [
            'report_type' => ['required', 'string'],
            'report_desc' => ['required','string'],
        ])->validate();

        $newReport = Report::create([
            'user_id' => Auth::user()->id,
            'reported_post_id' => $request->reported_post_id,
            'reported_user_id' => $request->reported_user_id,
            'description' => $request->report_desc,
            'report_type' => $request->report_type,
        ]);

        // check if images are empty
        if($request->filled('reportimg_filepath')){
            $imgPaths = $request->reportimg_filepath;
            
            foreach($imgPaths as $imgPath){
                ReportImage::create([
                    'report_image_file_path' => $imgPath,
                    'report_id' => $newReport->id,
                ]);
            }

        }

        $post = Post::find($request->reported_post_id);
        $post->delete();

        $request->session()->flash('flash.bannerId', uniqid());
        $request->session()->flash('flash.banner', 'Reported succesfully! For the mean time, you wont see it anymore');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back()
                    ->with('message', 'Reported Successfully.');
    }
}
