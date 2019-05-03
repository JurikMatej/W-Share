<?php 
  class Posts extends Controller {
    public function __construct()
    {
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
    }

    public function index()
    {
      $posts = $this->postModel->getPosts();

      $data = [
        'posts' => $posts
      ];

      $this->view('posts/index', $data);
    } 

    public function add()
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize Post
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate title
        if(empty($data['title'])){
          $data['title_err'] = "Please enter a title for your post";
        }
        // Validate body
        if(empty($data['body'])){
          $data['body_err'] = "Please give your post some content";
        }

        // Make sure there are no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Validated 
          if($this->postModel->addPost($data)){
            flash("post_message", "Post Added Successfully");
            redirect('posts');
          }
        } else {
          // Load views with errors
          $this->view('posts/add', $data);
        }


      } else {
        $data = [
          'title' => '',
          'body' => ''
        ];

        $this->view('posts/add', $data);
      }
    }

    public function edit($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize Post
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate title
        if(empty($data['title'])){
          $data['title_err'] = "Please enter a title for your post";
        }
        // Validate body
        if(empty($data['body'])){
          $data['body_err'] = "Please give your post some content";
        }

        // Make sure there are no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Validated 
          if($this->postModel->updatePost($data)){
            flash("post_message", "Post Updated Successfully");
            redirect('posts');
          }
        } else {
          // Load views with errors
          $this->view('posts/edit', $data);
        }


      } else {
        // Get existing post from model
        $post = $this->postModel->findPostById($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }

        $data = [
          'id' => $id,
          'title' => $post->title,
          'body' => $post->body
        ];

        $this->view('posts/edit', $data);
      }
    }

    public function delete($id)
    {
      

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing post from model
        $post = $this->postModel->findPostById($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }
        
        if($this->postModel->deletePost($id)){
          flash('post_message', 'Post Removed Successfully');
          redirect('posts');
        } else {
          exit('Something went wrong');
        }
      } else {
        redirect('posts');
      }
    }

    public function show($id)
    {
      $post = $this->postModel->findPostById($id);
      $user = $this->userModel->findUserById($post->user_id);

      $data = [
        'post' => $post,
        'user' => $user
      ];

      $this->view('posts/show', $data);
    } 
  }