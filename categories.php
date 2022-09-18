<?php

    include './includable/top.php';
    

      $name="";

      if(isset($_GET["name"]))
      {
        $arr=["javascript","java","php","python"];
        if(in_array($_GET["name"],$arr))
        {
            $name=$_GET["name"];
        }
        else
        {
            $name="others";
        }
      }
      else
      {
        $name="others";
      }
      
      switch($name)
      {
        case "javascript": $id="1efw89dh93";
                           break;
        case "java": $id="89keng1348";
                           break;
        case "python": $id="18kf18943k";
                           break;
        case "php": $id="18pqz383k8";
                           break;
        default: $id="51u0in6hg1";
      }

      if(isset($_SESSION["email"])&&isset($_SESSION["password"]))
      {
        require './includable/add_modal.php';
        require './includable/edit_modal.php';
      }

      
      echo '<div class="container col-xxl-8 ">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="./images/image.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy" style="border-radius:10px">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3 text-black">'.ucfirst($name).' Forum.</h1>
          <hr>
          <p class="text-dark">No Spam / Advertising / Self-promote in the forums. ...</p>
          <p class="text-dark">Do not post copyright-infringing material. ...</p>
          <p class="text-dark">Do not post “offensive” posts, links or images. ...</p>
          <p class="text-dark">Do not cross post questions. ...</p>
          <p class="text-dark">Do not PM users asking for help. ...</p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">';
          if(isset($_SESSION["email"])&&isset($_SESSION["password"]))
          {
            echo '<button type="button" class="btn btn-secondary btn-lg px-4 me-md-2 text-black" id="postThreadBtn">Post a Doubt.</button>';
          }else{
            echo '<h2 class="text-primary">Login/signup to post.</h2>';
          }
          echo '</div>
        </div>
      </div>
    </div>';

    $str=get_threads($id);
    echo '<div class="card" style="background:#bdafcb;">
    <h5 class="card-header">'.ucfirst($name)." Questions".'</h5>
    ';
    if(!$str){
      echo '<div class="card-body"><h5 class="card-title">No Questions!</h5><h6 class="card-text">Be the first one to post.</h6></div>';
    } else{
     echo $str;
    }
    echo '</div>'; 

    if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST) && !isset($_POST['updatepost']))
    {
      create_post($_POST['title'],$_POST['description'],$_POST["category_id"]); 
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepost']))
    {
      $category=$_GET['name'];
      $post_id=base64_decode($_POST['post_id']);
      $title=$_POST['title'];
      $desc=$_POST['desc'];
      update_post($post_id,$title,$desc);
    }
    
    if(isset($_GET['del']))
    {
      $category=$_GET['name'];
      $id=base64_decode($_GET['del']);
      delete_post($id);
      echo "<script>window.location.href=window.location.origin+window.location.pathname+'?name={$category}'</script>";
    }
  
    include './includable/bottom.php';
?>