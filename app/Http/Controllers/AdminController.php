<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function homeAdmin($id){

                return view('admin.HomeAdmin')->with('id',$id);

    }

   public function infosAdmin($id){

                $admin=User::find($id);
                return view('admin.infoAdmin')
                    ->with('id',$id)
                    ->with('admin',$admin);

   }

   public function UpdateInfoAdmin(request $request,$id){
    $admin=User::find($id);
     $admin->email=$request->email;
       $password = Hash::make($request->password);
       $admin->password=$password;
     $admin->address=$request->address;
     $admin->phone=$request->phone;
     $admin->save();
     return redirect()->route('homeAdmin',["id"=>$id]);
   }

   ////////////////////////////////////////////////////////////////////////////////////////
   public function findallUsers($id){
    $buyerUser=User::query();
    $buyerUser->where('is_seller',0)->where('is_admin',0);
    $buyerUser=$buyerUser->get();
    $sellerUser=User::query();
    $sellerUser->where('is_seller',1)->where('is_admin',0);
    $sellerUser=$sellerUser->get();
    return view('admin.allusersAdmin')->with('id',$id)->with('sellers',$sellerUser)->with('buyers',$buyerUser);
   }

   public function updateUser($id,$idUser){
            $user=User::find($idUser);
            return view('admin.updateUser')->with('id',$id)->with('dataUser', $user);
   }

   public function saveUpdateUser(request $request,$id,$idUser){
    $user=User::find($idUser);
    $user->username=$request->username;
     $user->email=$request->email;
     $password = Hash::make($request->password);
     $user->password=$password;
     $user->address=$request->address;
     $user->phone=$request->phone;
     $user->save();
    return redirect()->route('allUsers',["id"=>$id]);
   }


   public function deleteUser($id,$idUser){
                $user=User::find($idUser);
                $user->delete();
                return redirect()->back();
   }



}
