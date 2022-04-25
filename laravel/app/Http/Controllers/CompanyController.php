<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("companies.index", [
            "companies" => Company::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
           'name' => 'required',
           'phone' => 'required',
           'email' => 'required|email',
           'logo' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
       ]);
       
       $logo = $request->file('logo');
       $fileName = $logo->getClientOriginalName();
       $fileSize = $logo->getSize();
       \Log::debug("Storing Company '{$fileName}' ($fileSize)...");
 
       $uploadName = time() . '_' . $fileName;
       $filePath = $logo->storeAs(
           'uploads',    // path
           $uploadName,   //filename
           'public'        //disk
       );
      
       if (\Storage::disk('public')->exists($filePath)) {
           \Log::debug("Local storage OK");

           $fullPath = \Storage::disk('public')->path($filePath);
           \Log::debug("Company saved at {$fullPath}");

           $file = File::create([
               'filepath' => $filePath,
               'filesize' => $fileSize,
           ]);

           $company = Company::create([
               'logo_id'=> $file->id,
               'name' => $validatedData['name'],
               'phone' => $validatedData['phone'] ,
               'email' => $validatedData['email'] ,
           ]);

           \Log::debug("DB storage OK");

           return redirect()->route('companies.show', $company)
               ->with('success', 'Company successfully saved');
       } else {

           \Log::debug("Local storage FAILS");
           return redirect()->route("companies.create")
               ->with('error', 'ERROR uploading Company');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $Company)
    {
        if (Storage::disk('public')->exists($Company->filepath))
        {
            return view('companies.show',  [
                "fitxer" => $Company
            ]);
        }else{
            return redirect()->route("companies.index")
                ->with('error', 'ERROR the image was not found!');
        }
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $Company)
    {
        return view('companies.edit',  [
            "fitxer" => $Company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $Company)
    {

        $validatedData = $request->validate([
            'logo' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        
        $antigua_ruta = $Company -> filepath;
        $logo = $request->Company('logo');
        $fileName = $logo->getClientOriginalName();
        $fileSize = $logo->getSize();
        \Log::debug("Storing Company '{$fileName}' ($fileSize)...");
  
        $uploadName = time() . '_' . $fileName;
        $filePath = $logo->storeAs(
            'uploads',    
            $uploadName,   
            'public'        
        );
       
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
 
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("Company saved at {$fullPath}");
            
            $Company->filepath = $filePath;
            $Company->filesize = $fileSize;
            $Company->save();
            
            \Log::debug("DB storage OK");
            Storage::disk('public')->delete($antigua_ruta);

            return redirect()->route('companies.show', $Company)
                ->with('success', 'Company successfully saved');
        } else {
 
            \Log::debug("Local storage FAILS");
            return redirect()->route("companies.edit")
                ->with('error', 'ERROR uploading Company');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $Company)
    {
        Storage::disk('public')->delete($Company->filepath);
        $Company->delete();

        if (!Storage::disk('public')->exists($Company->filepath))
        {
            return redirect()->route("companies.index")
                ->with('success', 'Image deleted successfully!');
        }else{
            return redirect()->route("companies.show", $Company)
                ->with('error', 'ERROR the image was not deleted!');
        }
    }
}