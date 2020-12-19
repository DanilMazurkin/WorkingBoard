<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\File\FormAvatars;
use App\Http\Requests\Fio\FormFio;
use App\UserModels\UserData;
use App\User;
use Storage;
use Auth;
use Image;
use File;

class ProfileController extends Controller
{
    public function index(User $user) 
    {

        $id = $user->id;
        $hasUser = $user->checkUserInSystem($id);
        $user = new User;

        if ($hasUser) {

            $userData = new UserData;
            $fio = $userData->getFioUser($id);
            $hasGoogle = $user->checkUserFromGoogle($id);


        	return view('user.profile', ['userdata' => $userData,
        								'id' => $id, 'fio' => $fio,
                                        'user' => $user
                                        ]);
        } else 
            return view('user.error');

    }

    public function setAvatar(FormAvatars $request) 
    {
    	
    	$userData = new UserData;

        $id = Auth::user()->id;
        $user = User::find($id);

    	if ($request->hasFile("avatar")) 
        {

            $hasDirectory = $userData->createDirectoryForUser();
            
            if ($hasDirectory)
                $userData->clearImagesInUserFolder();

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $directory = $userData->getFolderUser();
            $path = $directory.$filename;



            $store = Storage::disk('public')->put($path, File::get($avatar));                      

            $userData->setPathForModel($path);

    	}

       return redirect()->route('profile', ['user' => $user]);
    }


    public function setFio(FormFio $request) 
    {
        $userData = new UserData;
        $id = Auth::user()->id;

        $name = $request->input('name');
        $surname = $request->input('surname');
        $patronymic = $request->input('patronymic');
        
        $userData->setFioUser($id, $name, $surname, $patronymic);
        
        $user = User::find($id);


        return redirect()->route('profile', ['user' => $user]);
    }
}
