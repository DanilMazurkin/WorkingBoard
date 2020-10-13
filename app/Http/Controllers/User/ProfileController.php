<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\File\Avatars;
use App\UserData;
use Auth;
use Image;

class ProfileController extends Controller
{
    public function index($id) {

 		$userData = new UserData;
 		$pathAvatar = $userData->getPathAvatarUser();

    	return view('user.profile', ['pathAvatar' => $pathAvatar,
    								'id' => $id]);
    }

    public function updateData(Avatars $request, $id) {
    	
    	$userData = new UserData;

    	if ($request->hasFile("avatar")) {

            $userData->createDirectoryForUser();
            $userData->clearImagesInUserFolder();

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $directory = $userData->getFolderUser();
            
            $directory = storage_path('app/public').$directory;
            Image::make($avatar)->resize(300, 300)->save($directory.$filename);
            
            $userData->setPathForModel($filename);

    	}

        return redirect()->route('profile', ['id' => Auth::user()->id]);
    }

}
