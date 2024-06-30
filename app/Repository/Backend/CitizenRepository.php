<?php

namespace App\Repository\Backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitizenRepository
{
    public function getCitizenCount($adminId, $adminUserType)
    {
        $totalCitizen = '';
        if($adminUserType == 2){
            // Get total citizen count who are registered as citizen with
            $totalCitizen = DB::table('citizens AS t1')
                    ->where('t1.user_type', 3)
                    ->where('t1.user_id', $adminId)
                    ->whereNUll('t1.deleted_at')
                    ->count();
            return $totalCitizen;
        } else {
            // Get total citizen count who are registered as citizen with
            $totalCitizen = DB::table('citizens AS t1')
                    ->where('t1.user_type', 3)
                    ->whereNUll('t1.deleted_at')
                    ->count();
            return $totalCitizen;
        }

    }

}
