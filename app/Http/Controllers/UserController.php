<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUsers()
    {
       $users = DB::table('users')->get();
        //return $users;//

        //if you show a particular column //
        /* foreach($users as $student){
               echo $student->email . "<br>";
             $users = DB::table('users')->where('id',2)->get();  
         }*/

       return view('allusers',['data' => $users]);
        
       

    }
    public function singleUser(string $id){
        $user = DB::table('users')->where('id',$id)->get();
        return view('user', ['data'  => $user]);
    }
    
   
    
}
