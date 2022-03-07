const booSelect = document.getElementById("booSelect");
var operationBases = null;
initialize();

const userDataTable = document.getElementById("userDataTable");
const addUsersmodal = document.getElementById("addUsersmodal");
//Modal inputs
const inputUsername = document.getElementById("inputUserName");
const genderSelect = document.getElementById("genderSelect");
const inputDesignation = document.getElementById("inputDesignation");
const inputPhone = document.getElementById("inputPhone");
const inputEmail = document.getElementById("inputEmail");
const btnSaveUser = document.getElementById("btnSaveUser")
const labelId = document.getElementById("label-id");
btnSaveUser.addEventListener("click", () => funSaveUser());

var editedUser = ""

function initialize() {
    $.ajax({
        dataType: "json",
        url: "../assets/data.json",
        success: response => {
            operationBases = response.operation_bases;
            getUsers()
            operationBases.forEach(oname => {
                let option = document.createElement('option');
                option.value = oname.id;
                option.appendChild(document.createTextNode(oname.name));
                booSelect.appendChild(option);
            });
        }
    });
    $("#addUsersmodal").on("hide.bs.modal", () => {
        clearUserDialog()
    })

}

function getUsers() {

    $.ajax({
        type: "GET",
        url: "get_users",
        success: response => {
            let mResponse = JSON.parse(response);
            let code = mResponse.code;
            if (code === 200) {
                let users = mResponse.data;
                loadtoUsersTable(users);
            } else {
                var error = [];
                error.status = code;
                error.message = mResponse.message;
            }
        },
        error: err => {

        }
    });
}

function getOperationBases() {
    return operationBases
}

function loadtoUsersTable(users) {
    let tbody = userDataTable.querySelector("tbody");
    userDataTable.removeChild(tbody);
    let newBody = document.createElement("tbody");
    for (let i = 0; i < users.length; i++) {
        let user = users[i];
        let names = user.name;
        let mobile = user.mobile;
        let email = user.email;
        let operation_base = user.operation_base;
        let booname = '';
        //get name of operation base
        operationBases.forEach(oname => {
            if (oname.id == operation_base) {
                booname = oname.name;
            }
        });

        let designation = user.designation;
        let gender = user.gender;
        let statusid = user.active;

        var status = "";

        if (statusid == 1) {
            status = "Active";
        } else {
            status = "Inactive";
        }

        let divActive = document.createElement("div");
        divActive.classList.add("badge", "badge-primary", "badge-pill")
        divActive.appendChild(document.createTextNode("Active"));

        let divInactive = document.createElement("div");
        divInactive.classList.add("badge", "badge-warning", "badge-pill")
        divInactive.appendChild(document.createTextNode("Inactive"));

        let row = newBody.insertRow(i);
        row.insertCell(0).appendChild(document.createTextNode(names));
        row.insertCell(1).appendChild(document.createTextNode(booname));
        row.insertCell(2).appendChild(document.createTextNode(designation));
        row.insertCell(3).appendChild(document.createTextNode(email));
        row.insertCell(4).appendChild(document.createTextNode(mobile));
        row.insertCell(5).appendChild(user.active === 0 ? divInactive.cloneNode(true) : divActive.cloneNode(true));

        let editUser = document.createElement("a");
        editUser.setAttribute("href", "#");
        editUser.setAttribute("data-toggle", "modal");
        editUser.setAttribute("data-target", "#addUsersmodal");
        editUser.setAttribute("data-tooltip", "tooltip");
        editUser.setAttribute("title", "Edit User Details");
        editUser.setAttribute("data-placement", "bottom");
        editUser.classList.add("btn");
        editUser.classList.add("btn-light");
        editUser.classList.add("btn-circle");
        editUser.classList.add("btn-sm");
        editUser.classList.add("app-button");
        editUser.innerHTML = '<i class="fas fa-edit"></i>';
        editUser.addEventListener("click", () => funEditUser(user));

        let actionDiv = document.createElement("div");
        actionDiv.classList.add("row");
        actionDiv.appendChild(editUser);

        row.insertCell(6).appendChild(actionDiv);
    }
    userDataTable.appendChild(newBody);
    $('[data-tooltip="tooltip"]').tooltip();
    $(userDataTable).DataTable();
}

function funEditUser(user) {
    editedUser = user.id
    inputUsername.value = user.name;
    $("#genderSelect").val(user.gender);
    $("#booSelect").val(user.operation_base);
    inputDesignation.value = user.designation;
    inputEmail.value = user.email;
    inputPhone.value = user.mobile;
}

function funSaveUser() {
    let errors = document.querySelectorAll(".errors");
    errors.forEach((error) => {
        if (error.classList.contains("errors-showing")) {
            error.classList.remove("errors-showing");
        }
    });
    let names = inputUsername.value.trim();
    let mobile = inputPhone.value.trim();
    let gender = genderSelect.options[genderSelect.selectedIndex].value;
    let operation_base = booSelect.options[booSelect.selectedIndex].value;
    let designation = inputDesignation.value.trim();
    let email = inputEmail.value.trim();

    let error = false;

    if (gender.length < 1) {
        error = true;
        let errorDisplay = document.getElementById("gender-error");
        errorDisplay.classList.add("errors-showing");
    }
    if (!(isValid(mobile.trim()))) {
        error = true;
        let errorDisplay = document.getElementById("phonenumber-error");
        errorDisplay.classList.add("errors-showing");
        errorDisplay.innerHTML = "Enter a valid phone number.";
    }
    if (operation_base.length < 1) {
        error = true;
        let errorDisplay = document.getElementById("boo-error");
        errorDisplay.classList.add("errors-showing");
    }
    if (designation.length < 1) {
        error = true;
        let errorDisplay = document.getElementById("designation-error");
        errorDisplay.classList.add("errors-showing");
    }
    if (names.length < 1) {
        error = true;
        let errorDisplay = document.getElementById("name-error");
        errorDisplay.classList.add("errors-showing");
    }
    if (email.length < 1) {
        error = true;
        let errorDisplay = document.getElementById("email-error");
        errorDisplay.classList.add("errors-showing");
    }
    if (error) {
        return;
    }
    $.ajax({
        type: "POST",
        url: "save_user",
        data: {
            id: editedUser,
            names: names,
            gender: gender,
            operation_base: operation_base,
            designation: designation,
            email: email,
            mobile: mobile
        },
        success: function (response) {
            var mResponse = JSON.parse(response);
            let code = mResponse.code;
            if (code == 200) {
                $('#addUsersmodal').modal("hide");
                loadtoUsersTable(mResponse.data);
            } else {
                let error = [];
                error.status = code;
                error.message = mResponse.message;
                // handleAjaxError(error);
            }
        },
        error: (err) => handleAjaxError(err),
    });
}

function clearUserDialog() {
    editedUser = ""
    document.getElementById("formUser").reset()

}

function isValid(phone) {
    String.prototype.isNumber = function () {
        return /^\d+$/.test(this);
    }
    if (phone !== 0 && phone.length == 10 && phone.isNumber()) {
        return true;
    } else {
        return false;
    }
}
