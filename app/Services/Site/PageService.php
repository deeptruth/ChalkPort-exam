<?php

namespace App\Services\Site;

use App\Page;
use App\Http\Services\Base\BaseService;
use App\Repositories\Site\PageRepositoryInterface;

class PageService extends BaseService implements PageRepositoryInterface
{
	public function __construct(Page $pageModel)
	{
		$this->setModel($pageModel);
	}
}