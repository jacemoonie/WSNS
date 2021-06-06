<!-- New group Modal -->
<div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editGroupModalLabel">Group details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" class="" role="search" aria-label="Search people">
            <div class="create-group-wrapper">
              <input type="hidden" name="groupCreatedBy" id="groupCreatedBy" value="<?php echo $user_id ?>">
                <div class="mb-3">
                    <label for="groupName" class="form-label">Group name</label>
                    <input type="text" name="groupName" class="form-control" id="edit-groupName" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="groupDescription" class="form-label">Group description</label>
                    <textarea class="form-control" name="groupDescription" id="edit-groupDescription" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="groupDescription" class="form-label">Group members</label>
                    <span style="display:none;" id="edit-err-msg">Participant already added</span> 
                    <div class="group-participant-list" id="group-participant-list">
                    </div>
                </div>
                <div class="s-wrapper">
                  <div class="s-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"/></g></svg>
                  </div>
                  <div class="s-bar">
                      <input type="text" aria-label="Search query" placeholder="Search user" role="combox" class="s-user"  id="edit-group-participant" autocomplete="off">
                  </div>
                </div>
                  <div class="participant-list" id="participant-list">
                  </div>
                  <div class="s-wrapper-user-container">
                      <ul class="s-result-user" id="s-edit-result-user"style="overflow-y:auto,height:90%;">
                      </ul>
                  </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="editGroup-cancel" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="editGroup-submit" data-bs-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>