<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('user.edit', [
            'user' => User::findBySlugOrFail($slug)
        ]);
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
        $inputUser = $this->formInputUser($request);
        $user = User::findOrFail($id);
        Session::flash('msg', "User " . $user->name . " updated");
        $user->update($inputUser);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function formInputUser($request)
    {
        if(trim($request->password) !== ""){
            $input['password'] = bcrypt($request->password);
        }
        $input['name'] = $request->name;
        $input['email'] = $request->email;

        if ($photoFile = $request->file('photo_id')) {
            $photoName = time() . " " . $photoFile->getClientOriginalName();
            $photoFile->move('images', $photoName);

            $photo = Photo::create(['photo_path'=> $photoName]);
            $input['photo_id'] = $photo->id;
        }
        return $input;
    }
}
