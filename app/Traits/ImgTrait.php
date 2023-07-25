<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Departments;

trait ImgTrait

{   // save image 
    protected function saveImage($img,$folder){
    
        //save photo in folder
        $file_extension = $img->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $img->move($path,$file_name);
      
        return $file_name;
    
     }


     //orders search    
     protected function OrSearch($request){
        $output='';
        $img='';
        $change_user = '';
        $order_search = Orders::where('name', 'LIKE', '%'. $request->info. '%')
        ->get();

        if(auth()->user()->role==Role::ADMIN){

            /**   <img class="card-img-top" src="'.$product->path.'" alt="Card image cap"> */
                            foreach($order_search as $product) {
            
                               if(isset($product->user->name)){
                                $product->user->name;}
                                else{"users deleted";}
                               if(isset($product->view)){
                                $img=' <img src="'.url('image\view.png').'" alt="vieweer" style="width: 30px"> '.$product->view.'';
                               }else{$img=' <img src="'.url('image\nview.png').'" alt="vieweer" style="width: 30px"> ';}
            
                                $output .=
                                '<div class="OrderRow'.$product->id.'">
                                <a href="'.route('orders.show',$product->id).'" class="inside-page__btn inside-page__btn--beach">
                                '.$product->id.'-'.$product->name.'
                                
                                '.$change_user.'
                                <br>
                                '.$product->description.'
                                <br>
                                '.$product->price.'
                                <br>
                                '.$product->path.'" 
                                </a>
                                <div>
                                <br>
                               '.$img.'
                                </div>
                                <button order_id='.$product->id.' class="delete_btn btn btn-danger"  style="margin-left: 150px;margin-top: -50px">DELETE</button>  
                                <br><br>
                                 </div>
                                ';
                 
                            }
            
                            return $output;
                        }
                        
    /* ordersite search  */
    if(auth()->user()->role==Role::CUSTOMER){

        /**<img class="card-img-top" src="'.$product->path.'" alt="Card image cap"> */
        foreach($order_search as $product) {
            
            if(isset($product->user->name)){
             $product->user->name;}
             else{"users deleted";}
            if(isset($product->view)){
             $img=' <img src="'.url('image\view.png').'" alt="vieweer" style="width: 30px"> '.$product->view.'';
            }else{$img=' <img src="'.url('image\nview.png').'" alt="vieweer" style="width: 30px"> ';}

             $output .=
             '<div class="OrderRow'.$product->id.'">
             <a href="'.route('ordersite.show',$product->id).'" class="inside-page__btn inside-page__btn--beach">
             '.$product->id.'-'.$product->name.'
             
             '.$change_user.'
             <br>
             '.$product->description.'
             <br>
             '.$product->price.'
             <br>
             '.$product->path.'" 
             </a>
             <div>
             <br>
            '.$img.'

             ';

         }

         return $output;        
    }

    }


   // search users get response
   protected function UserSearch($request){


        $output='';
        
        $user_search = User::where('name', 'LIKE', '%'. $request->info. '%')->where('name','!=','Admin')
        ->orwhere('email', 'LIKE', '%'. $request->info. '%')->where('name','!=','Admin')
        ->orwhere('phone', 'LIKE', '%'. $request->info. '%')->where('name','!=','Admin')
        ->get();
 
        foreach ($user_search as $product) {
                 
            if($product->role == Role::CUSTOMER) 
            $gender = '<span class="spans">  
            Customer </span>';
            else
            $gender = '<span class="spans">  
            Admin </span>';

            $output .=
            '<div class="UserRow'.$product->id.'">
            <a href="'.route('users.show',$product->id).'" class="inside-page__btn inside-page__btn--beach">
            '.$product->id.'-'.$product->name.'
            <br>
            '.$gender.'
            
            '.$product->profile_photo.'
            
            </a>
           
            <br><br><br>
            <div style="margin-top: -30px">
           <a href="'.route('users.edit', $product->id).'" class="btn btn-info"
            
           style="margin-left: 800px;margin-top: -25px;"> EDIT </a>
            </a>
    
            <button user_id='.$product->id.' class="delete_btn btn btn-danger" style="margin-left: 900px;margin-top: -65px;">DELETE</button>
       
            </div>
            </div>
       
        ';
            
    
       
 
        }
        return $output;           

   }
   
   

   // search department get response
   protected function DepSearch($request){
    $output = '';
    $dep_search = Departments::where('name', 'LIKE', '%'. $request->info. '%')
        ->orwhere('code', 'LIKE', '%'. $request->info. '%')
        ->get();
      
        foreach ($dep_search as $product) {
             $output.='
             <div class="DepartmentRow'.$product->id.'">
             <a href="'.route('departments.show',$product->id).'" class="inside-page__btn inside-page__btn--beach">
             '.$product->id.'-'.$product->name.'-'.$product->code.'
             <br>
             '.$product->img.'
             </a>
             <br><br>
             <div style="margin-top: -30px">
             <a href="'.route('departments.edit', $product->id).'" class="btn btn-info"
             style="margin-left: 800px;margin-top: -20px;"> EDIT </a>
             <button department_id='.$product->id.' class="delete_btn btn btn-danger" style="margin-left: 900px;margin-top: -65px;">DELETE</button>
             </div>
             </div>
             ';
        
        }
   
   return $output;
   }

}

