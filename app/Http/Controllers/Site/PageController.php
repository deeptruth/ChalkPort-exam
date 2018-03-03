<?php

namespace App\Http\Controllers\Site;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controller\Base\BaseController;
use App\Repositories\Site\PageRepositoryInterface;

class PageController extends BaseController
{
    protected $title = 'Pages';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->setRepository($pageRepository);
    }

    /**
     * Show the pages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pages = $this->getRepository()->getModel()->paginate(10);

        return view('admin.pages.index', [
            'title' => $this->title,
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('admin.pages.form', [
            'url' => url('pages/store'),
            'title' => $this->title,
            'type' => 1
        ]);   
    }

    public function edit(Request $request, $id)
    {
        $page = $this->getRepository()->find($id);

         return view('admin.pages.form', [
            'url'   => url('pages/store/'.$id),
            'title' => $this->title,
            'data'  => $page,
            'type' => 2
        ]);   
    }

    public function store(Request $request, $id = null)
    {
        $page = new Page;
        if ($id) {
            $page = $this->getRepository()->find($id);
        }

        $page->fill($request->toArray());
        $page->save();

        return $page;
    }

    public function delete(Request $request, $id)
    {
        return (int) $this->getRepository()->delete($id);
    }
}
