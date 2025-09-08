<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;

class ScheduleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Chat::class);
        
        return Inertia::render('Schedule');
    }
}
