<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
	public function setModel($model);

	public function getModel();

	public function all();

	public function find($id);

	public function delete($id);
}