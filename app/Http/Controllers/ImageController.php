<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(){
        $images = Image::all();
        return view("backend.images" , compact("images"));
    }

    public function store(Request $request){

        request()->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);

        $srcFile = $request->file("srcFile");
        $srcUrl = $request->srcUrl;

        if ($srcFile xor $srcUrl) {
            if ($srcFile) {

                request()->validate([
                    "srcFile" => ["required" , "image" , "mimes:png,jpg,jpeg,gif,svg" , "max:2048"],
                ]);

                //* UPLOAD FILE
                $srcFile->storePublicly("img/" , "public");
                $fileName = $srcFile->hashName();

            } else if ($srcUrl) {

                request()->validate([
                    "srcUrl" => ["url"],
                ]);

                //* UPLOAD URL
                $file = file_get_contents($srcUrl);
                $path_info = pathinfo($srcUrl);
                $extension = $path_info['extension'];
                $fileName = hash('sha256' , $srcUrl) . '.' . $extension;
                Storage::disk("public")->put('img/'.$fileName , $file);
            }

            $data = [
                "name" => $request->name,
                "desc" => $request->desc,
                "src" => $fileName,
            ];

            Image::create($data);

            return redirect()->back()->with("success" , "Vous avez bien upload l'image dans le dossier et la DB") ;
        } else {
            return redirect()->back()->with("error" , "Vous devez choisir sois l'input file , sois l'input url") ;
        }
    }

    public function destroy (Image $image) {
        Storage::disk("public")->delete('img/'.$image->src);
        $image->delete();
        return redirect()->back()->with("warning" , "attention , vous venez de supprimer une image");
    }

    public function update(Request $request , Image $image){
        request()->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);

        $srcFile = $request->file("srcFile");
        $srcUrl = $request->srcUrl;

        if ($srcFile xor $srcUrl) {

            //* SUPPRIMER L'ancien file : 
            Storage::disk("public")->delete("img/".$image->src);

            if ($srcFile) {

                request()->validate([
                    "srcFile" => ["required" , "image" , "mimes:png,jpg,jpeg,gif,svg" , "max:2048"],
                ]);

                //* UPLOAD FILE
                $srcFile->storePublicly("img/" , "public");
                $fileName = $srcFile->hashName();

            } else if ($srcUrl) {

                request()->validate([
                    "srcUrl" => ["url"],
                ]);

                //* UPLOAD URL
                $file = file_get_contents($srcUrl);
                $path_info = pathinfo($srcUrl);
                $extension = $path_info['extension'];
                $fileName = hash('sha256' , $srcUrl) . '.' . $extension;
                Storage::disk("public")->put('img/'.$fileName , $file);
            }

            $data = [
                "name" => $request->name,
                "desc" => $request->desc,
                "src" => $fileName,
            ];
            
            $image->update($data);

            return redirect()->back()->with("success" , "Vous avez bien upload la nouvelle image dans le dossier et la DB") ;

        } else {
            if ($srcFile && $srcUrl) {
                return redirect()->back()->with("warning" , "Vous devez choisir sois l'input file , sois l'input url") ;
            } else {
                $data = [
                    "name" => $request->name,
                    "desc" => $request->desc,
                ];
                $image->update($data);
                return redirect()->back()->with("success" , "Vous modifier les données") ;
            }
        }
    }
}
