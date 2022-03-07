<div class="modal fade" id="addUsersmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" id="formUser" onsubmit="event.preventDefault();">

                <div class="modal-body">

                    <div class="form-group">
                        <label>ID: </label>
                        <label id="label-id" class="label-inline"></label>
                    </div>
                    <div class="form-group">
                        <label>Names</label>
                        <label id="name-error" class="errors">Names must be provided</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Names" id="inputUserName" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <label id="gender-error" class="errors">Gender must be provided</label>
                        <select id="genderSelect" class="form-control">
                            <option hidden value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Base Of Operation</label>
                        <label id="boo-error" class="errors">Base of Operation must be provided</label>
                        <select id="booSelect" class="form-control">
                            <option hidden value="">Select Base of Operation</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <label id="designation-error" class="errors">Designation must be provided</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Designation" id="inputDesignation" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <label id="phonenumber-error" class="errors">Phone Number must be provided</label>
                        <input type="number" name="name" class="form-control" placeholder="Enter Phone Number" id="inputPhone" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <label id="email-error" class="errors">Email must be provided</label>
                        <input type="email" name="name" class="form-control" placeholder="Enter Email" id="inputEmail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="submit" name="btnSubmit" class="btn btn-primary" id="btnSaveUser">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>