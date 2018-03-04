<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controller\Base\BaseController;
use App\Repositories\Site\UserRepositoryInterface;

class UserController extends BaseController
{
    protected $title = 'User';

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

        $validate  = Validator::make($request->all(), $this->validationRule($request->get('id')), $this->validationMessage());

        if ($validate->fails()) {
            return $validate->errors()->first();
        }

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

    public function validationRule($id = null)
    {
        $email_unique = Rule::unique('users')->where(function ($query) {
                            return $query->where('deleted_at', null);
                        });

        if($id){
            $email_unique = $email_unique->ignore($id);
        }
        return [
            'email' =>   [
                            'email',
                            $email_unique,
                            'required'
                        ],
            'name' =>   'required',
            'role_id' =>   'required',
            'password' => 'min:8'
        ];
    }

    public function validationMessage()
    {
        return [
            'role_id.required' => 'The role field is required',
        ];
    }

    public function delete($id)
    {
        return (int) $this->getRepository()->delete($id);
    }
}
