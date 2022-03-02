<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Integer $cid The Chat ID
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = Message::where('id',$cid)
        ->where('chat_id',$id)
        ->get();
        
        return \response($results);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Integer $cid The Chat ID
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($cid, Request $request)
    {
        $request->validate([
            'message' => 'required|max:255',
            'chat_id' => 'required',
            'author_id' => 'required',
        ]);

        $messages = Message::where("chat_id", "=", $cid);
        
        if($messages != null)
        {
            $message = Message::create($request->all());
            return \response($message);
        }else{
            return "No existe";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cid)
    {

        $messages = Message::where('id', $cid)::all();
        return \response($messages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($cid, Request $request, $id)
    {
        $messages = Message::where("chat_id", "=", $cid);
        if($messages != null)
        {
            Message::findOrFail($id)
                ->update($request->all());
            return \response("Chat actualizado.");
        }else{
            return "No existe";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cid, $id)
    {
        $messages = Message::where("chat_id", "=", $cid);
        if($messages != null)
        {
            Message::destroy($id);
            return \response("El chat con el id: ${id} ha sido eliminado.");
        }else{
            return "No existe";
        }
    }
}
