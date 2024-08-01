<?php

namespace App\Services;

use App\Contracts\CommentServiceInterface;
use App\Repositories\CommentRepositoryInterface;

class CommentService implements CommentServiceInterface
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getAllComments()
    {
        return $this->commentRepository->getAll();
    }

    public function createComment(array $data)
    {
        return $this->commentRepository->create($data);
    }

    public function getCommentById($id)
    {
        return $this->commentRepository->findById($id);
    }

    public function updateComment($id, array $data)
    {
        return $this->commentRepository->update($id, $data);
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->delete($id);
    }

    public function getCommentsByPostId($postId)
    {
        return $this->commentRepository->findByPostId($postId);
    }
}
