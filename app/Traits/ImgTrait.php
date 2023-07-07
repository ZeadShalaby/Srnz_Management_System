<?php

namespace App\Traits;

trait ImgTrait

{
    protected function saveImage($img,$folder){
    
        //save photo in folder
        $file_extension = $img->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $img->move($path,$file_name);
      
        return $file_name;
    
     }

}

