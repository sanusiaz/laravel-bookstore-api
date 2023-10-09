<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Books;
use App\Http\Resources\Api\V1\BooksResource;
use App\Http\Resources\Api\V1\BooksCollection;
use App\Http\Requests\Api\V1\StoreBooksRequest;
use App\Http\Requests\Api\V1\UpdateBooksRequest;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BooksCollection( Book::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBooksRequest $request)
    {
        $request->validated();

        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'publication_year' => $request->publication_year
        ]);

        return response()->json([
            'data' => $book,
            'message' => 'Book Has Been Creatd Successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BooksResource( $book );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBooksRequest $request, Book $book)
    {

        $request->validated();

        // Update Books Request
        $book->update($request->all());

        return response()->json([
            'data' => new BooksResource( $book )
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($book)
    {
        $book = Book::where('id', $book)->first();
        if ( $book !== null ) {

            $book->delete();
            return response()->json( [
                'message' => 'Book has been deleted successfully'
            ], 201);
        }
        return response()->json([
            'message' => 'Invalid Request'
        ], 401);
    }
}
