<?php
    session_start();
    require './code/code.php';
    require './middleware/logincheck.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b6b1bda44f.js" crossorigin="anonymous"></script>
    <style>
        @media screen and (max-width:580px)
        {
            .pdetails{
                font-size:10px !important;
            }
        }
    </style>
    <script>
        if(window.history.replaceState)
        {
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
</head>

<body style="background:#9f8b8b;">
    <nav class="navbar navbar-expand-lg bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="./">iDiscuss</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./categories.php?name=javascript">Javascript</a></li>
                            <li><a class="dropdown-item" href="./categories.php?name=python">Python</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./categories.php?name=java">Java</a></li>
                            <li><a class="dropdown-item" href="./categories.php?name=php">PHP</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="./contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./about.php">About Us</a>
                    </li>
                </ul>
                <div class="mx-3">
                    
                  <?php
                    if(isset($_SESSION["email"]) && isset($_SESSION["password"]))
                    {
                        $name=get_username_from_userid(session_check($_SESSION["email"],$_SESSION["password"],true));
                        echo '<div class="d-flex flex-row"><div class="text-white mx-2"><p class="my-0 small">Welcome</p><p class="my-0 small">'.$name.'</p></div><form action='.$_SERVER["PHP_SELF"].' method="POST"><button type="submit" name="logout" class="btn btn-primary">Logout</button></form></div>';
                    }
                    else
                    {
                        echo '<a href="./login.php" class="btn btn-primary">Login</a>
                        <a href="./signup.php" class="btn btn-primary">Signup</a>';
                    }
                    if(isset($_POST["logout"]))
                    {
                        session_unset();
                        session_destroy();
                        header("Location: ./login.php");
                    }
                  ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container p-4" style="background:#afb17d; min-height:95vh">
        <?php if(isset($_SESSION["message"]) && isset($_SESSION["message_type"]))
            {
                echo '<div class="alert alert-'.$_SESSION["message_type"].'" role="alert">'.$_SESSION["message"].'</div>';
            }
            unset($_SESSION["message"]);
            unset($_SESSION["message_type"]);
        ?>



   