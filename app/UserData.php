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
        'name', 'surname', 'patronymic', 'avatar', 'user_id', 'settings_set'
    ];

    public $timestamps = false;


    public function clearImagesInUserFolder() 
    {
        
        $directory = $this->getFolderUser();        

        $files = Storage::disk('public')->allFiles($directory);
        Storage::disk('public')->delete($files);
    } 


   	public function createDirectoryForUser() 
    {
   		
   		$directory = $this->getFolderUser();

   		if(!Storage::disk('public')->has($directory)) 
      { 
          Storage::disk('public')->makeDirectory($directory);
          return 0;
      } else 
          return 1;
      
   	}

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function getFolderUser() 
    {
      

      $id = Auth::user()->id;
      $directory = 'storage/avatars/id'.$id.'/';   
      
      return $directory;
    }

    private function getPathFromModel($id_user) 
    {
    	$path = UserData::select('avatar')->where('user_id', $id_user)->first();
      return $path;
    }

    public function setPathForModel($path) 
    {
      $id = Auth::user()->id;
      
      $directory = $this->getFolderUser();
      $path = $directory.$path;
     
      UserData::updateOrInsert(['user_id' => $id], ['avatar' => $path]);
    }

    private function setDefaultPathForModel() 
    {
          
        $id = Auth::user()->id;

        $path = 'storage/avatars/default/default.png';
        UserData::updateOrInsert(['user_id' => $id], ['avatar' => $path]);

        return $path;
    }

   	public function getPathAvatarUser($id) 
    {  		
   		
   		$path = $this->getPathFromModel($id);
		  

   		if (empty($path->avatar)) 
      {
        $filePath = $this->setDefaultPathForModel();
   			return $filePath;
   		} else 
   			return $path->avatar;

   	}


    public function getFioUser($id) 
    {
        
        $fio = UserData::select('name', 'surname', 'patronymic')->where('user_id', $id)->first();
        
        if ($fio->name == "NULL" && $fio->surname == "NULL" && $fio->patronymic == "NULL")
            return 0;
        else 
            return ['name' => $fio->name, 'surname' => $fio->surname, "patronymic" => $fio->patronymic];
    }

    public function setFioUser($id, $name, $surname, $patronymic) 
    {
        UserData::updateOrInsert(['user_id' => $id], ['name' => $name, 'surname' => $surname, 
                                                      'patronymic' => $patronymic]);
    }
}
