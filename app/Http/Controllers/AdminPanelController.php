<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use AdminSection;

class AdminPanelController extends Controller
{
    public function dashboard(){
        return AdminSection::view(view('pages.admin.dashboard'), 'Dashboard');
    }

    public function information(){
        return AdminSection::view(view('pages.admin.information'), 'Information');
    }

    public function profile(){
        return AdminSection::view(view('pages.admin.profile'), 'Profile');
    }

    public function exit(){
        return redirect()->route('home'); // why not ? :D
    }
}
