<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService {
    /**
     * Save info when login
     */
    public function saveLoginInfo($input){
        return DB::table('oauth_access_tokens')
            ->where('id', $input['access_token_id'])
            ->update([
                'name' => Auth::user()->user->fullname,
                'username' => Auth::user()->username,
                'ip_address' => $input['ipAddress'],
                'browser_os_info' => $input['browserOs'],
            ]);;
    }

    /**
     * Save info when logout
     */
    public function saveLogoutInfo($input){
        return DB::table('oauth_access_tokens')
            ->where('id', $input['access_token_id'])
            ->update([
                'ip_address' => $input['ipAddress'],
                'browser_os_info' => $input['browserOs'],
                'logout_at' => \Carbon\Carbon::now(),
            ]);;
    }
}