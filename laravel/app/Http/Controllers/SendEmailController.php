<?php
namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SendEmailController extends Controller
{
    public function ship(Request $request)
    {
        $valueArray = [
        	'name' => 'John',
        ];
        
        try {
            \Mail::to('2daw.equip03@fp.insjoaquimmir.cat')->send(new TestMail($valueArray));
            echo 'Mail send successfully';
        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }
    }
}