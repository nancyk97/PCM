<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Api\CommentController;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;

class CommentControllerTest extends TestCase
{
    protected $commentRepository;
    protected $commentController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentRepository = Mockery::mock(CommentRepository::class);
        $this->commentController = new CommentController($this->commentRepository);
    }

    public function testShowSuccess()
    {
        $commentId = 1;
        $comment = ['id' => $commentId, 'content' => 'Test comment'];

        $this->commentRepository
            ->shouldReceive('find')
            ->with($commentId)
            ->andReturn($comment);

        $response = $this->commentController->show($commentId);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertTrue($response->getData()->success);
        $this->assertEquals(__('messages.comment_retrieved_success'), $response->getData()->message);
        $this->assertEquals($comment, (array)$response->getData()->data);
    }

    public function testShowNotFound()
    {
        $commentId = 1;

        $this->commentRepository
            ->shouldReceive('find')
            ->with($commentId)
            ->andReturn(null);

        $response = $this->commentController->show($commentId);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertFalse($response->getData()->success);
        $this->assertEquals(__('messages.comment_not_found'), $response->getData()->message);
    }

    public function testShowException()
    {
        $commentId = 1;

        $this->commentRepository
            ->shouldReceive('find')
            ->with($commentId)
            ->andThrow(new \Exception('Database error'));

        $response = $this->commentController->show($commentId);

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertFalse($response->getData()->success);
        $this->assertEquals(__('messages.comment_retrieved_failure'), $response->getData()->message);
    }

    public function testStoreSuccess()
    {
        $request = Request::create('/comments', 'POST', ['content' => 'Test comment']);
        $comment = ['id' => 1, 'content' => 'Test comment'];

        $this->commentRepository
            ->shouldReceive('create')
            ->with(['content' => 'Test comment'])
            ->andReturn($comment);

        $response = $this->commentController->store($request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertTrue($response->getData()->success);
        $this->assertEquals(__('messages.comment_created_success'), $response->getData()->message);
        $this->assertEquals($comment, (array)$response->getData()->data);
    }

    public function testStoreValidationFailure()
    {
        $request = Request::create('/comments', 'POST', []);

        $response = $this->commentController->store($request);

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    public function testStoreException()
    {
        $request = Request::create('/comments', 'POST', ['content' => 'Test comment']);

        $this->commentRepository
            ->shouldReceive('create')
            ->with(['content' => 'Test comment'])
            ->andThrow(new \Exception('Database error'));

        $response = $this->commentController->store($request);

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertFalse($response->getData()->success);
        $this->assertEquals(__('messages.comment_created_failure'), $response->getData()->message);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
