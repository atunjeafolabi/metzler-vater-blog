<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate();

        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            abort(404, 'User does not exist');
        }

        return view('users.show', ['user' => $user]);
    }

    public function showCreateForm()
    {
        return view('users.form.create');
    }

    public function create(CreateUserRequest $request)
    {
        $userData = $request->validated();

        // Auto-generated password for user created by admin
        $password = 'password';
        $userData['password'] = bcrypt($password);

        $isUserCreated = $this->userRepository->create($userData);

        return redirect()->back()->with(["message" => "User created"]);
    }

    public function showUpdateForm($id)
    {
        $user = $this->userRepository->findbyId($id);

        if (!$user) {
            abort(404, 'The User you want to edit does not exist');
        }

        return view('users.form.update', [
            "user" => $user,
        ]);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $userData = $request->except('_method', '_token', 'avatar');

        if ($request->hasFile('avatar')) {
            $imageName                 = $this->saveImage($request, 'avatar', env('AVATAR_STORAGE_PATH'));
            $userData["avatar"] = $imageName;
        }

        $isUpdated = $this->userRepository->update($id, $userData);

        if (!$isUpdated) {
            return redirect()->back();
        }

        return redirect()->route('user', ['id' => $id]);
    }

    public function delete($id)
    {
        $isDeleted = $this->userRepository->delete($id);

        if (!$isDeleted) {
            return redirect()->back();
        }

        return redirect()->route('users');
    }
}
