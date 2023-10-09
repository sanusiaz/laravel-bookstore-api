<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Resources\Api\V1\AuthorCollection;
use App\Http\Requests\Api\V1\StoreAuthorRequest;
use App\Http\Requests\Api\V1\UpdateAuthorRequest;
use App\Http\Resources\Api\V1\AuthorResource;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new AuthorCollection( Author::paginate(30) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {

        $request->validated();
        // Create New Author
        return new AuthorResource( Author::create( [
            'name' => $request->name
        ] ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource( $author );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        // validate request
        $request->validated();

        $author->update([
                'name' => $request->name
            ]);
        return new AuthorResource( $author );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($author)
    {
        $author = Author::where('id', $author)->first();
        if ( $author !== null ) {

            $author->delete();

            return response()->json([
                'message' => 'Author Deleted Successfully'
            ], 201);
        }

        return response()->json([
            'message' => 'Invalid Request / Author Not Found'
        ], 401);
    }
}
