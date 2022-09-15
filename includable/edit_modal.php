<?php

    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#posteditmodal" id="editmodalbtn" hidden>
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="posteditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit-modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body edit-post-modal">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updatepost">Save Changes</button>
          </div>
        </div>
      </div>
    </div>';

?>