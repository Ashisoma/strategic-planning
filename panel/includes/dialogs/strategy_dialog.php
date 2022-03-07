<!-- add Strategy dialog -->
<div class="modal fade" id="divStrategyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Strategy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" onsubmit="event.preventDefault();" id="formStrategy">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <label id="name-error" class="errors">Error</label>
                        <textarea type="text" name="names" class="form-control" placeholder="Enter the strategy" rows="3" id="inputStrategy" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearStrategyDialog()">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary" id="btnSaveStrategy">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>