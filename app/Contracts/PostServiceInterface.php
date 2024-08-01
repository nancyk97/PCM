<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PostServiceInterface
{
    public function getAllPosts();
    public function getPostById($id);
    public function createPost(Request $request);
    public function updatePost($id, Request $request);
    public function deletePost($id);
}