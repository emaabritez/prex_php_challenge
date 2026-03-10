<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GiphyService
{
    // public function search($query, $limit = 25, $offset = 0)
    // {
    //     $response = Http::get(config('services.giphy.url').'/gifs/search', [
    //         'api_key' => config('services.giphy.key'),
    //         'q' => $query,
    //         'limit' => $limit,
    //         'offset' => $offset
    //     ]);

    //     return $response->json();
    // }

    // public function search($query, $limit = 25, $offset = 0)
    // {
    //     $response = Http::get(config('services.giphy.url').'/gifs/search', [
    //         'api_key' => config('services.giphy.key'),
    //         'q' => $query,
    //         'limit' => $limit,
    //         'offset' => $offset
    //     ]);

    //     $data = $response->json()['data'];

    //     return collect($data)->map(function ($gif) {
    //         return [
    //             'id' => $gif['id'],
    //             'title' => $gif['title'],
    //             'url' => $gif['url'],
    //             'preview' => $gif['images']['fixed_height']['url']
    //         ];
    //     });
    // }

    public function search($query, $limit = 25, $offset = 0)
    {
        return Cache::remember(
            "giphy_search_{$query}_{$limit}_{$offset}",
            300,
            function () use ($query, $limit, $offset) {

                $response = Http::get(config('services.giphy.url') . '/gifs/search', [
                    'api_key' => config('services.giphy.key'),
                    'q' => $query,
                    'limit' => $limit,
                    'offset' => $offset
                ]);

                $data = $response->json()['data'];

                return collect($data)->map(function ($gif) {
                    return [
                        'id' => $gif['id'],
                        'title' => $gif['title'],
                        'url' => $gif['url'],
                        'preview' => $gif['images']['fixed_height']['url']
                    ];
                });
            }
        );
    }

    public function find($id)
    {
        $response = Http::get(config('services.giphy.url') . "/gifs/$id", [
            'api_key' => config('services.giphy.key')
        ]);

        return $response->json();
    }
}
