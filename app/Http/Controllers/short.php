<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\random;
use Illuminate\Http\Request;
use App\Http\Requests\CreateLinkRequest;

class short extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $originalUrl = $request->input('original_url');
        // return $originalUrl;

        // Check if the link already exists
        $existingLink = Link::where('original_url', $originalUrl)->first();

        if ($existingLink) {
            return response()->json(['short_url' => 'http://127.0.0.1:8000/'.$existingLink->short_url, 'original_url' => $existingLink->original_url]);
        }

        // Create a new link record
        $random = new random;
        $random->unique_number = random::generateShortCode();
        $link = new Link();
        $link->original_url = $originalUrl;
        $currentURL = url()->current();
        // $link->save();

        // Generate the short URL using the link's ID
        $link->short_url = $random->unique_number;
        // return $random->unique_number;
        $link->save();

        return response()->json(['short_url' => 'http://127.0.0.1:8000/'.$link->short_url, 'original_url' => $link->original_url]);
    }


   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $find = Link::where('short_url', $id)->first();
        if ($find) {
            if ($find->expiration_date > now()) {
                return redirect($find->original_url);
            }else {
                abort(404, "The link has expired ");
            }
           
        }else {
            abort(404, "Sorry, this page doesn't exist");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
