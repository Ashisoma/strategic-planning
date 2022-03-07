const completedStatusDiv = "<div class=\"badge badge-success badge-pill p-2\">Completed</div>"
const ongoingStatusDiv = "<div class=\"badge badge-primary badge-pill p-2\">Ongoing</div>"
const notStartedStatusDiv = "<div class=\"badge badge-warning badge-pill p-2\">Not Started</div>"
const overdueStatusDiv = "<div class=\"badge badge-danger badge-pill p-2\">Ongoing</div>"


const tablePis = document.getElementById("tablePis")
const tableStrategies = document.getElementById("tableStrategies")
const objectiveHeading = document.getElementById("objectiveHeading")
const pLead = document.getElementById("pLead")
const btnAddStrategy = document.getElementById("btnAddStrategy")
const btnAddActivity = document.getElementById("btnAddActivity")
const divActivities = document.getElementById("divActivities")
const headerActivity = document.getElementById("headerActivity")

const inputStrategy = document.getElementById("inputStrategy")
const selectActivityStrategy = document.getElementById("selectActivityStrategy")
const selectActivityUser = document.getElementById("selectActivityUser")
const inputActivityName = document.getElementById("inputActivityName")
const divActivityStatus = document.getElementById("divActivityStatus")
const inputActivityDesc = document.getElementById("inputActivityDesc")
const selectActivityStatus = document.getElementById("selectActivityStatus")
const inputExpectedStartDate = document.getElementById("inputExpectedStartDate")
const inputActivityWeight = document.getElementById("inputActivityWeight")
const inputActivityDueDate = document.getElementById("inputActivityDueDate")
const inputDateStarted = document.getElementById("inputDateStarted")
const inputDateCompleted = document.getElementById("inputDateCompleted")
const inputPiName = document.getElementById("inputPiName")
const inputStartDate = document.getElementById("inputStartDate")
const inputDueDate = document.getElementById("inputDueDate")
const selectPiStatus = document.getElementById("selectPiStatus")
const inputActivityNotes = document.getElementById("inputActivityNotes")
var editedStrategy = ""
var editedActivity = ""
var editedPi = ""
var objectiveId = ""
let viewedActivity = null

var multipleCancelButton;

