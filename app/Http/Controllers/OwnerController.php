<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Photo;
use App\Owner;
use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.index', [
            'owners' => Auth::user()->owners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.create');
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
            'name' => 'required | alpha',
            'address' => 'required',
            'phone_num' => 'required | numeric',
        ]);
        $input = $this->formInput($request);
        $user = Auth::user();
        $user->owners()->create($input);
        $request->session()->flash('msg', 'New Owner added by ' . $user->name);
        return redirect('/owner');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        session(['owner_url' => request()->path()]);
        session(['contract_url' => request()->path()]);
        return view('owner.show', [
            'owner' => Owner::findBySlugOrFail($slug)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('owner.edit', [
            'owner' => Owner::findBySlugOrFail($slug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required | alpha',
            'address' => 'required',
            'phone_num' => 'required | numeric',
        ]);
        $input = $this->formInput($request);
        $owner = Owner::findBySlugOrFail($slug);
        Session::flash('msg', $owner->name . " updated");
        $owner->update($input);
        return redirect('/owner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($slug)
    {
        $owner = Owner::findBySlugOrFail($slug);
        Session::flash('msg', $owner->$slug . ' deleted');
        if ($owner->photo_id != 1) {
            unlink(public_path() . $owner->photo->photo_path);
            $owner->photo->delete();
        }
        $owner->delete();
        return redirect(Session('company_url'));
    }

    public function formInput($request)
    {
        $input = $request->all();

        if ($photoFile = $request->file('photo_id')) {
            $photoName = time() . " " . $photoFile->getClientOriginalName();
            $photoFile->move('images', $photoName);

            $photo = Photo::create(['photo_path'=> $photoName]);
            $input['photo_id'] = $photo->id;
        }
        return $input;
    }

    public function contractCreate($slug)
    {
        $owner = Owner::findBySlugOrFail($slug);
        $brands = $owner->car->pluck('brand_id')->unique();
        return view('contract.create', [
            'vendor' => $owner,
            'brand' => Brand::find($brands)->pluck('name','id')
        ]);
    }

    public function contractEdit($slug, $id)
    {
        $owner = Owner::findBySlugOrFail($slug);
        $brands = $owner->car->pluck('brand_id')->unique();
        return view('contract.edit', [
            'vendor' => $owner,
            'contract' => Contract::findOrFail($id),
            'brand' => Brand::find($brands)->pluck('name','id')
        ]);
    }

    public function carCreate($slug)
    {
        return view('car.create', [
            'owner' => Owner::findBySlugOrFail($slug),
            'brand' => Brand::all()->pluck('name', 'id'),
            'companies' => Auth::user()->companies()->pluck('name', 'id'),
        ]);
    }
}
