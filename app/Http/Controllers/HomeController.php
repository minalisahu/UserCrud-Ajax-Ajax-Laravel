<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tinkeshwar\Imager\Facades\Imager;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userList(Request $request)
    {
        $userData = User::where('is_admin',0)->paginate(10);
        return json_encode($userData);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'birth' => 'nullable',
            'password' => 'nullable',
            'image'=>'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all(), 'status' => false]);
        }

        // dd($request->all());

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);


        if ($user = User::create($data)) {
            if ($request->hasfile('image')) {
                $user->image()->create([
                    'name' => Imager::moveFile($request->file('image')),
                    'path' => 'public/'
                ]);
            }
            return response()->json(['success_message' => 'successfully added', 'status'=>true]);
        }

    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrfail($request->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,' .$user->id,
            'birth' => 'nullable',
            'password' => 'nullable',
            'profile_image'=>'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all(), "status"=>false]);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);


        if ($user->update($data)) {
            if ($request->hasfile('image')) {
                $user->image()->create([
                    'name' => Imager::moveFile($request->file('image')),
                    'path' => 'public/'
                ]);
            }
            return response()->json(['success_message' => 'successfully updated', "status"=>true]);
        }
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('home')->with('success_message', __('User was successfully deleted.'));
        }
        return back()->withInput()->with('error_message', __('Unexpected error occurred while trying to process your request.'));

    }


}