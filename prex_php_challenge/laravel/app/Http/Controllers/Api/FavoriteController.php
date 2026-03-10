<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function store(StoreFavoriteRequest $request)
    {
        $favorite = Favorite::create([
            'user_id' => $request->user()->id,
            'gif_id' => $request->gif_id,
            'title' => $request->title,
            'url' => $request->url
        ]);

        return response()->json($favorite);
    }

    public function index(Request $request)
    {
        return Favorite::where('user_id', $request->user()->id)->get();
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->findOrFail($id);

        $favorite->delete();

        return response()->json([
            'message' => 'Favorite deleted'
        ]);
    }
}
