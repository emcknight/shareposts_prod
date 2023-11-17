<?php
    class Users extends Controller {
        private $userModel;
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize Post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'pass' => trim($_POST['pass']),
                    'confirm_pass' => trim($_POST['confirm_pass']),
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'confirm_pass_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }
                else{
                    // Check email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Please enter name';
                }

                // Validate Password
                if(empty($data['pass'])){
                    $data['pass_err'] = 'Please enter password';
                } else if(strlen($data['pass']) < 6){
                    $data['pass_err'] = 'Password must be at least 7 characters.';
                }

                // Validate Confirm Password
                if(empty($data['confirm_pass'])){
                    $data['confirm_pass_err'] = 'Please confirm password';
                } else if($data['pass'] != $data['confirm_pass']){
                    $data['confirm_pass_err'] = 'Passwords do not match';
                }

                // Make sure errors are empty
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['pass_err']) && empty($data['confirm_pass_err'])){
                    // Validated
                    
                    // Hash Password
                    $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data)){
                        flash('register_success', 'You are now registered and can login');
                        redirect('users/login');
                    }
                    else{
                        die('Something went wrong');
                    }

                } else {
                    // Load view with errors
                    $this->view('users/register', $data);
                }
            }
            else {
                // Load Form
                $data = [
                    'name' => '',
                    'email' => '',
                    'pass' => '',
                    'confirm_pass' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'confirm_pass_err' => ''
                ];

                // Load view
                $this->view('users/register', $data);
            }
        }

        public function login(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize Post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'pass' => trim($_POST['pass']),
                    'email_err' => '',
                    'pass_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                } 

                // Validate Password
                if(empty($data['pass'])){
                    $data['pass_err'] = 'Please enter password';
                } 

                // Check for User/Email
                if($this->userModel->findUserByEmail($data['email'])){
                    // User Found
                }
                else{
                    $data['email_err'] = 'No user found';
                }

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['pass_err'])){
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['pass']);
                    
                    if($loggedInUser){
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    }
                    else{
                        $data['pass_err'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('users/login', $data);
                }
            }
            else {
                // Load Form
                $data = [
                    'email' => '',
                    'pass' => '',
                    'confirm_pass' => '',
                    'email_err' => '',
                    'pass_err' => ''
                ];

                // Load view
                $this->view('users/login', $data);
            }
        }

        public function changePassword(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize Post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Init data
                $data = [
                    'curr_pass' => trim($_POST['curr_pass']),
                    'new_pass' => trim($_POST['new_pass']),
                    'confirm_new_pass' => trim($_POST['confirm_new_pass']),
                    'curr_pass_err' => '',
                    'new_pass_err' => '',
                    'confirm_new_pass_err' => ''
                ];

                // Validate Current Password
                if(empty($data['curr_pass'])){
                    $data['curr_pass_err'] = 'Please enter your current password';
                }
                else if(!$this->userModel->checkPassword($_SESSION['user_id'], $data['curr_pass'])){
                    $data['curr_pass_err'] = 'Incorrect current password. Please input your current password.';
                }

                // Validate New Password
                if(empty($data['new_pass'])){
                    $data['new_pass_err'] = 'Please enter a new password';
                } else if(strlen($data['new_pass']) < 6){
                    $data['new_pass_err'] = 'Password must be at least 7 characters.';
                }

                // Validate Confirm new Password
                if(empty($data['confirm_new_pass'])){
                    $data['confirm_new_pass_err'] = 'Please confirm your new password.';
                }
                else if($data['new_pass'] != $data['confirm_new_pass']){
                    $data['confirm_new_pass_err'] = 'Passwords do not match';
                }

                // Make sure errors are empty
                if(empty($data['curr_pass_err']) && empty($data['new_pass_err']) && empty($data['confirm_new_pass_err'])){
                    // Validated
                    
                    // Hash Password
                    $data['new_pass'] = password_hash($data['new_pass'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->changePassword($_SESSION['user_id'], $data['new_pass'])){
                        flash('password_change_success', 'Password Successfully Changed!');
                        redirect('posts');
                    }
                    else{
                        die('Something went wrong');
                    }

                } else {
                    // Load view with errors
                    $this->view('users/changePassword', $data);
                }
            }
            else {
                // Load Form
                $data = [
                    'curr_pass' => '',
                    'new_pass' => '',
                    'confirm_new_pass' => '',
                    'curr_pass_err' => '',
                    'new_pass_err' => '',
                    'confirm_new_pass_err' => ''
                ];

                // Load view
                $this->view('users/changePassword', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }
    }
?>