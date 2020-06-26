<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServiceInterface;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param userServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        // $this->middleware('auth');
        $this->userService = $userService;
    }
    public function show()
    {
        $user = User::with('users')->get();
        return $user;
        // return response()->json(User::all());
    }
    public function createconfirm(UserRequest $request)
    {
        $validator = $request->validated();
        $user = new User;
        $user->name = $validator['name'];
        $user->email = $validator['email'];
        $user->password = Hash::make($validator['password']);
        $user->type = $validator['type'];
        $user->phone = $validator['phone'];
        if ($request->hasFile('profile')) {
            $profile_img = $validator['profile'];
            $filename = $profile_img->getClientOriginalName();
            $profile_img->move('img/tempProfile', $filename);
            $user->profile = $filename;
        }
        // $test = $request->photo;
        $user->dob = $validator['dob'];
        $user->address = $validator['address'];
        $user->create_user_id = Auth::guard("api")->user()->id;
        $user->updated_user_id = Auth::guard("api")->user()->id;

        return $user;
    }
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile = $request->profile;
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->create_user_id = Auth::guard("api")->user()->id;
        $user->updated_user_id = Auth::guard("api")->user()->id;
        $user->save();
        // return response()->json('The user successfully added');
        return response()->json([
            "user" => $user,
            "message" => "The user successfully added"
        ]);
    }

    public function editconfirm(Request $request)
    {
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->type = $request['type'];
        $user->phone = $request['phone'];
        // if ($request->hasFile('profile')) {
        //     $profile_img = $request['profile'];
        //     $filename = $profile_img->getClientOriginalName();
        //     $profile_img->move('img/tempProfile', $filename);
        //     $user->profile = $filename;
        // }
        // $test = $request->photo;
        $user->profile = $request['profile'];
        $user->dob = $request['dob'];
        $user->address = $request['address'];
        $user->updated_user_id = Auth::guard("api")->user()->id;
        $user->updated_at = now();
        // return response()->json("The user successfully update");
        return response()->json([
            "user" => $user,
            "message" => "The user confirm"
        ]);
    }
    public function update(Request $request)
    {
        // $users = User::find($request['id']);
        // $users->update($request->all());
        // return response()->json([
        //     "user" => $users,
        //     "message" => "The user successfully update"
        // ]);

        $user = new User;
        $user = User::find($request['id']);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->type = $request['type'];
        $user->phone = $request['phone'];
        if ($request->hasFile('profile')) {
            $profile_img = $request['profile'];
            $filename = $profile_img->getClientOriginalName();
            $profile_img->move('img/tempProfile', $filename);
            $user->profile = $filename;
        }
        // $user->profile = $request['profile'];
        $user->dob = $request['dob'];
        $user->address = $request['address'];
        $user->updated_user_id = Auth::guard("api")->user()->id;
        $user->updated_at = now();
        $user->save();
        return response()->json([
            "user" => $user,
            "message" => "The user successfully update"
        ]);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->deleted_user_id = Auth::guard("api")->user()->id;
        $user->deleted_at = now();
        $user->save();
        return response()->json([
            "user" => $user,
            "message" => "The user successfully delete"
        ]);
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(Auth::guard("api")->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return response()->json([
            'message' => 'Password updated'
        ]);
    }
}
