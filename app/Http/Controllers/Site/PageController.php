<?php

namespace App\Http\Controllers\Site;

use Validator;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use App\Http\Controller\Base\BaseController;
use App\Repositories\Site\PageRepositoryInterface;
use App\Repositories\Site\CommentRepositoryInterface;

class PageController extends BaseController
{

    protected $commentRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepositoryInterface $pageRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->setRepository($pageRepository);

        $this->commentRepository = $commentRepository;
    }

    public function renderDynamicPage(Request $request, $slug)
    {
        $page = $this->getRepository()
                    ->getModel()
                    ->whereSlug($slug)
                    ->first();

        if ($page) {
            return view('site.dynamic-page', [
                'data'  => $page,
                'comments' => $page->comments
            ]);   
        }
        abort(404);
    }

    public function storeComment(Request $request, $page_id)
    {
        $comment = new Comment();
        if($request->get('id')){
            $comment = $this->commentRepository->getModel()->find($request->get('id'));
        }

        $comment->fill($request->toArray());
        $comment->user_id = $request->user()->id;
        $comment->page_id = $page_id;
        $comment->save();

        $new_comment = $this->commentRepository
                    ->getModel()
                    ->with('user')
                    ->find($comment->id);
        $new_comment->time = comment_time($new_comment->created_at);

        $pusher = App::make('pusher');

        if(!$request->get('id')){
            $pusher->trigger( 'page-'.$page_id,
                              'comment-notification',
                              $new_comment
                            );
        }else{
            $pusher->trigger( 'page-'.$page_id.'-edit-comment',
                              'edit-comment-notification',
                              $new_comment
                            );
        }
        return $new_comment;
    }

    public function deleteComment(Request $request, $id)
    {
        $comment = $this->commentRepository
                    ->getModel()
                    ->find($id);

        // allow to delete if author or admin
        if($comment->user_id == $request->user()->id || $request->user()->role_id == 1){
            return (int) $comment
                    ->delete();
        }

        return response(['error' => 500, 'message' => 'Errors: You are not allowed to delete this comment'], 500)->header('Content-Type', 'application/json');
    }
}
