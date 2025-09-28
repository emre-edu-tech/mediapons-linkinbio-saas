<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $this->view('public/home/index', [
            'title' => 'Welcome to Link-in-Bio SaaS'
        ]);
    }

    public function about() {
        $this->view('public/home/about', [
            'title' => 'About us'
        ]);
    }
}