<!-- New message Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createEventModalLabel">New event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo h($_SERVER['PHP_SELF']);?> " method="POST" enctype="multipart/form-data">
        <input type="hidden" name="eventBy" value="<?php echo $user_id?>">
            <div class="create-group-wrapper">
                <div class="mb-3">
                    <div class="profile-pic">
                        <span class="text-uppercase name">Event Picture</span>
                        <img id="eventprofilePic" src="<?php echo url_for("frontend\assets\images\default_profile.png"); ?>">
                    </div>
                    <div class="mt-3 px-4"> 
                        <div class="d-flex flex-row align-items-center mt-2"> 
                            <div class="ml-3"> 
                                Select image to upload:
                                <input type="file" name="eventfileToUpload" id="eventfileToUpload">
                                <input type="button" id="eventremove-pic" value = "Remove">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <span class="err-msg" id="event-name-err"></span>
                    <label for="eventName" class="form-label">Event Name</label>
                    <input class="form-control" name="eventName" id="eventName" rows="3" required></input>
                </div>
                <div class="mb-3">
                    <span class="err-msg" id="event-desc-err"></span>
                    <label for="eventDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="eventDescription" id="eventDescription" rows="3"required></textarea>
                </div>
                <div class="mb-3">
                    <span class="err-msg" id="event-date-err7"></span>
                    <label for="eventDate" class="form-label">Event Date</label>
                    <input type="date" id="eventDate" name="eventDate"required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn createEvent-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary createEvent-submit">Create</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
