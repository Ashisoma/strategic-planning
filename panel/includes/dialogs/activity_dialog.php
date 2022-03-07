<!-- Activity dialog -->
<div class="modal fade" id="divActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" onsubmit="event.preventDefault();" id="formActivity">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Strategy</label>
                        <select id="selectActivityStrategy" class="form-control">
                            <option value="" selected hidden>Select strategy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectActivityUser">Person Responsible</label>
                        <select id="selectActivityUser" class="form-control">
                            <option value="" selected hidden>Select Person Responsible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="names" class="form-control" placeholder="Enter the activity" id="inputActivityName" required></input>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="names" class="form-control" placeholder="Enter the activity" id="inputActivityDesc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Weight</label>
                        <input type="number" min="1" max="10" name="names" class="form-control" placeholder="1" id="inputActivityWeight" required>
                    </div>
                    <div class="form-group">
                        <label>Expected Start date</label>
                        <input type="date" name="start date" class="form-control" placeholder="Start date" id="inputExpectedStartDate" required>
                    </div>
                    <div class="form-group">
                        <label>Due date</label>
                        <input type="date" name="Due date" class="form-control" placeholder="Due date" id="inputActivityDueDate" required>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select id="selectActivityStatus" class="form-control">
                            <option value="" selected hidden>Select status</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date started</label>
                        <input type="date" name="start date" class="form-control" placeholder="Start date" id="inputDateStarted" disabled>
                    </div>
                    <div class="form-group">
                        <label>Date Completed</label>
                        <input type="date" name="start date" class="form-control" placeholder="Start date" id="inputDateCompleted" disabled>
                    </div>
                    <div class="form-group">
                        <label>Completion notes</label>
                        <textarea type="text" name="names" class="form-control" maxlength="250" placeholder="Enter the activity" id="inputActivityNotes" disabled ></textarea>
                    </div>
                    <div>
                        <label class="errors" id="labelActivityErrors">errors</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearActivityDialog()">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary" id="btnSaveActivity">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>