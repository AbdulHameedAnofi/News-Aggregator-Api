<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPreferenceRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function setUserPreference(UserPreferenceRequest $request)
    {
        
        
        return $this->success('User preference added', $request->session());

    }
}
