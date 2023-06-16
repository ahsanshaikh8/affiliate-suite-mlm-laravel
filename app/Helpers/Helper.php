<?php
namespace App\Helpers;

use App\Models\ProductCategory;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function getCategoryNameById($cat_id)
    {
        if($cat_id != null || $cat_id != ''){
            $p_cat = ProductCategory::find($cat_id);
            return $p_cat->name;
        }else{
            return null;
        }
    }
    public static function getUserNameById($id)
    {
        if($id != null || $id != ''){
            $user = User::find($id);
            return $user->name;
        }else{
            return null;
        }
    }
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function getUserIdByReferralCode($referral_code){
        if($referral_code != null || $referral_code != ''){    
            $user = DB::table('users')->where('referral_code',$referral_code)->first();

            if (is_object($user)) {
                return $user->id;
            } else {
                return 1;
            }
           
        }else{
            return 1;
        }
    }
    public static function getReferralCodeById($referral_by){
        // dd($referral_by);
        if($referral_by != null && $referral_by != ''){
            $user = User::find($referral_by);
            return $user->referral_code;
        }else{
            return 1;
        }
    }
}