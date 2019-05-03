<?php
  class Users extends Controller{
    public function __construct()
    {
      $this->userModel = $this->model('User');
    }

    public function register()
    {
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'name'          => trim($_POST['name']),
          'password'      => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'email'         => trim($_POST['email']),
          'name_err'      => '',
          'email_err'     => '',
          'password_err'  => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter your email';
        } else {
          // Check for already existing email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter your name';
        }
        
        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter a password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password has to be at least 6 characters long';
        }

        // Validate Name
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm your name';
        } elseif($data['password'] != $data['confirm_password']){
          $data['confirm_password_err'] = 'Passwords do not match';
        }

        // Make sure errors are empty
        if( empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['password_confirm_err']) ){
          // Validated 
          
          // Hash password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register user
          if($this->userModel->register($data)){
            // Success
            flash('register_success', 'You are registered and can now log in');
            redirect('users/login');
          } else {
            // Error
            exit('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }


      } else {
        // Init data
        $data = [
          'name'          => '',
          'password'      => '',
          'confirm_password' => '',
          'email'         => '',
          'name_err'      => '',
          'email_err'     => '',
          'password_err'  => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login()
    {
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'password'      => trim($_POST['password']),
          'email'         => trim($_POST['email']),
          'email_err'     => '',
          'password_err'  => '',
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter your email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter a password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User Found
        } else {
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if( empty($data['email_err']) && empty($data['password_err']) ){
          // Validated 
          
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Username or password is incorrect';
            // Load view with login error
            $this->view('users/login', $data);
          }

        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data = [
          'password'      => '',
          'email'         => '',
          'email_err'     => '',
          'password_err'  => '',
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    // Called upon a successful login to set session variables
    // which signalize that a user is logged in
    public function createUserSession($user)
    {
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('posts');
    }

    public function logout() 
    {
      flash('logout_success', 'Logged out successfully');

      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
  
      redirect('users/login');
    }

    

  }