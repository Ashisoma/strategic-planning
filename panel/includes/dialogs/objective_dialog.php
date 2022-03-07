 <!-- Objective dialog -->
<div class="modal fade" id="divObjectiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Objective</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formObjective" action="code.php" method="POST" onsubmit="event.preventDefault();">

                <div class="modal-body">
                <div class="form-group">
                        <label for="selectObjectiveGoal">Goal</label>
                        <select name="selectObjectiveGoal" class="form-control" id="selectObjectiveGoal" disabled>
                            <option value="" hidden selected>Select Goal</option>
                        </select>
                    </div>
                    <div class="form-group">
                         <label for="inputObjectiveName">Objective name</label>
                         <input type="text" name="names" class="form-control" placeholder="Objective" id="inputObjectiveName" required></input>
                    </div>
                    
                    <div class="form-group">
                         <label for="inputObjectiveName">Objective description</label>
                         <textarea type="text" name="description" class="form-control" placeholder="Objective" id="inputObjectiveDesc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="selectObjectiveLead">Objective lead</label>
                        <select name="selectGoalLead" class="form-control" id="selectObjectiveLead">
                            <option value="" hidden selected>Select Objective lead</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary" id="btnSaveObjective">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>