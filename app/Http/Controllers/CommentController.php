<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function create(CreateCommentRequest $request)
    {
        $commentData = $request->validated();
        $commentData['created_by'] = Auth::id();

        $isCreated = $this->commentRepository->create($commentData);

        return redirect()->to(url()->previous() . '/#comments-section');
        ;
    }
}
