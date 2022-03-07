<!-- pi dialog -->
<div class="modal fade" id="divPiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Performance Indicator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPi" action="code.php" method="POST" onsubmit="event.preventDefault();">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Performance Indicator</label>
                        <textarea type="text" name="names" class="form-control" placeholder="Performance indicator" id="inputPiName" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearPiDialog()">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary" id="btnSavePi">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>