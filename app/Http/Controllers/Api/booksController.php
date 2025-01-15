<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Authors;
use Illuminate\Support\Facades\Validator;

class booksController extends Controller
{
    //
    public function index(){
         $books =  Books::all();
        if ($books->isEmpty()) {
            return response()->json(['message'=>'No se encontraron datos de Books'],200);
        }
        return response()->json($books,200);
    }
    //
    public function store(Request $request){
       $validator = Validator::make($request->all(), [
            'title' =>'required',
            'published_date' =>'required|date|date_format:Y-m-d',
            'isbn' =>'required|unique:books',
            'author_id' =>'required'

        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $author = Authors::find( $request->author_id);
        if (!$author) {
	         $data = [
                        'message' => 'Error. Author aun no existe en la BD. Favor Carguelo',
                        'error' => 'ID No encontrado',
                        'status' => 400
                    ];
                    return response()->json($data, 400);
        }

        $book = Books::create([
            'title' => $request->title,
            'published_date' => $request->published_date,
            'isbn' => $request->isbn,
            'author_id' => $request->author_id
        ]);
        if (!$book) {
	        $data =[
                'message' => 'No se pudo crear book',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data =[
               'book' => $book,
               'status' => 201
        ];
        return response()->json($data, 201); 
    }
    //
    public function show($id){
        $book = Books::find($id);
        if (!$book) {
            $data = [
                'message' => 'Book no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'book' => $book,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    //
    public function destroy($id){
        $book = Books::find($id);
        if (!$book) {
            $data = [
                'message' => 'Book no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $book->delete();  
        $data = [
            'message' => 'Book eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    //
    public function update(Request $request, $id){
        $book = Books::find($id);
         if (!$book) {
            $data = [
                'message' => 'Book no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'title' =>'required',
            'published_date' =>'required|date|date_format:Y-m-d',
            'isbn' =>'required|unique:books',
            'author_id'=>'required'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $author = Authors::find( $request->author_id);
        if (!$author) {
	         $data = [
                        'message' => 'Error. Author aun no existe en la BD. Favor Carguelo',
                        'error' => 'ID No encontrado',
                        'status' => 400
                    ];
                    return response()->json($data, 400);
        }

        $book->title = $request->name;
        $book->published_date = $request->birthdate;
        $book->isbn = $request->nationality;
        $book->author_id = $request->author_id;
        $book->save();

        $data = [
            'message' => 'Book actualizado',
            'author' => $book,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    
}
