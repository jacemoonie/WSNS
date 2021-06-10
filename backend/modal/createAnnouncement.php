<!-- New message Modal -->
<div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createAnnouncementModalLabel">New Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo h($_SERVER['PHP_SELF']);?> " method="POST">
            <div class="create-group-wrapper">
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn createAnnouncement-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary createAnnouncement-submit">Post</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