function initialize() {

    let objective = JSON.parse(sessionStorage.getItem("objective"))
    if (objective == null) goBack()
    objectiveId = objective.id
    document.getElementById("objectiveHeading").innerText = objective.name + " : " + objective.description

    getObjectivesData()
    
    if (selectActivityStatus.options.length === 1) {
        $.ajax({
            dataType: "json",
            url: "../assets/data.json",
            success: data => {

                let activityStatuses = data.activityStatuses
                activityStatuses.forEach(activityStatus => {
                    let option = document.createElement("option");
                    option.setAttribute("value", activityStatus);
                    option.appendChild(document.createTextNode(activityStatus));
                    selectActivityStatus.appendChild(option)
                })
            }
        })
        selectActivityStatus.addEventListener("change", () => activityStatusChanged())
    }

    document.getElementById("btnSaveStrategy").addEventListener("click", () => saveStrategy())
    document.getElementById("btnSaveActivity").addEventListener("click", () => saveActivity())
    document.getElementById("btnSavePi").addEventListener("click", () => savePi())

    $("#divStrategyModal").on("hide.bs.modal", () => {
        clearStrategyDialog()
    });
    $("#divActivityModal").on("hide.bs.modal", () => {
        clearActivityDialog()
    });
    $("#divPiModal").on("hide.bs.modal", () => {
        clearPiDialog()
    });

    if(selectActivityUser.options.length <= 1){
        $.ajax({
            type: "GET",
            url: "get_users",
            success: response => {
                let mResponse = JSON.parse(response);
                let code = mResponse.code;
                if (code == 200) {
                    let users = mResponse.data;
                    users.forEach(user => {
                        let option = document.createElement('option');
                        option.setAttribute('value', user.id);
                        option.appendChild(document.createTextNode(user.name));
                        selectActivityUser.appendChild(option);
                    });
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
}

function getObjectivesData(){
    $.ajax({
        type: "GET",
        url: "./../objective_data/" + objectiveId,
        success: response => {
            let mResponse = JSON.parse(response)
            loadStrategies(mResponse.strategies)
            loadActivities(mResponse.activities)
        },
        error: error => {

        }
    })
}

function loadStrategies(strategies) {
    let i = 0
    tableStrategies.removeChild(tableStrategies.querySelector("tbody"))
    let tbody = document.createElement("tbody")
    strategies.forEach(strategy => {
        let row = tbody.insertRow(i)
        let editButton = document.createElement("button")
        editButton.classList.add("btn")
        editButton.classList.add("btn-datatable")
        editButton.classList.add("btn-icon")
        editButton.classList.add("btn-transparent-dark")
        editButton.classList.add("mr-2")
        editButton.innerHTML = "<i class=\"fas fa-edit\"></i>"
        editButton.setAttribute("data-toggle", "modal");
        editButton.setAttribute("data-target", "#divStrategyModal");
        editButton.setAttribute("data-tooltip", "tooltip");
        editButton.setAttribute("title", "Edit this strategy");
        editButton.setAttribute("data-placement", "bottom");
        editButton.addEventListener("click", () => editStrategy(strategy))
        row.insertCell(0).appendChild(document.createTextNode(strategy.name))
        row.insertCell(1).appendChild(editButton);

        if(selectActivityStrategy.options.length <= 1+i){
            let option = document.createElement("option")
            option.setAttribute("value", strategy.id)
            option.appendChild(document.createTextNode(strategy.name))
            option.style.overflow = "normal"
            selectActivityStrategy.appendChild(option)
        }

        i++
    })
    tableStrategies.appendChild(tbody)
}

function loadActivities(activities) {
    divActivities.innerHTML = ""
    for (let i = 0; i < activities.length; i++) {
        let activity = activities[i]
        let btn = document.createElement("button")
        btn.innerText = activity.name.substring(0, 10) + "..."
        if (i === 0) {
            loadPis(activity.pis)
            btn.classList.add("active")
            viewedActivity = activity
            headerActivity.innerText = "Activity : " + activity.description
            document.getElementById("headerActivityStategy").innerHTML = "Strategy : " + activity.strategy.name
            if(document.getElementById("btnViewActivity").hasAttribute("disabled")) document.getElementById("btnViewActivity").removeAttribute("disabled")
            switch (activity.status) {
                case "Completed":
                    divActivityStatus.innerHTML = completedStatusDiv
                    break;
                case "Ongoing":
                    divActivityStatus.innerHTML = ongoingStatusDiv
                    break;
                case "Not Started":
                    document.getElementById("btnViewActivity").setAttribute("disabled", "")
                    divActivityStatus.innerHTML = notStartedStatusDiv
                    break;
                default:
                    document.getElementById("btnViewActivity").setAttribute("disabled", "")
                    divActivityStatus.innerHTML = notStartedStatusDiv
                    break;
            }
        }
        btn.addEventListener("click", () => {
            divActivities.querySelectorAll("button").forEach(b => {
                if (b.classList.contains("active")) b.classList.remove("active")
            })
            btn.classList.add("active")
            headerActivity.innerText = "Activity : " + activity.description
            document.getElementById("headerActivityStategy").innerHTML = "Strategy : " + activity.strategy.name
            if(document.getElementById("btnViewActivity").hasAttribute("disabled")) document.getElementById("btnViewActivity").removeAttribute("disabled")
            switch (activity.status) {
                case "Completed":
                    divActivityStatus.innerHTML = completedStatusDiv
                    break;
                case "Ongoing":
                    divActivityStatus.innerHTML = ongoingStatusDiv
                    break;
                case "Not Started":
                    document.getElementById("btnViewActivity").setAttribute("disabled", "")
                    divActivityStatus.innerHTML = notStartedStatusDiv
                    break;
                default:
                    document.getElementById("btnViewActivity").setAttribute("disabled", "")
                    divActivityStatus.innerHTML = notStartedStatusDiv
                    break;
            }
            loadPis(activity.pis)
            viewedActivity = activity
        })
        divActivities.appendChild(btn)
    }
}

function loadPis(pis) {
    let i = 0
    tablePis.removeChild(tablePis.querySelector("tbody"))
    let tbody = document.createElement("tbody")
    pis.forEach(pi => {
        let row = tbody.insertRow(i)
        let editButton = document.createElement("button")
        editButton.classList.add("btn")
        editButton.classList.add("btn-datatable")
        editButton.classList.add("btn-icon")
        editButton.classList.add("btn-transparent-dark")
        editButton.classList.add("mr-2")
        editButton.classList.add("ml-2")
        editButton.setAttribute("data-toggle", "modal");
        editButton.setAttribute("data-target", "#divPiModal");
        editButton.setAttribute("data-tooltip", "tooltip");
        editButton.setAttribute("data-placement", "bottom");
        editButton.setAttribute("title", "Edit this indicator");
        editButton.innerHTML = "<i data-feather=\"more-vertical\" class=\"fas fa-edit\"></i>"
        editButton.addEventListener("click", () => editPi(pi))

        let progressesButton = document.createElement("button")
        progressesButton.classList.add("btn")
        progressesButton.classList.add("btn-datatable")
        progressesButton.classList.add("btn-icon")
        progressesButton.classList.add("btn-transparent-dark")
        progressesButton.classList.add("mr-2")
        progressesButton.setAttribute("data-tooltip", "tooltip");
        progressesButton.setAttribute("data-placement", "bottom");
        progressesButton.setAttribute("title", "View progress");
        progressesButton.innerHTML = "<i data-feather=\"more-vertical\" class=\"fas fa-eye\"></i>"
        progressesButton.addEventListener("click", () => {
            sessionStorage.setItem("pi", JSON.stringify(pi))
            window.location.replace("progresses")
        })
        let actionDiv = document.createElement("div")
        actionDiv.classList.add("row")
        actionDiv.appendChild(editButton)
        //actionDiv.appendChild(progressesButton)

        let statusTd = document.createElement("td")
        switch (pi.status) {
            case "Completed":
                statusTd.innerHTML = completedStatusDiv
                break;
            case "Ongoing":
                statusTd.innerHTML = ongoingStatusDiv
                break;
            case "Not Started":
                statusTd.innerHTML = notStartedStatusDiv
                break;
            default:
                statusTd.innerHTML = notStartedStatusDiv
                break;
        }
        row.insertCell(0).appendChild(document.createTextNode(pi.name))
        row.insertCell(1).appendChild(actionDiv)

        i++
    })
    tablePis.appendChild(tbody)
}

function editViewedActivity() {
    if (viewedActivity != null) {
        editedActivity = viewedActivity.id
        inputActivityName.value = viewedActivity.name
        inputActivityDesc.value = viewedActivity.description
        $("#selectActivityStrategy").val(viewedActivity.strategy_id)
        $("#selectActivityUser").val(viewedActivity.user_id)
        inputActivityWeight.value = viewedActivity.weight
        inputExpectedStartDate.value = viewedActivity.expected_start_date
        inputActivityDueDate.value = viewedActivity.due_date
        $(selectActivityStatus).val(viewedActivity.status)
        activityStatusChanged()
        inputDateStarted.value = viewedActivity.date_started
        inputDateCompleted.value = viewedActivity.date_completed
        inputActivityNotes.value = viewedActivity.completion_note
    }
}

function viewedActivityProgress() {
    sessionStorage.setItem("activity", JSON.stringify(viewedActivity))
    window.location.replace("progresses")
}

function editStrategy(strategy) {
    inputStrategy.value = strategy.name
    editedStrategy = strategy.id
}

function editPi(pi) {
    editedPi = pi.id
    inputPiName.value = pi.name
}

function saveStrategy() {
    let name = inputStrategy.value.trim()
    $.ajax({
        type: "POST",
        url: "./../save_strategy",
        data: {
            id: editedStrategy,
            name: name,
            objective_id: objectiveId
        },
        success: () => {
            $("#divStrategyModal").modal("hide")
            getObjectivesData()
        },
        error: error => {
            //TODO handle error
        }
    })
}

function saveActivity() {
    let user = selectActivityUser.options[selectActivityUser.selectedIndex].value
    let strategy = selectActivityStrategy.options[selectActivityStrategy.selectedIndex].value
    let activityName = inputActivityName.value.trim()
    let activityDesc = inputActivityDesc.value.trim()
    let activityStatus = selectActivityStatus.options[selectActivityStatus.selectedIndex].value
    let expectedStartDate = inputExpectedStartDate.value
    let dueDate = inputActivityDueDate.value
    let dateStarted = inputDateStarted.value
    let dateCompleted = inputDateCompleted.value
    let weight = inputActivityWeight.value
    let completion_note = inputActivityNotes.value.trim()
    let errors = ""
    if (strategy === "") errors += "Select a valid strategy \n"
    if (user === "") errors += "Select a valid user \n"
    if (activityName === "") errors += "Enter a valid activity name \n"
    if (expectedStartDate === "") errors += "Enter a valid expectedStartDate \n"
    if (dueDate === "") errors += "Enter a valid value for due date \n"
    if (weight === "" || weight > 10) errors += "Enter a valid value for weight \n"
    if (activityStatus === "") errors += "Select a valid activity status \n"
    else if (activityStatus === "Ongoing" || activityStatus === "Completed") {
        if (dateStarted === "") errors += "Enter a valid value for date started \n"
    }
    if (activityStatus === "Completed"){
        if(dateCompleted === "") errors += "Enter a valid value for date of completion \n"
        if(completion_note === "") errors += "Enter a valid value for completion note \n"
    }
    if (errors !== "") {
        // TODO handle error
        return
    }
    let id = ''
    if (viewedActivity != null) id = viewedActivity.id
    $.ajax({
        type: "POST",
        url: "./../save_activity",
        data: {
            id: editedActivity,
            objective_id: objectiveId,
            user_id: user,
            name: activityName,
            description: activityDesc,
            strategy_id: strategy,
            status: activityStatus,
            expected_start_date: expectedStartDate,
            due_date: dueDate,
            date_started: dateStarted,
            date_completed: dateCompleted,
            weight: weight,
            completion_note: completion_note
        },
        success: () => {
            $("#divActivityModal").modal("hide")
            getObjectivesData()
        },

    })
}

function savePi() {
    let name = inputPiName.value.trim()
    let data = new FormData()
    data.append("name", name)
    data.append("id", editedPi)
    data.append("activity_id", viewedActivity.id)
    // data.append("allocatedUsers", members)
    $.ajax({
        type: "POST",
        url: "../save_pi",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        success: () => {
            $('#divPiModal').modal('hide');
            getObjectivesData()
        },
        error: error => {
            //TODO handle error
        }
    })
}

function activityStatusChanged() {
    let selected = selectActivityStatus.options[selectActivityStatus.selectedIndex].value
    if (selected === "Ongoing") {
        if (inputDateStarted.hasAttribute("disabled")) inputDateStarted.removeAttribute('disabled')
        inputDateCompleted.setAttribute("disabled", "")
        inputActivityNotes.setAttribute("disabled", "")
        inputDateCompleted.value = ''
        inputActivityNotes.value = ''
    } else if (selected === "Completed") {
        if (inputDateStarted.hasAttribute("disabled")) inputDateStarted.removeAttribute('disabled')
        if (inputDateCompleted.hasAttribute("disabled")) inputDateCompleted.removeAttribute('disabled')
        if (inputActivityNotes.hasAttribute('disabled')) inputActivityNotes.removeAttribute('disabled')
    } else {
        inputDateStarted.setAttribute("disabled", "")
        inputDateCompleted.setAttribute("disabled", "")
        inputActivityNotes.setAttribute("disabled", "")
        inputDateStarted.value = ''
        inputDateCompleted.value = ''
        inputActivityNotes.value = ''
    }

}

function goBack() {
    window.location.replace("goals")
}

function clearStrategyDialog() {
    editedStrategy = ""
    document.getElementById("formStrategy").reset()
}

function clearPiDialog() {
    editedPi = ""
    document.getElementById("formPi").reset()
}

function clearActivityDialog() {
    editedActivity = ""
    document.getElementById("formActivity").reset()
    activityStatusChanged()
}














initialize()
