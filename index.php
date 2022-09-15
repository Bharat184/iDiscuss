<?php
    include './includable/top.php';
        echo '<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel h-25">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./images/image1.jpg" class="d-block w-100" alt="..." style="height:75vh;object-fit:cover;">
          </div>
          <div class="carousel-item">
            <img src="./images/image2.jpg" class="d-block w-100" alt="..." style="height:75vh;object-fit:cover;">
          </div>
          <div class="carousel-item">
            <img src="./images/image3.jpg" class="d-block w-100" alt="..." style="height:75vh;object-fit:cover;">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div><h1 class="text-center mx-3 text-primary mt-2">Welcome to iForum</h1>';
    include './includable/bottom.php';
?>