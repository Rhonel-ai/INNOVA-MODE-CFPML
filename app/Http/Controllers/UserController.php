<?php

    

namespace App\Http\Controllers;

    

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Models\Activity;


use DB;

use Hash;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller

{
    use HasRoles;

    //  function __construct()

    // {

    //      $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);

    //      $this->middleware('permission:user-create', ['only' => ['create','store']]);

    //      $this->middleware('permission:user-edit', ['only' => ['edit','update']]);

    //      $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    // }
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $data = User::orderBy('id','DESC')->paginate(5);
        // stocker les données dans la session
        // session(['dashboard_data'=> $data]);
        return view('admin.pages.users.index',compact('data'))  
            ->with('i', ($request->input('page', 1) - 1) * 5);
            
         $user = Auth::user();

    }

    // public function search(Request $request)
    // {
    //     $query=$request->input('query');
    //     $data =collect();
    //     if ($query) {
    //         # code...
       
    //     $data = User::whereAny([
    //         'name',
    //         'email',
    //         'role',
            
            
            
    //     ],'like','%'. $query . '%')->get();
    //      }
    //     return view('admin.pages.users.index',compact('users'))  ;

    // }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {
        $roles = Role::pluck('name','name')->all();
        $this->authorize('user-create');
        return view('admin.pages.users.create',compact('roles'));

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

            'email' => 'required|email|unique:users,email',

            'password' => 'required|same:confirm-password',

            'roles' => 'required'

        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        // activity()->log('Création de ' . $request->input('name'));
        return redirect()->route('users.index')->with('success','User created successfully');

    }

    

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $user = User::find($id);
        $nbrUser= User::count();
        $columns=Schema::getColumnListing('users');
        $filledColumns=0;
        foreach($columns as $column){
        // dd($column,$user->$column);
        if($user->$column){
        $filledColumns++;
         }
      }
       $progress=($filledColumns / count($columns))*100;




        return view('admin.pages.users.show',compact('user','nbrUser','progress'));

    }

    

    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('user-edit');
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.pages.users.edit',compact('user','roles','userRole'));

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'

        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success','User updated successfully');

    }

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {
// dd($id);
    $user=User::find($id);
    $this->authorize('user-delete');
    $user->delete();
    return redirect()->route('users.index') ->with('success','User deleted successfully');

    }

    public function updateProfile(Request $request,User $user )
{
    // dd($id);
    // Validation de l'image
    $request->validate([
        'upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
    ]);
   
    //  dd($user);
    // Stockage de l'image de profil
    if ($request->hasFile('upload')) {
        $image = $request->file('upload');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/uploads', $imageName);
        if ($user->upload) {
            Storage::delete('public/uploads/' .$user->upload);
        }
        
        $user->upload = $imageName;
        // $user= User::findOrFail($id);return redirect()->route('users.index')
        
        $user->save();
        
    }

    return redirect()->route('profile.user.user', $user->id);
}




}