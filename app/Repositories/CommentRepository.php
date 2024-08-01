<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAll()
    {
        return Comment::all();
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function findById($id)
    {
        return Comment::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return $comment;
    }

    public function findByPostId($postId)
    {
        return Comment::where('post_id', $postId)->get();
    }
}
