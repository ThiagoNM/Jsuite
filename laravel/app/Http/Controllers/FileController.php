<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("files.index", [
            "files" => File::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $validatedData = $request->validate([
           'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
       ]);
      
       $upload = $request->file('upload');
       $fileName = $upload->getClientOriginalName();
       $fileSize = $upload->getSize();
       \Log::debug("Storing file '{$fileName}' ($fileSize)...");
 
       $uploadName = time() . '_' . $fileName;
       $filePath = $upload->storeAs(
           'uploads',    // path
           $uploadName,   //filename
           'public'        //disk
       );
      
       if (\Storage::disk('public')->exists($filePath)) {
           \Log::debug("Local storage OK");

           $fullPath = \Storage::disk('public')->path($filePath);
           \Log::debug("File saved at {$fullPath}");
           $file = File::create([
               'filepath' => $filePath,
               'filesize' => $fileSize,
           ]);

           \Log::debug("DB storage OK");

           return redirect()->route('files.show', $file)
               ->with('success', 'File successfully saved');
       } else {

           \Log::debug("Local storage FAILS");
           return redirect()->route("files.create")
               ->with('error', 'ERROR uploading file');
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        if (Storage::disk('public')->exists($file->filepath))
        {
            return view('files.show',  [
                "fitxer" => $file
            ]);
        }else{
            return redirect()->route("files.index")
                ->with('error', 'ERROR the image was not found!');
        }
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('files.edit',  [
            "fitxer" => $file
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {

        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        
        $antigua_ruta = $file -> filepath;
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
  
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',    
            $uploadName,   
            'public'        
        );
       
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
 
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            
            $file->filepath = $filePath;
            $file->filesize = $fileSize;
            $file->save();
            
            \Log::debug("DB storage OK");
            Storage::disk('public')->delete($antigua_ruta);

            return redirect()->route('files.show', $file)
                ->with('success', 'File successfully saved');
        } else {
 
            \Log::debug("Local storage FAILS");
            return redirect()->route("files.edit")
                ->with('error', 'ERROR uploading file');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();
        Storage::disk('public')->delete($file->filepath);

        if (!Storage::disk('public')->exists($file->filepath))
        {
            return redirect()->route("files.index")
                ->with('success', 'Image deleted successfully!');
        }else{
            return redirect()->route("files.show", $file)
                ->with('error', 'ERROR the image was not deleted!');
        }
    }
}