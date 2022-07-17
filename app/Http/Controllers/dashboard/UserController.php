<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');

    }//end of constructor

   
    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        })->latest()->paginate(4);
        return view('dashboard.users.index',compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);



        if ($request->image) {

            Image::make($request->image)
                ->resize(50,50)
                ->save(public_path('uploads/users/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $user=User::create($request_data);

        $user->attachRole('admin');

        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.added_successfully'));

        return redirect()->route('dashboard.users.index');
        
    }

   

   
    public function edit($id)
    {
        $user=User::findorfail($id);
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => ['required', Rule::unique('users')->ignore($id),],
            'image' => 'image',
            'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['permissions', 'image']);

        if ($request->image) {

            $old_name=User::findorfail($id)->image ;
            if ($old_name != 'default.png') {
    
                Storage::disk('uploads')->delete('users/' . $old_name);
    
            }//end of if

            Image::make($request->image)
                ->resize(50,50)
                ->save(public_path('uploads/users/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of external if

        User::findorfail($id)->update($request_data);


        User::findorfail($id)->syncPermissions($request->permissions);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('dashboard.users.index');
    }

    
    public function destroy($id)
    {
        
        $old_name=User::findorfail($id)->image ;
        if ($old_name != 'default.png') {

            Storage::disk('uploads')->delete('users/' . $old_name);

        }//end of if



        User::findorfail($id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
