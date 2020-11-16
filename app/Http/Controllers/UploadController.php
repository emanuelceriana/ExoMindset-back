<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\FileProcessor;
Use Exception;
use App\Models\User;



class UploadController extends Controller
{
    use FileProcessor;

    public function uploadCSV(Request $request){

        $lines = $this->processFile($request->file);

        try {
            DB::beginTransaction();
            foreach($lines as $line){
                $user = new User;
                $user->name = $line['Name'];
                $user->dni = $line['DNI'];
                $user->email = $line['Email'];
                $user->phone = $line['Phone'];
                $user->save();
            }
            DB::commit();
            return response()->json(['message' => 'Los usuarios se guardaron correctamente'], 200);


        } catch(Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e, 'message' => ['Ocurrió un error al intentar crear los usuarios.']], 412);
        }

    }
}