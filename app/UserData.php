<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use Storage;
use File;

class UserData extends Model
{
    protected $fillable = [
        'name', 'surname', 'patronymic', 'avatar', 'user_id'
    ];

    public function clearImagesInUserFolder() {
        
        $directory = $this->getFolderUser();        

        $files = Storage::disk('public')->allFiles($directory);
        Storage::disk('public')->delete($files);
    } 


   	public function createDirectoryForUser() {
   		
   		$directory = $this->getFolderUser();

   		if(!Storage::disk('public')->has($directory)) {     
          Storage::disk('public')->makeDirectory($directory);
          return 0;
      } else 
          return 1;


   	}

    public function getFolderUser() {
      
      $id = Auth::user()->id;
      $directory = '/avatars/id'.$id.'/';   
      
      return $directory;
    }

    private function getPathFromModel($id_user) {
    	$path = UserData::select('avatar')->where('user_id', $id_user)->get();
      return $path;
    }

    public function setPathForModel($path) {
      $id = Auth::user()->id;
      
      $directory = $this->getFolderUser();
      $directory = 'storage'.$directory;
      $path = $directory.$path;
     
      UserData::updateOrInsert(['user_id' => $id], ['avatar' => $path]);
    }

   	public function getPathAvatarUser() {  		
   		
   		$id = Auth::user()->id;
   		$path = $this->getPathFromModel($id);
		  

   		if (empty($path[0]->avatar)) {
   			$filePath = "storage/avatars/default/default.png";
   			return $filePath;
   		} else 
   			return $path[0]->avatar;

   	}
}
