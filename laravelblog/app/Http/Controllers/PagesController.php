<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
    	$title = "/index - laravelBlog";
    	return( view('pages.index', compact('title')));
    }
    public function about() {
    	$title = "/about - laravelBlog";
    	return(view('pages.about')->with('title', $title));
    }
    public function services() {
    	$data = array(
    		'title' => "/services - laravelBlog",
    		'services' => ["Web Design", "Programming", "SEO", "Laravel"]
    	);
    	return(view('pages.services')->with($data));
    }
}
