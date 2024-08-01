<?php

namespace App\Contracts;

interface CommentServiceInterface
{
    public function getAllComments();
    public function createComment(array $data);
    public function getCommentById($id);
    public function updateComment($id, array $data);
    public function deleteComment($id);
    public function getCommentsByPostId($postId);
}
