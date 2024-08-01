<?php

namespace Tests\Unit;

use App\Contracts\CommentServiceInterface;
use Tests\TestCase;
use App\Http\Controllers\Api\CommentController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;

class CommentControllerTest extends TestCase
{
    public function testShow()
    {
        // Create a mock CommentServiceInterface
        $commentService = Mockery::mock(CommentServiceInterface::class);

        // Set up the expected comment data
        $commentData = [
            'id' => 1,
            'text' => 'This is a comment',
            'user_id' => 1,
            'post_id' => 1,
        ];

        // Set up the expected response
        $expectedResponse = [
            'success' => true,
            'message' => __('messages.comment_retrieved_success'),
            'data' => $commentData,
        ];

        // Mock the CommentServiceInterface method
        $commentService->shouldReceive('getCommentById')
            ->with(1)
            ->andReturn($commentData);

        // Create an instance of the CommentController and inject the mock CommentServiceInterface
        $commentController = new CommentController($commentService);

        // Create a mock Request
        $request = Mockery::mock(Request::class);

        // Call the show method
        $response = $commentController->show(1);

        // Assert that the response matches the expected response
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($expectedResponse, $response->getData(true));
    }
}
