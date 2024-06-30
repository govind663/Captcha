<?php

namespace App\Repository\Backend;

use Illuminate\Support\Facades\DB;

class AdminRepository
{
    public function getAdminCount()
    {
        $totalAdmin = DB::table('users AS t1')
                        ->where('t1.user_type', 2)
                        ->whereNUll('t1.deleted_at')
                        ->count();

        return $totalAdmin;
    }

}
