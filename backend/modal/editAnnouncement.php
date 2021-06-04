<!-- New message Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content message">
      <div class="modal-header">
        <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo h($_SERVER['PHP_SELF']);?> " method="POST">
        <input type="hidden" value="" name="ann_id" class="ann_id">
            <div class="create-group-wrapper">
                <div class="mb-3">
                    <label for="edit-description" class="form-label">Description</label>
                    <textarea class="form-control" name="edit-description" id="edit-description" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn editAnnouncement-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary editAnnouncement-submit">Save</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
