<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GiphyService;
use Illuminate\Http\Request;

class GifController extends Controller
{
    public function __construct(private GiphyService $giphy){}

    public function search(Request $request)
    {
        return $this->giphy->search(
            $request->query('query'),
            $request->query('limit', 25),
            $request->query('offset', 0)
        );
    }

    public function show($id)
    {
        return $this->giphy->find($id);
    }
}