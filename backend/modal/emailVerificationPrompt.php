<?php

$title = "Post is em";
$msg = $errors['verify'].'. A new verification email is send.';

?>
<!-- Modal -->
<div class="modal fade" id="invalidCodePromptModal" tabindex="-1" aria-labelledby="invalidCodePromptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm delete">
    <div class="modal-content delete">
      <div class="modal-header delete">
        <h5 class="modal-title delete" id="invalidCodePromptModalLabel"><?php echo $title ?></h5>
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

