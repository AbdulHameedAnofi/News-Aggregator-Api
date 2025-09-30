<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPreferenceRequest;
use App\Models\Preference;

class UserController extends Controller
{
    public function setUserPreference(UserPreferenceRequest $request)
    {
        $session_id = $request->session()->getId();

        $preference = Preference::updateOrCreate(
            ['session_id' => $session_id],
            [
                'sources' => $request->sources,
                'categories' => $request->categories,
                'authors' => $request->authors,
            ]
        );

        return $this->success('User preference added', $preference);
    }
}
