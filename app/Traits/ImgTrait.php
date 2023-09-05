<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;
use App\Models\Orders;
use App\Models\Departments;
use App\Models\Interesteds;

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
        $interesteds = Interesteds::get();
        $ordersuser = Orders::where('user_id',auth()->user()->id)->get();

       
                                    
        if(auth()->user()->role==Role::ADMIN){

            /**   <img class="card-img-top" src="'.$product->path.'" alt="Card image cap"> */
                            foreach($order_search as $product) {
            
                               if(isset($product->user->name)){
                                $product->user->name;}
                                else{"users deleted";}
                               if(isset($product->view)){
                                $img=' <img src="'.url('image\all\view.png').'" alt="vieweer" style="width: 30px"> '.$product->view.'';
                               }else{$img=' <img src="'.url('image\all\nview.png').'" alt="vieweer" style="width: 30px"> ';}
                               $start=1;
                               $orderid=$product->id;
                                  while ($start<=5){
                                     if($orderid>5){ $orderid %=5 ; }                                  
                                     if($orderid<$start){
                                       $stars =' <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>';}
                                     else{
                                     $stars =' <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>';}
                                 $start++;}
                                $output .=
                                '<div class="OrderRow'.$product->id.'" >
                                <div class="container" >
                                <div class="box" >
                                <a href="'.route('ordersite.show',$product->id).'" class="inside-page__btn inside-page__btn--beach" >
                                <div class="icon-images" style="margin-top: -30px">

                                <div class="icons" >
                                    <img src="'.asset('image/all/'.$product->user->profile_photo).'" alt="users" />
                                                    
                                    <div  class="spann" style="color: aquamarine;margin-left:90px;" >'.$product->user->name.'</div>
                                </div>
                                </div>                           
                              
                                <br>
                   
                                <article class="card" style="text-decoration: none">
                                <img
                                class="card__background"
                                src="'.asset('image/orders/'.$product->path).'"
                                alt="'.$product->name.'"
                                width="1920"
                                height="2193"
                                />
                                <div class="card__content | flow">
                                <div class="card__content--container | flow">
                                    <h2 class="card__title">'.$product->name.'</h2>
                                    <p class="card__description">
                                        '.$product->description.'
                                    </p>
                                    <p>COST :'.$product->price.' <span style="color: rgb(59, 212, 105)">$</span></p>
                                    <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>
                                    <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>
                                    <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>
                                    <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>

                                     '.$stars.'
                                    
                                </div>
                                    
                                </div>
                            </article>
                   
                   </a>
                     
                               
                           <div class="under_imgs">
                           '.$img.'
                           
                           <div style="margin-top: -18px">
                           <button order_id='.$product->id.' id="delete" class="delete_btn"  style="margin-left: 150px;"><i class="fa fa-trash"></i></button>        
                               </div>
                           <br><br>
                           </div>
                           </div>
                   
                           </div>
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
                $img=' <img src="'.url('image\all\view.png').'" alt="vieweer" > '.$product->view.'';
               }else{$img=' <img src="'.url('image\all\nview.png').'" alt="vieweer" > ';}
              
               if(isset($sefav)){ }
               else{
               $favgold = '<div class="AddFav"><button  orders_id = '.$product->id.' name="favourite" class="AddFav btn btn-lg" ><i class="fa fa-heart" id ="fav'.$product->id.'" style="color: gold; width:50px;" ></i></button></div>'; 
               
               if(isset($interesteds)){
               foreach ($interesteds as $interested){
               if(($interested->user_id==auth()->user()->id)&($interested->order_id==$product->id)){
               $favgold = '<div id="favred">
               <button orders_id = '.$product->id.'  name="favourite" class="AddFav btn btn-lg" ><i class="fa fa-heart" style="color: red;width:50px;" ></i></button> 
               </div>';
               }
               }}
               $btnedit = '';
               $btndelete = '';
               if(isset($ordersuser)){
                foreach($ordersuser as $oruser){
                 if($oruser->id==$product->id){
                $btnedit =  '<div class="btnedits"><a href="'.route('ordersite.edit', $product->id).'"class="btn btn-info" style="margin-left: 200px;margin-top: -150px;"><i class="fa fa-edit"></i> </a></div';
                $btndelete = '<div class="btndeletes"><button order_id='.$product->id.' class="delete_btn btn btn-danger"  style="margin-top: -200px;margin-left: 400px;"><i class="fa fa-trash"></i></button>';
               }}}}
               $start=1;
               $orderid=$product->id;
                 while ($start<=5){
                     if($orderid>5){ $orderid %=5 ; }                                  
                     if($orderid<$start){
                       $stars =' <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>';}
                     else{
                     $stars =' <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>';}
                 $start++;}
                $output .=
                '<div class="OrderRow'.$product->id.'">
                <div class="container">
                <div class="box" >
                <a href="'.route('ordersite.show',$product->id).'" class="inside-page__btn inside-page__btn--beach" >
                <div class="icon-images" style="margin-top: -30px">

                <div class="icons" >
                    <img src="'.asset('image/all/'.$product->user->profile_photo).'" alt="users" />
                                    
                    <div  class="spann" style="color: aquamarine;margin-left:90px;" >'.$product->user->name.'</div>
                </div>
                </div>                           
              
                <br>
   
                <article class="card">
                <img
                class="card__background"
                <img src="'.asset('image/orders/'.$product->path).'" alt="'.$product->name.'"/>
               
                <div class="card__content | flow">
                <div class="card__content--container | flow">
                    <h2 class="card__title">'.$product->name.'</h2>
                    <p class="card__description">
                        '.$product->description.'
                    </p>
                    <p>COST :'.$product->price.' <span style="color: rgb(59, 212, 105)">$</span></p>
                    <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>
                    <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>
                    <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>
                    <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>

                     '.$stars.'
                </div>
                    
                </div>
            </article>


              
   
   </a>
     

   
            <div class="view_img">
            '.$img.'
            <div class="under_img" style="margin: top -50px;">
           <span style="margin: left 150px;"> '.$favgold.'</span>
            </div>
            '.$btnedit.'
            '.$btndelete.'
            </div>
            </div>
            </div>
            </div>
            </div>
   
   
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
            $gender ='Customer';
            else
            $gender = 'Admin';

            if ($product->role == Role::CUSTOMER )
            $imges = '<img src="'.asset('image/all/users.png').'" alt="Customer"
                style="margin-top: -70px;width: 120px">';
            else
            $imges = '<img src="'.asset('image/all/admin.png').'" alt="Customer"
                style="margin-top: -80px;width: 120px">';
           
           $output .=
           '<div class="UserRow'.$product->id.'">
            <div class="container">
            <div class="box">
            <div class="card">
            <div class="content">
            <div class="back">
            <div class="back-content">
            <div class="card_box">
              <span></span>
            </div>
            <svg stroke="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
            height="50px" width="50px" fill="#ffffff">

            <g stroke-width="0" id="SVGRepo_bgCarrier"></g>

            <g stroke-linejoin="round" stroke-linecap="round"
                id="SVGRepo_tracerCarrier"></g>


            <g id="SVGRepo_iconCarrier">
                '.$imges.'
            </g>

        </svg>
            <strong>'.$product->name.'</strong>
            </div>
            </div>
            <div class="front">  
            <div class="img">
              <div class="circle">
              </div>
              <div class="circle" id="right">
              </div>
              <div class="circle" id="bottom">
              </div>
            </div>
          
            <div class="front-content">
                <small class="badge"> 
                '.$gender.'
                </small>
                <small class="edit"> <a href="'.route('users.edit',$product->id).'"> <i class="fa fa-edit"></i> </a></small>
                <small class="delete"><button user_id='.$product->id.' class="delete_btn" id="delete_users"><i class="fa fa-trash"></i></button></small>
                <a href="'.route('users.show', $product->id).'">

                <div class="description">
                <div class="title">
                  <p class="title">
                <img class="user_profile" src="'.asset('image/all/'.$product->profile_photo).'" alt="User_photo"/>
                </p>
                <svg fill-rule="nonzero" height="15px" width="15px" viewBox="0,0,256,256" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g style="mix-blend-mode: normal" text-anchor="none" font-size="none" font-weight="none" font-family="none" stroke-dashoffset="0" stroke-dasharray="" stroke-miterlimit="10" stroke-linejoin="miter" stroke-linecap="butt" stroke-width="1" stroke="none" fill-rule="nonzero" fill="#20c997"><g transform="scale(8,8)"><path d="M25,27l-9,-6.75l-9,6.75v-23h18z"></path></g></g></svg>
              </div>

              <p class="card-footer">
                                    
              '.$product->name.'
                  <br>
                 '.$product->phone.'
                 </p>
                 </div>
               </a>
            </div>
        </div>
    </div>
</div>
<div>                   
</div>
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
            if(isset($product->img)){
                $dep_img = '<img src="'.asset('image/departments/'.$product->img).'" alt="departments">';
               }else{$dep_img=' <img src="'.url('image\all\course.svg').'" alt="departments" > ';}
              
        
            if($product->id % 2 == 0 ){
            $icon_dep = ' <img src="'.asset('image/all/dep.png').'" alt="departments">';}
                else{             
                $icon_dep = ' <img src="'.asset('image/all/logo.png').'" alt="departments">';}
        
             $output.='
             
             <div class="DepartmentRow'.$product->id.'">
             <div class="container">
             <div class="box">
             <div class="item">
             <div class="item__image">
             <div class="image-switch__outer">
             <div class="image-switch__inner">
             '.$dep_img.'
             </div>
             </div>
             </div>
             <div class="item__description">
             <div class="description-switch__outer">
             <div class="description-switch__inner">
              
             <button department_id='.$product->id.' class="delete_btn btn btn-danger" ><i class="fa fa-trash" id="delete"></i></button>
             <a href="'.route('departments.edit', $product->id).'" class="edit_btn -info"> <i class="fa fa-edit" id="edit"></i> </a>
             

                <p>'.$product->name.'</p>
               
               <a href="'.route('departments.show',$product->id).'" ><!--target="_blank"   open link in new page    -->  
                 <i class="fas fa-location-arrow" id="show"></i>
               <div class="item__action-arrow">
               </a>

                    </div>
                </div>
                </div>
            </div>

  
            <div class="flap level0">
                
    
            <div class="flap level1 flip-right">
                
              <div class="flap level2 flip-down">
                <div class="flap level3 flip-left"></div>
                <div class="flap level3 flip-right">
                  <div class="flap level4 flip-up">
                    <div class="flap level5 flip-right">
                      <div class="flap level6 flip-left">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flap level2 flip-up">
                <div class="flap level3 flip-left">
                  <div class="flap level4 flip-up"></div>
                  <div class="flap level5 flip-down">
                    <div class="flap level6 flip-left">
                      <div class="flap level7 flip-up">
                        <div class="flap level8 flip-left"></div>
                        <div class="flap level8 flip-right"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flap level1 flip-left">
              <div class="flap level2 flip-up">
                <div class="flap level3 flip-left">
                  <div class="flap level4 flip-down">
                    <div class="flap level5 flip-left">
                      <div class="flap level6 flip-right">
                        <div class="flap level7 flip-up">
                          <div class="flap level8--alt flip-right"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flap level2 flip-down">
                <div class="flap level3 flip-right">
                  <div class="flap level4 flip-down">
                    <div class="flap level5 flip-up"></div>
                  </div>
                  <div class="flap level5 flip-up">                                
                    <div class="flap level6 flip-right"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item__hover-icon">
            <div class="icon-switch__outer">
              <div class="icon-switch__inner">
               '.$icon_dep.'
              <div class="code">
              <span >'.$product->code.'</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
             
             ';
        
        }
   
   return $output;
   }


                  
                  
                  
               
                    
             
                   

}

