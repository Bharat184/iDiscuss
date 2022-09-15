<?php
    include './includable/top.php';
        echo '<h1 class="text-center">Contact Us<h1><form class="w-90 mx-auto">
        <div class="mb-3">
          <input type="title" placeholder="Enter your title..." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
         <textarea class="form-control" placeholder="Describe..." rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Report</button>
      </form>';
    include './includable/bottom.php';
?>