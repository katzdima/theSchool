<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\administration;
use App\role;


class adminController extends Controller
{
    public function __construct()
    {
        // authenticat user access 
        $this->middleware('auth');
        $this->middleware('roles');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.administration.administration');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=role::all();
        return view('pages.administration.addAdmin')->with('role',$role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'user_image' => 'image|nullable|max:1999'
        ]);
        //file upload
        if($request->hasFile('user_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('user_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('user_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('user_image')->storeAs('public/user_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

        //Create the administration user
        $adminUser = new administration();

        $adminUser->timestamps = false;

        $adminUser->name = $request->input('name');
        $adminUser->phone = $request->input('phone');
        $adminUser->email = $request->input('email');
        $adminUser->password = bcrypt( $request->input('password'));
        $adminUser->role = $request->input('role');
        $adminUser->image = $fileNameToStore;
        $adminUser->save();

        return redirect('administration')->with('success','New adminstration user added.'); 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailadmin = administration::find($id);
        return view('pages.administration.administration')->with('detailadmin',$detailadmin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editadmin = administration::find($id);
        $role=role::all();
        return view('pages.administration.editAdmin')->with('editadmin',$editadmin)->with('role',$role);
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
        $this->validate ($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'user_image' => 'image|nullable|max:1999'
        ]);

        //file upload
        if($request->hasFile('user_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('user_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('user_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('user_image')->storeAs('public/user_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

        //Find the administration user
        $adminUser = administration::find($id);

        $adminUser->timestamps = false;

        $adminUser->name = $request->input('name');
        $adminUser->phone = $request->input('phone');
        $adminUser->email = $request->input('email');
        $adminUser->password = bcrypt($request->input('password'));
        $adminUser->role = $request->input('role');
        $adminUser->image = $fileNameToStore;
        $adminUser->save();

        return redirect('administration')->with('success','The administration user updated.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adminUser=administration::find($id);
        $adminUser->delete();
        return redirect('administration')->with('success','The administration user deleted.');
    }
}
