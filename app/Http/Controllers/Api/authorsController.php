<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authors;
use Illuminate\Support\Facades\Validator;
class authorsController extends Controller
{
    //
    public function index(){
        $authors =  Authors::all();
        if ($authors->isEmpty()) {
            return response()->json(['message'=>'No se encontraron datos de Authors'],200);
        }
        return response()->json($authors,200);
    }

    //
    public function store(Request $request){
       $validator = Validator::make($request->all(), [
            'name' =>'required',
            'birthdate' =>'required|date|date_format:Y-m-d',
            'nationality' =>'required'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $author = Authors::create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'nationality' => $request->nationality
        ]);
        if (!$author) {
	        $data =[
                'message' => 'No se pudo crear author',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data =[
               'author' => $author,
               'status' => 201
        ];
        return response()->json($data, 201); 
    }

    //
    public function show($id){
        $author = Authors::find($id);
        if (!$author) {
            $data = [
                'message' => 'Author no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'author' => $author,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    //
     public function destroy($id){
        $author = Authors::find($id);
        if (!$author) {
            $data = [
                'message' => 'Author no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $author->delete();  
        $data = [
            'message' => 'Author eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    //
    public function update(Request $request, $id){
        $author = Authors::find($id);
         if (!$author) {
            $data = [
                'message' => 'Author no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'birthdate' =>'required|date|date_format:Y-m-d',
            'nationality' =>'required'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $author->name = $request->name;
        $author->birthdate = $request->birthdate;
        $author->nationality = $request->nationality;

        $author->save();

        $data = [
            'message' => 'Author actualizado',
            'author' => $author,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}
