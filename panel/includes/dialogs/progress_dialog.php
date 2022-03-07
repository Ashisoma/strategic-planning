<!-- pi dialog -->
<div class="modal fade" id="divProgressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Activity Progress Dialog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formProgress" action="code.php" method="POST" onsubmit="event.preventDefault();">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Progress Date</label>
                        <input type="date" name="start date" class="form-control" placeholder="Start date" id="inputProgressDate" required>
                    </div>
                    <div class="form-group">
                        <label for="inputProgressNote">Progress Note</label>
                        <textarea name="note" class="form-control" placeholder="Progress note" id="inputProgressNote" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputProgressIncrement">Percentage increase to progress</label>
                        <input type="number" min="1" max="100" name="names" class="form-control" placeholder="1" id="inputProgressIncrement" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearProgressDialog()">Close</button>
                    <button type="submit" name="btnSaveProgress" class="btn btn-primary" id="btnSaveProgress">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>