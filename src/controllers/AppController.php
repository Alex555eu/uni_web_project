<?php

class AppController {

    private $request;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet() : bool {
        return $this->request === 'GET';
    }

    protected function isPost() : bool {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {

        $validate = new SecurityController();
        $validate->validate_user_token();

        $repo = new UserRepository();
        $user = $repo->getUserByToken($_COOKIE['user_token']);
        $user_data = null;
        if ($user) {
            $user_data = $user->toArray();
        }

        $templatePath = "public/views/".$template.'.php';
        $output = 'file not found';

        if(file_exists($templatePath)){
            extract($variables);
            if (!is_null($user_data)) {
                extract($user_data);
            }
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}