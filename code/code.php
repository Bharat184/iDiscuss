<?php
    header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
    $conn=mysqli_connect("localhost","root","","test");
    //Utilty Functions
    function window_reload()
    {
        echo "<script>window.location.reload();</script>";
    }
    //Ssanitise String
    function sanitise_string($str)
    {
        $str=htmlspecialchars($str,ENT_QUOTES);
        $str=addslashes($str);
        $str=trim($str);
        $str=preg_replace('/\s+/', ' ', $str);
        return $str;
    }
    //Alert display Message.
    function alert($txt)
    {
        echo "<script>alert('{$txt}')</script>";
    }
    //User signup
    function user_signup($name,$pass,$email)
    {
        global $conn;
        $email=sanitise_string($email);
        $name=sanitise_string($name);
        $pass=sanitise_string($pass);
        $sql="select * from users where user_email='{$email}'";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)<1)
        {
            $pass=password_hash($pass,PASSWORD_DEFAULT);
            $sql="insert into users(user_name,user_email,password) values('{$name}','{$email}','{$pass}')";       
            $query=mysqli_query($conn,$sql);
            if($query)
            {
                alert("User Added ");
                $_SESSION["email"]=$email;
                $_SESSION["password"]=$pass;
                echo "<script>window.location.href='./index.php';</script>";
            }
            else
            {
                alert("Error Occured");
            }
        }
        else
        {
            $_SESSION["message"]="Username Already Exists";
            $_SESSION["message_type"]="warning";
        }
        unset($_POST);  
        echo "<script>window.location.reload();</script>";       
    }
    //function validate session data
    function session_check($email,$password,$onlyid=false)
    {
        global $conn;
        $sql="select * from users where user_email='{$email}' && password='{$password}'";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)==1)
        {
            $row=mysqli_fetch_assoc($query);
            if($onlyid)
            {
                return $row["user_id"];
            }
            return ["id"=>$row["user_id"],"name"=>$row["user_name"]];
        }
        return false;
    }
    //verify a user.
    function user_verify($email,$pass)
    {
        global $conn;
        $email=sanitise_string($email);
        $pass=sanitise_string($pass);
        $sql="select * from users where user_email='{$email}'";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0)
        {
            $row=mysqli_fetch_assoc($query);
            $pw_hash=$row['password'];
            if(password_verify($pass,$pw_hash))
            {
                $_SESSION["email"]=$email;
                $_SESSION["password"]=$pw_hash;
                echo "<script>window.location.href='./index.php';</script>";
            }
            else
            {
                $_SESSION["message"]="Incorrect Password!";
                $_SESSION["message_type"]="danger";
            }
        }
        else
        {
            $_SESSION["message"]="Invalid credentials!";
            $_SESSION["message_type"]="danger";
        }
        unset($_POST);  
        echo "<script>window.location.reload();</script>";
    }
    //post a thread
    function create_post($title,$desc,$cat_id)
    {
        global $conn;
        $user_id=session_check($_SESSION["email"],$_SESSION["password"],true);
        $title=sanitise_string($title);
        $desc=sanitise_string($desc);
        $sql="INSERT INTO `posts`(`post_title`, `post_description`, `user_id`, `post_category_id`) VALUES ('{$title}','$desc',$user_id,'{$cat_id}')";
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $_SESSION["message"]="Question Posted!";
            $_SESSION["message_type"]="success";
        }
        else
        {
            alert("Error Occured!");
        }
        unset($_POST); 
        echo "<script>window.location.reload()</script>";
    }
    //get a post with it's id
    function get_thread($id)
    {
        global $conn;
        $sql="select * from posts where post_id='{$id}'";
        $query=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($query);
        if(!empty($row))
        {
            return $row;
        }
        return [];
    }
    //get all posts according to a category..
    function get_threads($id)
    {
        global $conn;
        $sql="select * from posts where post_category_id='{$id}'";
        $query=mysqli_query($conn,$sql);
        $str='';
        if(mysqli_num_rows($query)>0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $category_id=$row["post_category_id"];
                $category_name=strval(get_category_name_from_id($category_id));
                $arr=["id"=>$row["post_id"],"title"=>$row["post_title"],"desc"=>$row["post_description"],"cat_name"=>$category_name];
                $json=json_encode($arr);
                $json=base64_encode($json);
                if($row["user_id"]==session_check($_SESSION["email"],$_SESSION["password"],true))
                {
                    $links='<a href="./comment.php?id='.base64_encode($row["post_id"]).'&name='.base64_encode($category_name).'"><img class="mx-1" src="./images/comment.png" style="height:20px;"></a>
                    <img class="mx-1" src="./images/edit.png" style="height:20px;" data-json='.$json.' onclick="handlepostedit(this)">
                    <img class="mx-1" src="./images/delete.png" style="height:20px;" data-json='.$json.' onclick="handlepostdelete(this)">';
                }
                else
                {
                    $links='<a href="./comment.php?id='.base64_encode($row["post_id"]).'&name='.base64_encode($category_name).'"><img class="mx-1" src="./images/comment.png" style="height:20px;"></a>';
                }
                $str.=' <div class="card-body">
                <p class="text-primary pdetails" style="font-size:14px; text-align:right;">Posted By: '.get_username_from_userid($row["user_id"]).'</p><h5 class="card-title">'.$row["post_title"].'</h5>
                <p class="card-text">'.$row["post_description"].'</p>
                <div class="d-flex flex-row justify-content-between">
                <div>'.$links.'</div>
                <div class="pdetails" style="font-size:14px;">
                    <p class="mb-0 text-danger">Created At: '.explode(" ",$row["created_at"])[0].'</p>
                    <p class="mb-0 text-danger">Last updated: '.explode(" ",$row["updated_at"])[0].'</p>
                </div>
                
                </div>
              </div><hr>';
            }
        }
        return $str;
    }
    //update post details
    function update_post($id,$title,$description)
    {
        global $conn;
        $title=sanitise_string($title);
        $description=sanitise_string($description);
        
        $sql="update posts set post_title='{$title}',post_description='{$description}',updated_at=current_timestamp() where post_id={$id}";
        // echo $sql;
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $_SESSION["message"]="Updated Successfully.";
            $_SESSION["message_type"]="success";
        }
        unset($_POST);
        echo "<script>window.location.reload()</script>";
    }
    //delete post
    function delete_post($id)
    {
        global $conn;
        $sql1="delete from comments where comment_post='{$id}'";
        $query=mysqli_query($conn,$sql1);
        $sql="delete from posts where post_id='{$id}'";
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $_SESSION["message"]="Deleted Successfully!";
            $_SESSION["message_type"]="success";
        }
        unset($_GET);
    }
    //get comments of a post
    function get_comments($id)
    {
        global $conn;
        $category_name=get_category_name_from_post($id);
        $sql="select * from comments where comment_post='{$id}'";
        $query=mysqli_query($conn,$sql);
        $str="";
        while($row=mysqli_fetch_assoc($query))
        {
            if($row["comment_by"]==session_check($_SESSION["email"],$_SESSION["password"],true))
            {
                $links='<a href="./comment.php?name='.base64_encode($category_name).'&id='.base64_encode($id).'&c_id='.base64_encode($row["comment_id"]).'&del=true"><img src="./images/delete.png" style="height:20px;"></a>';
            }
            else
            {
                $links="";
            }
            $str.='<div class="card my-2">
            <div class="card-body">
            <div class="card-text">
            <p class="text-primary pdetails" style="font-size:14px; text-align:right;">Posted By: '.get_username_from_userid($row["comment_by"]).'</p>
            <h6 class="w-75">'.$row["comment_text"].'</h6>
            <div class="pdetails" style="font-size:14px;"><p class="text-danger">Posted At: '.explode(" ",$row["created_at"])[0].'</p></div>
            </div>'.$links.'</div>
            </div>';
        }
        return $str;
    }
    //add a comment
    function add_comment($post_id,$comment)
    {
        global $conn;
        $added_by=session_check($_SESSION["email"],$_SESSION["password"],true);
        $comment=sanitise_string($comment);
        $sql="insert into comments(comment_text,comment_by,comment_post) values('{$comment}','{$added_by}','{$post_id}')";
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $_SESSION["message"]="Comment has been added!";
            $_SESSION["message_type"]="success";
        }
        echo "<script>window.location.reload()</script>";
    }
    //delete a comment
    function delete_comment($id)
    {
        global $conn;
        $sql="delete from comments where comment_id='{$id}'";
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $_SESSION["message"]="Deleted Successfully!";
            $_SESSION["message_type"]="success";
        }
    }
    //get category name from post_id
    function get_category_name_from_post($id)
    {
        global $conn;
        $sql="select post_category_id from posts where post_id='{$id}'";
        $query=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($query);
        $cat_id=$row["post_category_id"];
        return get_category_name_from_id($cat_id);
    }
    //get category name from id
    function get_category_name_from_id($id)
    {
        global $conn;
        $sql="select category_name from categories where category_id='{$id}'";
        $query=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($query);
        return $row["category_name"];
    }
    //get username from id
    function get_username_from_userid($id)
    {
        global $conn;
        $sql="select user_name from users where user_id={$id}";
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            return mysqli_fetch_assoc($query)["user_name"];
        }
        return "";
    }
?>