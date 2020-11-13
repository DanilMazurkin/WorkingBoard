<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
use Storage;

class Ad extends Model
{
	  protected $fillable = [
        'name', 'text', 'image', 'user_id'
    ];    

    public $timestamps = false;

    public function createAd($header, $text, $path = "NULL") {
    	$id = Auth::user()->id;

      Ad::insert(['user_id' => $id, 'name' => $header, 'text' => $text, 'image' => $path]);	
    }


    public function createDirectoryForAd() 
    {
   		
   		$directory = $this->getFolderAd();

   		if(!Storage::disk('public')->has($directory)) { 
          Storage::disk('public')->makeDirectory($directory);
          return 0;
      } else 
          return 1;
      
   	}

   	public function getFolderAd() 
   	{
   	  $id = Auth::user()->id;
      $directory = 'ads/user'.$id.'/';   

      return $directory;
   	}

    public function getAdsUser($id) {
        $user = User::find($id);
        $ads = $user->ads;

        return $ads;        
    }


    public function user() {
      return $this->belongsTo(User::class);
    }
}


