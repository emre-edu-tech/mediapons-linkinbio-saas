<?php

namespace App\Core;

class Controller {
    /**
     * Render a view from resources/ folder
     * $view can be 'public/home/index' or 'auth/login'
     */
    protected function view($view, $data = [])
    {
        $viewPath = __DIR__ . '/../../resources/' . str_replace(['.', '/'], '/', $view) . '.php';
        if(!file_exists($viewPath)) {
            http_response_code(500);
            echo "View: {$view} not found at {$viewPath}";
            return;
        }

        // Make data available to the view safely
        extract($data, EXTR_SKIP);
        require $viewPath;
    }
}