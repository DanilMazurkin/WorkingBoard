<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\File\FormAvatars;
use App\Http\Requests\Fio\FormFio;
use App\UserData;
use App\User;
use Auth;
use Image;

class ProfileController extends Controller
{
    public function index(User $user) 
    {

        $id = $user->id;
        $hasUser = $user->checkUserInSystem($id);

        if ($hasUser) {

            $userData = new UserData;
     		$pathAvatar = $userData->getPathAvatarUser($id);
            $fio = $userData->getFioUser($id);
            $hasGoogle = $user->checkUserFromGoogle($id);

        	return view('user.profile', ['pathAvatar' => $pathAvatar,
        								'id' => $id, 'fio' => $fio,
                                        'hasGoogle' => $hasGoogle]);
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

            Image::make($avatar)->resize(300, 300)->save(public_path($directory.$filename));
            
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
