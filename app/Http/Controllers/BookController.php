<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class BookController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return an instance of Book
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return $this->successResponse($books);
    }
    /**
     * Return an specific Book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|max:255',
            'description'  => 'required|max:255',
            'price'  => 'required|min:1',
            'author_id'  => 'required|min:1'
        ];
        
        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);

    }
    /**
     * Return an instance of Book
     * @return Illuminate\Http\Response
     */
    public function show($book)
    {
        
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }
    /**
     * Update the information of an existing Book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $rules = [
            'title'  => 'max:255',
            'description'  => 'max:255|in:male,female',
            'price'  => 'min:1',
            'author_id'  => 'min:1'
        ];
        
        $this->validate($request, $rules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());

        if ($book->isClean()){
            return $this->errorResponse('At least one vlue must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->save();

        return $this->successResponse($book, Response::HTTP_CREATED);
    }
    /**
     * Remove an instance of Book
     * @return Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        $book->delete();

        return $this->successResponse($book);
    }
}
