<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserSuggestionsController extends Controller
{
    public function index()
    {
        return view('user-dashboard.suggestions.index');
    }
}
