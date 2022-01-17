<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
{
    $this->middleware(['role:Admin']);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return Inertia::render('User/Index', [
            'usuarios' =>  User::query()
                ->with('roles')
                ->filter(request()->only("search"))
                ->paginate(10)
        ]);
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

        ]);
     
        $user =User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole('Normal');
        return redirect()->back()->with(['success'=> 'Usuario actualizado.']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {
        $usuario= User::find($request->id);
  
        $rules = [
            'name' => 'required',
            'email' => ['required',  Rule::unique('users')->ignore($request->id)]
        ];
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', 'min:8'];
        }

        $data = $request->validate($rules);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }
        $usuario->update($data);
        

        return redirect()->back()->with(['success'=> 'Usuario actualizado.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario= User::find($id);
        $usuario->delete();
        return redirect()->back()->with(['success'=> 'Usuario eliminado.']);

    }
}
