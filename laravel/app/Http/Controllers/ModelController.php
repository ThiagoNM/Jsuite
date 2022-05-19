<?php

namespace App\Http\Controllers;

use App\Models\Model;
use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Model::all();
        \Log::debug($models);

        return view("models.index", [
            "models" => $models
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.create',[
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'manufacturer' => 'required|max:30',
            'model' => 'required|max:30',
            'price' => 'required',
            'photo_id' => 'required',
            'category_id' => 'required'
        ]);

        $photo = $request->file('photo');
        $fileName = $photo->getClientOriginalName();
        $fileSize = $photo->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

        $photoName = time() . '_' . $fileName;
        $filePath = $photo->storeAs(
            'uploads',
            $photoName ,
            'public'
        );

        $category = Category::find($request->category_id);

        if ($category == null){
            return redirect()->route('categories.index')
            ->with('error', 'Categoría no trobada');
        }
        if (\Storage::disk('public')->exists($filePath)) {
            $fullPath = \Storage::disk('public')->path($filePath);
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            $id = $file->id;
            $model = Model::create([
                'manufacturer' => $request->manufacturer,
                'model' => $request->model,
                'price' => $request->price,
                'photo_id' => $id,
                'category_id' => $request->category_id,
            ]);
            return redirect()->route('models.show', $model)
                ->with('success', 'Model guardat');
        } else {
            return redirect()->route("models.create")
                ->with('error', 'Error creant el model');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function show(Model $model)
    {
        if ( $model ){
            return view("models.show", [
                "model" => $model,
                "file" => File::find($model->photo_id),
                "category" => Category::find($model->category_id),
            ]);
        }
        else{
            return redirect()->route("models.index")
                ->with('error', 'Model no existeix');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $model)
    {
        if ( $model ){
            return view("models.edit", [
                "model" => $model,
                "file" => File::find($model->photo_id),
                "category" => Category::find($model->category_id),
                "categories" => Category::all(),
            ]);
        }
        else{
            return redirect()->route("models.index")
                ->with('error', 'Model no existeix');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $model)
    {
        $model->delete();

        return redirect()->route("models.index")
        ->with('success', 'GUCCI, model: '.$model->model.' destroyed');
    }
}