<!-- Goal dialog -->
<div class="modal fade" id="divGoalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Goal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formGoal" action="code.php" method="POST" onsubmit="event.preventDefault();">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputGoalName">Name</label>
                        <input type="text" name="names" class="form-control" placeholder="Goal name" id="inputGoalName" required>
                    </div>
                    <div class="form-group">
                        <label for="inputGoalDescription">Description</label>
                        <textarea type="text" name="names" class="form-control" placeholder="Goal description" id="inputGoalDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="selectGoalLead">Goal lead</label>
                        <select name="selectGoalLead" class="form-control" id="selectGoalLead">
                            <option value="" hidden selected>Select Goal lead</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearGoalDialog()">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary" id="btnSaveGoal">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>