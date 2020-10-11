<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Storage;
use File;

class UserData extends Model
{
    protected $fillable = [
        'name', 'surname', 'patronymic', 'avatar', 'user_id'
    ];

    private function scopeHasAvatar($query, $id) {
    	return $query->where('user_id', $id)->where('avatar', NULL)->get();
    }


   	private function userHasAvatar($id) {
   		
   		$userData = UserData::hasAvatar($id);

   		if (empty($userData->avatar)) 
   			return 0;
   		else 
   			return 1;
   	}

   	private function createDirectoryForUser() {
   		$id = Auth::user()->id;
   		$directory = 'public/avatars/id'.$id.'/';
   		
   		if(!Storage::disk('local')->has($directory))
   			Storage::makeDirectory($directory);

   		return $directory;
   	}

   	
   	private function uploadAvatar($path) {
   		
   		$directory = $this->createDirectoryForUser();
   		$path = $directory.$path;	

   		Storage::put($path);
 		
   	}


    private function getPath($id_user) {
    	$path = UserData::select('avatar')->where('user_id', $id_user)->get();
    	return $path;
    }

   	public function getPathAvatarUser() {  		
   		
   		$id = Auth::user()->id;
   		$path = $this->getPath($id);
		
   		if (empty($path->avatar)) {
   			$filePath = "storage/avatars/default/default.png";
   			return $filePath;
   		}  else 
   			return $path->avatar;


   	}
}
