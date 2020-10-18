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
    public function index($id) 
    {

        $user = new User;
        $hasUser = $user->checkUserInSystem($id);

        if ($hasUser) {
            $userData = new UserData;
     		$pathAvatar = $userData->getPathAvatarUser($id);
            $fio = $userData->getFioUser($id);
            
        	return view('user.profile', ['pathAvatar' => $pathAvatar,
        								'id' => $id, 'fio' => $fio]);
        } else 
            return view('user.error');

    }

    public function updateData(FormAvatars $request, $id) 
    {
    	
    	$userData = new UserData;

    	if ($request->hasFile("avatar")) 
        {

            $hasDirectory = $userData->createDirectoryForUser();
            
            if ($hasDirectory)
                $userData->clearImagesInUserFolder();

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $directory = $userData->getFolderUser();
            
            Image::make($avatar)->resize(300, 300)->save($directory.$filename);
            
            $userData->setPathForModel($filename);

    	}

        return redirect()->route('profile', ['id' => Auth::user()->id]);
    }


    public function setFio(FormFio $request, $id) 
    {
        $userData = new UserData;
        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $patronymic = $request->input('patronymic');
        
        $userData->setFioUser($id, $name, $surname, $patronymic);

        return redirect()->route('profile', ['id' => $id]);
    }
}
