<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

        $validate  = Validator::make($request->all(), $this->validationRule($id));

        if ($validate->fails()) {
            return $validate->errors()->first();
        }

        $page = new Page;
        if ($id) {
            $page = $this->getRepository()->find($id);
        }

        $page->fill($request->toArray());
        $page->save();

        return $page;
    }

    public function validationRule($id = null)
    {
        $slug_unique = Rule::unique('pages')->where(function ($query) {
                            return $query->where('deleted_at', null);
                        });

        if($id){
            $slug_unique = $slug_unique->ignore($id);
        }
        return [
            'slug' =>   [
                            'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                            $slug_unique,
                            'required'
                        ],
            'name' =>   'required',
            'title' =>   'required',
            'description' =>   'required',
        ];
    }

    public function delete(Request $request, $id)
    {
        return (int) $this->getRepository()->delete($id);
    }


    /**
     * Render dynamic page
     * 
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function renderDynamicPage(Request $request, $slug)
    {
        $page = $this->getRepository()
                    ->getModel()
                    ->whereSlug($slug)
                    ->first();

        if ($page) {
            return view('site.dynamic-page', [
                'data'  => $page,
            ]);   
        }
        abort(404);
    }
}
