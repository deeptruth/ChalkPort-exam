<?php

namespace App\Http\Controller\Base;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	protected $repository;

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function getRepository()
    {
        return $this->repository;
    }
}