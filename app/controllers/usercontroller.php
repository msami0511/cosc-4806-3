<?php
require_once '../app/Models/User.php';

class UserController extends Controller {

    public function showSignup() {
        $this->view('signup');
    }

    public function create() {
        $username = strtolower(trim($_POST['username'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($password !== $confirmPassword) {
            $this->view('signup', ['error' => 'Passwords do not match']);
            return;
        }

        $userModel = new User();

        if ($userModel->findByUsername($username)) {
            $this->view('signup', ['error' => 'Username already exists']);
            return;
        }

        $userModel->create($username, $password);
        header('Location: /login');
        exit();
    }
}
