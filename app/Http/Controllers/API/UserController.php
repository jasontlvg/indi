<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'type' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'bio' => 'required',
        ]);
        $request->merge(['password' => Hash::make($request->password)]);

        $user= new User($request->all());
        if ($user->save()){
            return ['message' => 'El usuario se a agregado'];
        }else{
            return ['message' => 'Error'];
        }
//        $date = Carbon::now();
//
//        $user= new User();
//        $user->name= $request->name;
//        $user->email= $request->email;
//        $user->bio= $request->bio;
//        $user->type= $request->type;
//        $user->password= Hash::make($request->password);
//        $user->save();
//        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'type' => 'required',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'bio' => 'required'
        ]);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->type= $request->type;
        $user->bio= $request->bio;
        $user->password= Hash::make($request->password);
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return ['message' => 'Exitosamente Eliminado'];
    }

    public function profile()
    {
        $user= auth('api')->user();
        return $user;
    }

    public function updateProfile(Request $request)
    {

        $user= auth('api')->user();

//        Image::configure(array('driver' => 'imagick'));
        Image::make($request->photo)->save(public_path('img/jason.png'));


        return $request->photo;
    }
}
