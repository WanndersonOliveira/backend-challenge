<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminDAO
{
    //use HasFactory;

    public function auth($email,$senha){
    	$admin = Admin::where('email','=',$email)->get();


    	if(sizeof($admin) != 0){
    		if(Hash::check($senha,$admin[0]->password)){
    			return 0;
    		} else {
    			return 1;
    		}
    	}

    	return -1;
    }
}
