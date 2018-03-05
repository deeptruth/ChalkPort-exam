<?php

namespace App\Services\Site;

use App\User;
use App\Http\Services\Base\BaseService;
use App\Repositories\Site\UserRepositoryInterface;

class UserService extends BaseService implements UserRepositoryInterface
{
	public function __construct(User $pageModel)
	{
		$this->setModel($pageModel);
	}
}