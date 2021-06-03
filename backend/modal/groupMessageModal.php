<!-- New message Modal -->
<div class="modal fade" id="newGroupMessageModal" tabindex="-1" aria-labelledby="newGroupMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content message">
      <div class="modal-header">
        <h5 class="modal-title" id="newGroupMessageModalLabel">New Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo h($_SERVER['PHP_SELF']);?> " method="POST">
            <div class="create-group-wrapper">
                    <input type="hidden" name="userId" value="<?php echo $user_id ?>">
                <div class="mb-3">
                    <label for="groupName" class="form-label">Group name</label>
                    <input type="text" name="groupName" class="form-control" id="groupName" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="groupDescription" class="form-label">Group description</label>
                    <textarea class="form-control" name="groupDescription" id="groupDescription" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="createGroup-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="createGroup-submit">Create group</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
