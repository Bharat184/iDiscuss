<?php
    include './includable/top.php';
    $post_id=base64_decode($_GET["id"]);
    $category_name=base64_decode($_GET["name"]);
    $post=get_thread($post_id);
    $comment=get_comments($post_id);
  echo '<div class="container col-xxl-8 ">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="./images/image.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy" style="border-radius:10px">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold lh-1 mb-3 text-black">'.ucfirst($category_name).' Forum.</h1>
      <hr>
        <h4 class="dark-text text-dark w-75">'.$post["post_title"].'</h4>
        <h6 class="dark-text">'.$post["post_description"].'</h6>
        <hr>
        <p class="dark-text">Created At: '.$post["created_at"].'</p>
        <p class="dark-text">Last Updated: '.$post["updated_at"].'</p>';
        if(isset($_SESSION["email"])&&isset($_SESSION["password"]))
        {
          echo '<form method="post" action="./comment.php?id='.$_GET["id"].'&name='.$_GET["name"].'">
          <div class="mb-3">
            <input type="text" class="form-control" id="comment" aria-describedby="emailHelp" placeholder="Write Your Comments..." name="comment">
          </div>
          <button type="submit" class="btn btn-secondary" name="postcomment">Post a Comment</button>
          <a href="./categories.php?name='.$category_name.'" class="btn btn-primary">Go back.</a>
          </form>';
        }
        else
        {
          echo '<h2 class="text-primary">Login/signup to post.</h2>';
        }
        echo '</div> </div></div><hr>';
echo "<h2>Comments</h2>";
if(!$comment)
{
  echo '<div class="card px-5 py-4"><h5 class="card-title">No Comments!</h5><h6 class="card-text">Be the first one to comment.</h6></div>';
}
else
{
  echo $comment;
}

if(isset($_POST["postcomment"]))
{
    $comment=$_POST["comment"];
    add_comment($post_id,$comment);
}
if(isset($_GET['del']) && isset($_GET["c_id"]))
{
    if($_GET['del'] && $_GET["c_id"])
    {
        $id=base64_decode($_GET["c_id"]);
        delete_comment($id);
        $query_string="?name=".$_GET["name"]."&id=".$_GET["id"];
        echo "<script>window.location.href=window.location.origin+window.location.pathname+'{$query_string}'</script>";
    }
}
echo '';
include './includable/bottom.php';
?>