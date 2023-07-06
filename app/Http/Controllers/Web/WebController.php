<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Course;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AbstractBaseController;

class WebController extends AbstractBaseController
{
    public function home()
    {
        // return $this->buildView('home');
        return view('home', [ "content" => "home" ] );
    }
    public function about()
    {
        // return $this->buildView('about');
        $courses = Course::orderBy('id')->get();
        return view('about', [ "content" => "about" ] );
    }
    public function contact()
    {
        // return $this->buildView('contact');
        $courses = Course::orderBy('id')->get();
        return view('contact', [ "content" => "contact" ] );
    }

}
