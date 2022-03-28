<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // $validation = Validator::make($request->all(), [
        //     'file' => 'required|mimes:jpeg,png,gif|max:2048',
        // ]);

        // if($validation->fails())
        // {
        //     return back()->with('error','Ocurrió un error!');
        // }

        // $path = $request->file('file')->store('public/storage');
        // return back()->with('success','Imatge enviada correctament!');

       $validatedData = $request->validate([
           'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
       ]);
      
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
        return view('files.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $file2 = File::find($file);

        return View::make('vista')->with('vista', $file2);
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
        $path = $request->file($file)->store($request);
        return $path;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {

        try {
            $this->authorize('delete', $file);
            $file->delete();
            return redirect()
                ->action('vista') //\App\Http\Controllers\FileController@my_files
                ->with("Se borró correctamente.");
        }  catch (\Exception $e) {
            report($e);
        }

        // try{
        //     File::delete($file);
        //     return "El fichero fue borrado correctamente.";

        // }catch (Exception $e){
        //     return "El fichero introducido no existe.";
        // }
    }
}