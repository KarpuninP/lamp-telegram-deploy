<?php

class Route {
    public function run() {
        $query = trim($_SERVER['REQUEST_URI'], '/');

        // Если URL пустой, грузим контроллер главной страницы
        if ($query == '') {
            require_once '../app/controllers/MainController.php';
            $controller = new MainController();
            $controller->index();
            exit;
        }

        // Если запрашивают что-то другое → 404
        require_once '../app/controllers/ErrorController.php';
        $controller = new ErrorController();
        $controller->notFound();
        exit;
    }
}
