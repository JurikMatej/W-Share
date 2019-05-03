<?php
  session_start();

  /** Flash message helper
   *  Flash into - flash($name, $message [, $class]);
   *  Flash out  - flash($name [, $class='']);
   */
  function flash($name = '', $message = '', $class = 'alert alert-success')
  {
    if(!empty($name)){
      // Does not exist in $_SESSION yet -> Flash into
      if(!empty($message) && empty($_SESSION[$name])){
        // if(!empty($_SESSION[$name])){
        //   unset($_SESSION[$name]);
        // }
        // if(!empty($_SESSION[$name.'_class'])){
        //   unset($_SESSION[$name.'_class']);
        // }
        $_SESSION[$name] = $message;
        $_SESSION[$name.'_class'] = $class;

      // Does exist in $_SESSION -> Flash out and unset
      } elseif(empty($message) && !empty($_SESSION[$name])){
        $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
        echo "<div class='$class' id='msg-flash'>$_SESSION[$name]</div>";

        // Unset the $_SESSION values
        unset($_SESSION[$name]);
        unset($_SESSION[$name.'_class']);
      }
    }
  }

  function isLoggedIn()
    {
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }