<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserData;
use Auth;

class ProfileController extends Controller
{
    public function index($id) {

 		$userData = new UserData;
 		$pathAvatar = $userData->getPathAvatarUser();

    	return view('user.profile', ['pathAvatar' => $pathAvatar,
    								'id' => $id]);
    }

}
