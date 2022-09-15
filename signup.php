<?php
    include './includable/top.php';

        echo '<form method="post" action='.$_SERVER['PHP_SELF'].' id="userform">
        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name..." name="username" required>
      </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email..." name="email" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" autocomplete="on" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Password..." name="password">
        </div>
        <div class="mb-3">
        <label for="exampleInputPassword" class="form-label">Confirm Your Password</label>
        <input type="password" autocomplete="on" class="form-control" id="exampleInputPassword" placeholder="Confirm Your Password..." name="cpassword">
      </div>
        <button type="button" class="btn btn-primary" style="display:block; margin:0px auto;" name="createuser" id="createuser">Submit</button>
      </form>';

      if($_SERVER['REQUEST_METHOD']=='POST')
      {
         $name=$_POST['username'];
         $password=$_POST['password'];
         $email=$_POST['email'];
         user_signup($name,$password,$email);
      }

    include './includable/bottom.php';

    

?>