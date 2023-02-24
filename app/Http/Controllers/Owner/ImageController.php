<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('image'); 
                if(!is_null($id)){  
                    $imagesOwnerId = Image::findOrFail($id)->owner->id; 
                    $imageId = (int)$imagesOwnerId;  
                        if($imageId !== Auth::id()){ 
                            abort(404); 
                    } 
                } 
            return $next($request);
        });
    }
    

    public function index()
    {
        $images = Image::where('owner_id',Auth::id() )
        ->orderBy('updated_at','desc')
        ->paginate(20);

        return view('owner.images.index',compact('images'));

    }

    
    public function create()
    {
        return view('owner.images.create');
    }

   
    public function store(UploadImageRequest $request)
    {
        $imageFiles = $request->file('files'); //配列でファイルを取得 
        if(!is_null($imageFiles)){ 
        foreach($imageFiles as $imageFile){ // それぞれ処理 
        $fileNameToStore = ImageService::upload($imageFile, 'products'); 
        Image::create([ 
        'owner_id' => Auth::id(), 
        'filename' => $fileNameToStore 
        ]); 
        } 
        }

        return to_route('owner.images.index')
        ->with(['message'=>'画像を保存しました','status'=>'info']);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
