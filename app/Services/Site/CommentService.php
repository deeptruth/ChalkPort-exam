<?php

namespace App\Services\Site;

use App\Comment;
use App\Http\Services\Base\BaseService;
use App\Repositories\Site\CommentRepositoryInterface;

class CommentService extends BaseService implements CommentRepositoryInterface
{
	public function __construct(Comment $pageModel)
	{
		$this->setModel($pageModel);
	}
}