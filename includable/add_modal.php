<?php
 echo '<!-- Button trigger modal -->
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addthread" hidden>
 </button>
 
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">'.ucfirst($name).' Category.</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
       <form method="post" action='.$_SERVER['PHP_SELF']."?name={$name}".' id="postform">
       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Enter title</label>
         <input type="hidden" name="category_id" value='.$id.'>
         <input type="text" placeholder="title can be upto 100 character only..." class="form-control" id="title" aria-describedby="emailHelp" name="title">
       </div>
       <div class="mb-3">
         <label for="exampleInputPassword1" class="form-label">Enter description</label>
         <textarea class="form-control" rows="4" placeholder="Describe more..." id="description" name="description"></textarea>
       </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" id="createpost">Post</button>
       </div>
       </form>
     </div>
   </div>
 </div>';
 
?>