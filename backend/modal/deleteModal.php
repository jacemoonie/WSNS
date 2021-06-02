<?php

$title = "Confirm delete post";
$msg = "This can't be undone, post will be deleted. Confirm to delete post?";

?>
<!-- Modal -->
<div class="modal fade" id="messagePromptModal" tabindex="-1" aria-labelledby="messagePromptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm delete">
    <div class="modal-content delete">
      <div class="modal-header delete">
        <h5 class="modal-title delete" id="messagePromptModalLabel"><?php echo $title ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body delete">
        <?php echo $msg ?>
      </div>
      <div class="modal-footer delete">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="confirmDelete" data-bs-dismiss="modal" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>

