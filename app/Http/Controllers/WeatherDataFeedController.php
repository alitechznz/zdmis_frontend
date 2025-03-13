<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherDataFeedController extends Controller
{
    //
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function getPosts()
    {
        return Http::get("{$this->baseUrl}/posts")->json();
    }

    public function getPost($id)
    {
        return Http::get("{$this->baseUrl}/posts/{$id}")->json();
    }

    public function createPost($data)
    {
        return Http::post("{$this->baseUrl}/posts", $data)->json();
    }

    public function updatePost($id, $data)
    {
        return Http::put("{$this->baseUrl}/posts/{$id}", $data)->json();
    }

    public function deletePost($id)
    {
        return Http::delete("{$this->baseUrl}/posts/{$id}")->json();
    }
}
