<?php

namespace App\Http\Services\Base;

use App\Repositories\Base\BaseRepositoryInterface;

class BaseService implements BaseRepositoryInterface
{

	protected $model;

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function all()
	{
		return $this->getModel()->all();
	}

	public function find($id)
	{
		return $this->getModel()->find($id);
	}

	public function delete($id)
	{
		return $this->find($id)->delete();
	}
}