<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Currency;
use App\Models\User;

class RedirectController extends Controller
{
    public function captureRedirect(Request $request, $urlId, $status) {
        dd($request, $urlId, $status);
        
        switch($status) {
            case "complete": break;
            case "disqualify": break;
            case "quota-full": break;
            case "quality-term": break;
            default: break;
        }
    }

    public function redirectSurvey(Request $request) {

    }
}
