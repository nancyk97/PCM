<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\CommentServiceInterface;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        // dd('111111');
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $comments = $this->commentService->getAllComments();
            $message = __('messages.comments_retrieved_success');

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $comments,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            $message = __('messages.comments_retrieved_failure');

            return response()->json([
                'success' => false,
                'message' => $message,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        // The validated data is automatically available via $request
        $validatedData = $request->validated();

        try {
            $comment = $this->commentService->createComment($validatedData);

            return response()->json([
                'success' => true,
                'message' => __('messages.comment_created_success'),
                'data' => $comment,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('messages.comment_created_failure'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $comment = $this->commentService->getCommentById($id);

            if (!$comment) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.comment_not_found'),
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => __('messages.comment_retrieved_success'),
                'data' => $comment,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('messages.comment_retrieved_failure'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        $validatedData = $request->validated();

        try {
            $comment = $this->commentService->updateComment($id, $validatedData);

            if (!$comment) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.comment_not_found'),
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => __('messages.comment_updated_success'),
                'data' => $comment,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('messages.comment_updated_failure'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $isDeleted = $this->commentService->deleteComment($id);

            if (!$isDeleted) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.comment_not_found'),
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => __('messages.comment_deleted_success'),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('messages.comment_deleted_failure'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // comments for post by id
    public function commentsByPostId($postId)
    {
        try {
            $comments = $this->commentService->getCommentsByPostId($postId);
            $message = __('messages.comments_retrieved_success');

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $comments,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            $message = __('messages.comments_retrieved_failure');

            return response()->json([
                'success' => false,
                'message' => $message,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
