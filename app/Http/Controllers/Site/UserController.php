<?php

namespace App\Http\Controllers\Site;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controller\Base\BaseController;
use App\Repositories\Site\UserRepositoryInterface;

class UserController extends BaseController
{
    protected $title = 'List of User';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->setRepository($userRepository);
    }

    /**
     * Show the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = $this->getRepository()->getModel()->with('role')->paginate(10);

        return view('admin.users.index', [
            'title' => $this->title,
            'users' => $users,
            'roles' => Role::all()
        ]);
    }

    /**
     * Store user
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {

        if ($request->get('id')) {
            $user = $this->getRepository()->find($request->get('id'));

            $user->fill($request->toArray());
            if($request->get('password')){
                $user->password = bcrypt($request->get('password'));
            }
        }else{
            $user = new User();

            $user->fill($request->toArray());
            $user->password = bcrypt(DEFAULT_PASSWORD);
        }
        
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        return (int) $this->getRepository()->delete($id);
    }
}
