<?php
namespace App\Traits;

trait CountTrait

{  
    // count of Orders for users
    protected function countorders($element){
       $count =0;
      foreach ($element as $element) {
        
        $count++;
      }
      return $count;

    }

    // count of Favouritess for users
    protected function countfavourite($element){
        $count =0;
       foreach ($element as $element) {
         
        $count++;
       }
       return $count;
 
     }

}