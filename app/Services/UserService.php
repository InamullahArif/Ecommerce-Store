<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Mail\MyTestMail;
use App\Models\Notification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserService
{
    public function getAllUsers($request,$perPage = 10)
    {
        // return User::where('email', '!=', 'superadmin@awn.com')->paginate($perPage);
        $query = User::with('image')
        ->ApplyFilter($request->only(['search_by_name']))
        ->where('id','!=',1)->orderBy('created_at', 'desc');
//  dd($query->get());
    return $query->paginate($perPage)->withQueryString();
    }
    public function getAllRoles()
    {
        return Role::where('id','!=',1)->get();
    }

    public function addUser($request)
    {
        // dd($request->all());
        // $user = User::where('email',$request->email)->get();
        // if ($user) {
        //     return ['error' => 'User with this email already exists.'];
        // }
        // dd($request->all());
        // $imagePath = $request->file('image')->store('profile_images', 'public');
        $role = Role::find($request['role_id']);
        
        // Move the uploaded file to public folder
        // $request->image->move(public_path('uploaded'), $imageName);
        // $image = Image::create(['name' => $imageName]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            // 'image_id' => $image->id,
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('user_images'), $imageName);
            $imageUrl = 'user_images/' . $imageName;
            $image = new Image(['name' => $imageUrl]);
            $user->image()->save($image);
        }else
        {
            // $image = Image::findOrFail(1);
            // $image = 'user_images/user.jpg';
            $imageUrl = 'user_images/user.jpg';
            $image = new Image(['name' => $imageUrl]);
            $user->image()->save($image);
        }
        // $imageModel = Image::create(['name' => $imageName]);
        // $user->image()->save($imageModel);
        
        $user->assignRole($role);
        return $user;
}
        public function getSingleUser($id)
        {
            $user = User::with('image')->find($id);
            return $user;
        }
        public function update($request, $id)
        {
            // dd($request->all());
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $role = Role::find($request['role_id']);
            if ($request->hasFile('image')) {
                // dd('here');
                // $imageFile = $request->file('image');
                if(($user->image) == null)
                {
                    $imageName = time().'.'.$request->image->extension(); 
                    $request->image->move(public_path('user_images'), $imageName);
                    $imageUrl ='user_images/' . $imageName;
                    $image = new Image(['name' => $imageUrl]);
                    $user->image()->save($image);
                }else
                {
                    // dd($user->image);
                    if(!$user->image->name == 'user_images/user.jpg')
                    {
                        if(File::exists(public_path($user->image->name))){
                            File::delete(public_path($user->image->name));
                        }
                    }
                    $imageName = time() . '.' . $request->image->extension(); 
                    $request->image->move(public_path('user_images'), $imageName);
                    $existingImage = $user->image;
                    $existingImage->name = 'user_images/' . $imageName;
                    $existingImage->save();
                }
                
            }
                $user->save();
                // $user->syncRole($role);
                $user->syncRoles($role);
                return $user;
                // return response()->json(['message' => 'User updated successfully'], 200);
        }

            public function deleteUser($id)
            {
                
            $user = User::find($id);
            $user->delete();
            return $user;
            }
            public function updateProfile($request,$id)
            {
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->hasFile('image')) {
                    if(($user->image) == null)
                    {
                    
                        $imageName = time().'.'.$request->image->extension(); 
                        $request->image->move(public_path('user_images'), $imageName);
                        $imageUrl = 'user_images/' . $imageName;
                        $image = new Image(['name' => $imageUrl]);
                        $user->image()->save($image);
                    }else
                    {
                        // dd($user->image->name);
                        if(File::exists(public_path($user->image->name))){
                            File::delete(public_path($user->image->name));
                        }
                        $imageName = time() . '.' . $request->image->extension(); 
                        $request->image->move(public_path('user_images'), $imageName);
                        $existingImage = $user->image;
                        $existingImage->name = 'user_images/' . $imageName;
                        $existingImage->save();
                    }
                
                }
                $user->save();
                return $user;
            }
            public function showProfile($id)
            {
                $user = User::with('image')->find($id);
                return $user;
            }
            public function sendEmailToUser($user)
            {
                $mailData = [
                    'title' => 'Registration successful',
                    'url' => 'http://127.0.0.1:8000/',
                    'name'=>$user->name,
                ];
                Mail::to($user->email)->send(new MyTestMail($mailData));
                // dd('emai sent');
            }
            // public function createNotication($user)
            // {
            //     $notification = Notification::create([
            //         'name'=> 'Registration Successful',
            //         'detail' => $user->name . ' was registered successfully!',
            //     ]);
            // }
            public function createNotication($name,$detail)
            {
                $notification = Notification::create([
                    'name'=> $name,
                    'detail' => $detail,
                ]);
            }

}
