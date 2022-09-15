<?php
    include './includable/top.php';
    $em="";
    $pw="";
    if(isset($_COOKIE["email"]))
    {
      $em=$_COOKIE["email"];
    }
    if(isset($_COOKIE["password"]))
    {
      $pw=$_COOKIE["password"];
    }
    if($_SERVER['REQUEST_METHOD']=='POST')
      {
        if(isset($_POST["remember"]))
        {
          setcookie("email", $_POST["email"], time() + (86400 * 30), "./login.php");
          setcookie("password", $_POST["password"], time() + (86400 * 30), "./login.php");

        }
        user_verify($_POST['email'],$_POST['password']);
      }
        echo '<form method="post" action='.$_SERVER['PHP_SELF'].'>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" autocomplete="on" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email..." name="email" value="'.$em.'">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Password..." name="password" value='.$pw.'>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" checked>
          <label class="form-check-label" for="exampleCheck1">Remeber me</label>
        </div>
        <button type="submit" class="btn btn-primary" style="display:block; margin:0px auto;" name="login" >Submit</button>
      </form>';
    include './includable/bottom.php';
    include './middleware/logincheck.php';
    ?>