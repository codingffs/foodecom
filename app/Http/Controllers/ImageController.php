<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Image;
use App\Models\MediaManager;
    
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skip = 0;
        $limit = 100;
        $page = $request->page;
        if($page > 1) {
            $skip = ($page-1) * $limit ;
        }
        $media = MediaManager::where('media_type', 'image')->skip($skip)->limit(100)->get();
        $unsupport = [];
        foreach ($media as $value) {
            $image_path = public_path($value->media_file);
            if ($value->media_file && file_exists($image_path)) {
                $pathinfo = pathinfo($image_path);
                if(in_array(strtolower($pathinfo['extension']), ['jpg', 'png', 'gif', 'bmp', 'webp'])) {
                    $image = Image::make($image_path);
                    $pathinfo = pathinfo($image_path);
                    $imageName = $pathinfo['filename'].'.webp';
                    $savepath = 'uploads/newmedia/'. $imageName;
                    $tbpath = 'uploads/media/'. $imageName;
                    $image->save(public_path($savepath));

                    MediaManager::where('id', $value->id)->update(['media_file' => $tbpath]);
                    // unlink($image_path);
                } else {
                    $unsupport[] = $value->id;
                }
            }
        }

        dd(json_encode($unsupport));
    }
        
    public function imagecopy() {
        $dirname = "uploads/media/";
        $images = glob($dirname.'*');

        foreach($images as $image) {
            $pathinfo = pathinfo($image);
            $imageName = $pathinfo['filename'].'.webp';
            $imgpath = 'uploads/newmedia/'.$imageName;
            if(!file_exists($imgpath)) {
                copy($image, $imgpath);
            }
        }
    }
}
