//Damn where do i start now................................................................

var headerdiv;

const completedStatusDiv = "<div class=\"badge badge-success badge-pill p-2\">Completed</div>"
const ongoingStatusDiv = "<div class=\"badge badge-primary badge-pill p-2\">Ongoing</div>"
const notStartedStatusDiv = "<div class=\"badge badge-warning badge-pill p-2\">Not Started</div>"
const overdueStatusDiv = "<div class=\"badge badge-danger badge-pill p-2\">Ongoing</div>"
var editedPi = ""
var editedGoal = ""
var editedObjective = ""
var viewedGoal = null

const inputGoalName = document.getElementById("inputGoalName")
const inputGoalDescription = document.getElementById("inputGoalDescription")
const selectGoalLead = document.getElementById("selectGoalLead")

const selectObjectiveGoal = document.getElementById("selectObjectiveGoal")
const inputObjectiveName = document.getElementById("inputObjectiveName")
const inputObjectiveDesc = document.getElementById("inputObjectiveDesc")
const selectObjectiveLead = document.getElementById("selectObjectiveLead")

const inputPiName = document.getElementById("inputPiName")
const inputStartDate = document.getElementById("inputStartDate")
const inputDueDate = document.getElementById("inputDueDate")

function initialize() {
    $.ajax({
        type: "GET",
        url: "./../goals",
        success: response => {
            let goals = JSON.parse(response)
            loadGoals(goals)
        },
        error: err => {

        }
    })
    $.ajax({
        type: "GET",
        url: "get_users",
        success: response => {
            let mResponse = JSON.parse(response)
            if (mResponse.code === 200) {
                let users = mResponse.data
                users.forEach(user => {
                    let option = document.createElement("option")
                    option.setAttribute("value", user.id)
                    option.appendChild(document.createTextNode(user.name))
                    selectGoalLead.appendChild(option)
                    selectObjectiveLead.appendChild(option.cloneNode(true))
                })
            } else {
                // TODO handle error
            }
        },
        error: error => {

        }
    })

    $("#divPiModal").on("hide.bs.modal", () => {
        clearPiDialog()
    })
    $("#divGoalModal").on("hide.bs.modal", () => {
        clearGoalDialog()
    })
    $("#divObjectiveModal").on("hide.bs.modal", () => {
        clearObjectiveDialog()
    })
    document.getElementById("btnSaveGoal").addEventListener("click", () => saveGoal())
    document.getElementById("btnSaveObjective").addEventListener("click", () => saveObjective())
    document.getElementById("btnSavePi").addEventListener("click", () => savePi())

}

function loadGoals(goals) {
    let divGoals = document.getElementById("divGoals")
    removeAllChildNodes(divGoals)
    let myTabContent = document.getElementById("myTabContent");
    removeAllChildNodes(myTabContent)

    for (let i = 0; i < goals.length; i++) {
        let goal = goals[i]

        let option = document.createElement("option")
        option.setAttribute("value", goal.id)
        option.appendChild(document.createTextNode(goal.name))
        selectObjectiveGoal.appendChild(option)

        let li = document.createElement("li")
        li.classList.add("nav-item");
        let link = document.createElement('a');
        link.classList.add("nav-link");
        if (i === 0) link.classList.add("active");
        link.setAttribute("data-toggle", "tab");
        link.setAttribute("role", "tab");
        link.setAttribute("aria-controls", "home");
        link.setAttribute("aria-expanded", "true");
        link.setAttribute("data-toggle", "tab");
        link.innerText = goal.name;

        let contentdiv = document.createElement("div");
        contentdiv.classList.add("tab-pane", "fade");
        if (i === 0) contentdiv.classList.add("show", "active");
        contentdiv.setAttribute("id", "goal" + (i + 1));
        contentdiv.setAttribute("role", "tabpanel");
        contentdiv.setAttribute("aria-labelledby", (i + 1) + "-tab");

        headerdiv = document.createElement("div");
        headerdiv.classList.add("tab-pane-header");

        let goalname = document.createElement("h2");
        goalname.classList.add("mb-4");
        goalname.setAttribute("id", "headerGoalDesc");
        goalname.innerHTML = "Goal: " + goal.description;

        headerdiv.appendChild(goalname);
        loadGoal(goal);

        contentdiv.appendChild(headerdiv);
        myTabContent.appendChild(contentdiv);

        link.setAttribute("href", "#goal" + (i + 1));
        li.appendChild(link);
        divGoals.appendChild(li);

    }
}

function loadGoal(goal) {

    let accordion = document.createElement("div");
    accordion.classList.add("accordion");
    accordion.setAttribute("id", "accordion");

    let objectivesCard = document.createElement("div");
    objectivesCard.classList.add("card", "mb-0");
    //edit goal button
    let btnEditGoal = document.createElement("button")
    btnEditGoal.classList.add("btn")
    btnEditGoal.classList.add("btn-info")
    btnEditGoal.classList.add("btn-icon-split")
    btnEditGoal.classList.add("mr-4")
    btnEditGoal.classList.add("mt-4")
    btnEditGoal.setAttribute("data-toggle", "modal");
    btnEditGoal.setAttribute("data-target", "#divGoalModal")
    btnEditGoal.setAttribute("data-placement", "bottom")
    btnEditGoal.innerHTML = "<span class=\"icon text-white-50\"><i data-feather=\"more-vertical\" class=\"fas fa-edit\"></i></span><span class=\"text\"> Edit Goal</span>"
    btnEditGoal.addEventListener("click", () => editGoal(goal))
    //Add Objective
    let btnAddObjective = document.createElement("button")
    btnAddObjective.classList.add("btn")
    btnAddObjective.classList.add("btn-info")
    btnAddObjective.classList.add("btn-icon-split")
    btnAddObjective.classList.add("mr-4")
    btnAddObjective.classList.add("mt-4")
    btnAddObjective.setAttribute("data-toggle", "modal");
    btnAddObjective.setAttribute("data-target", "#divObjectiveModal")
    btnAddObjective.setAttribute("data-placement", "bottom")
    btnAddObjective.innerHTML = "<span class=\"icon text-white-50\"><i data-feather=\"more-vertical\" class=\"fas fa-plus\"></i></span><span class=\"text\"> Add Objective</span>"
    btnAddObjective.addEventListener("click", () => {
        $(selectObjectiveGoal).val(goal.id)
    })
    goal.objectives.forEach(objective => {
        let someDiv = document.createElement("div")
        someDiv.classList.add("card-header")
        someDiv.classList.add("collapsed")
        someDiv.setAttribute("data-toggle", "collapse")
        someDiv.setAttribute("href", "#collapseCard" + objective.id)
        //some a
        let a = document.createElement("a")
        a.classList.add("card-title")
        a.classList.add("mr-4")
        // some h6
        let h6 = document.createElement("h6")
        h6.classList.add("font-weight-bold")
        h6.classList.add("text-dark")
        h6.innerText = objective.name + " : " + objective.description
        // some button
        let buttonView = document.createElement("button")
        buttonView.innerHTML = "<span class=\"icon text-white-50\"><i data-feather=\"more-vertical\" class=\"fas fa-eye\"></i></span><span class=\"text\"> View & Update Activities</span>"
        buttonView.classList.add("btn")
        buttonView.classList.add("btn-info")
        buttonView.classList.add("mt-4")
        buttonView.addEventListener("click", () => {
            sessionStorage.setItem("objective", JSON.stringify(objective))
            window.location.replace("objective")
        })
        // some button edit objective
        let buttonEditObjective = document.createElement("button")
        buttonEditObjective.innerHTML = "<span class=\"icon text-white-50\"><i data-feather=\"more-vertical\" class=\"fas fa-edit\"></i></span><span class=\"text\"> Edit Objective</span>"
        buttonEditObjective.classList.add("btn")
        buttonEditObjective.classList.add("btn-info")
        buttonEditObjective.classList.add("btn-icon-split")
        buttonEditObjective.classList.add("mr-4")
        buttonEditObjective.classList.add("mt-4")
        buttonEditObjective.setAttribute("data-toggle", "modal");
        buttonEditObjective.setAttribute("data-target", "#divObjectiveModal")
        buttonEditObjective.setAttribute("data-placement", "bottom")
        buttonEditObjective.addEventListener("click", () => editObjective(objective))
        // bottom buttons' div 
        let divButtons = document.createElement("div");
        divButtons.classList.add("btn-toolbar")
        divButtons.setAttribute("role", "toolbar")
        divButtons.appendChild(buttonEditObjective)
        divButtons.appendChild(buttonView)
        // some other div
        let div = document.createElement("div")
        div.classList.add("mt-2")
        div.classList.add("text-silver")
        div.innerText = "Led by: " + objective.leadname;
        a.appendChild(h6)
        a.appendChild(div)
        someDiv.appendChild(a)
        objectivesCard.appendChild(someDiv)
        /*******````~~~~~~~~~~Collapsing part */
        let collapseDiv = document.createElement("div")
        collapseDiv.classList.add("card-body")
        collapseDiv.classList.add("collapse")
        collapseDiv.setAttribute("id", "collapseCard" + objective.id)
        collapseDiv.setAttribute("data-parent", "#accordion")
        let tableDiv = document.createElement("div")
        tableDiv.classList.add("datatable")
        let table = document.createElement("table")
        table.classList.add("table")
        table.classList.add("table-bordered")
        table.classList.add("table-hover")
        table.setAttribute("width", "100%")
        table.setAttribute("cellspacing", "0")

        let thead = document.createElement("thead")
        let tableHeaders = "<tr><th>Strategy</th><th>Key Activities</th><th>Person Responsible</th><th>Expected Timeline</th><th>Weght</th><th>Status</th><th>Date Started</th><th>Performance Indicators</th></tr>"
        thead.innerHTML = tableHeaders
        let tfoot = document.createElement("tfoot")
        tfoot.innerHTML = tableHeaders
        let tbody = document.createElement("tbody")
        table.appendChild(thead)
        table.appendChild(tfoot)
        let activities = objective.activities
        activities.forEach(activity => {
            let rowActivity = document.createElement("tr")
            let span = 1
            if (activity.pis.length > 0) span = activity.pis.length
            let strategyTd = document.createElement("th")
            let activityTd = document.createElement("th")
            let personTd = document.createElement("th")
            let expectedTimelineTd = document.createElement("th")
            let weightTd = document.createElement("th")
            let statusTd = document.createElement("th")
            let dateStartedTd = document.createElement("th")

            console.dir(activityTd)
            activityTd.innerText = activity.description
            strategyTd.innerText = activity.strategy.name
            personTd.innerText = activity.personResponsible.name
            expectedTimelineTd.innerText = DateFormatter.formatDate(new Date(activity.expected_start_date), 'DD MMM YYYY') + ' - ' + DateFormatter.formatDate(new Date(activity.due_date), 'DD MMM YYYY')
            weightTd.innerText = activity.weight
            switch (activity.status) {
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
            dateStartedTd.innerText = activity.date_started
            rowActivity.appendChild(strategyTd)
            rowActivity.appendChild(activityTd)
            rowActivity.appendChild(personTd)
            rowActivity.appendChild(expectedTimelineTd)
            rowActivity.appendChild(weightTd)
            rowActivity.appendChild(statusTd)
            rowActivity.appendChild(dateStartedTd)


            activityTd.rowSpan = span
            strategyTd.rowSpan = span
            personTd.rowSpan = span
            expectedTimelineTd.rowSpan = span
            weightTd.rowSpan = span
            statusTd.rowSpan = span
            dateStartedTd.rowSpan = span
            if (activity.pis.length === 0) {
                let blankTd = document.createElement("td")
                blankTd.rowSpan = 1
                blankTd.innerText = ''
                rowActivity.appendChild(blankTd)
                // rowActivity.appendChild(blankTd.cloneNode())
                // rowActivity.appendChild(blankTd.cloneNode())
                // rowActivity.appendChild(blankTd.cloneNode())
            } else {
                let i = 0
                activity.pis.forEach(pi => {
                    let piTd = document.createElement("td")
                    piTd.rowSpan = 1
                    piTd.innerText = pi.name
                    let td = document.createElement("td")
                    td.rowSpan = 1
                    td.innerText = ""
                    td.setAttribute("rowspan", 1)

                    let editButton = document.createElement("button")
                    editButton.classList.add("btn")
                    editButton.classList.add("btn-datatable")
                    editButton.classList.add("btn-icon")
                    editButton.classList.add("btn-transparent-dark")
                    editButton.classList.add("mr-2")
                    editButton.setAttribute("data-toggle", "modal");
                    editButton.setAttribute("data-target", "#divPiModal");
                    editButton.setAttribute("data-tooltip", "tooltip");
                    editButton.setAttribute("data-placement", "bottom");
                    editButton.setAttribute("title", "Edit this indicator");
                    editButton.innerHTML = "<i data-feather=\"more-vertical\" class=\"fas fa-edit\"></i>"
                    editButton.addEventListener("click", () => editPi(pi))
                    let actionTd = document.createElement("td")
                    actionTd.appendChild(editButton)
                    if (i === 0) {
                        rowActivity.appendChild(piTd)
                        // rowActivity.appendChild(actionTd)
                        tbody.appendChild(rowActivity)
                    } else {
                        let piRow = document.createElement("tr")
                        piRow.appendChild(piTd)
                        // piRow.appendChild(actionTd)
                        tbody.appendChild(piRow)
                    }
                    i++
                })
            }
        })
        table.appendChild(tbody)
        tableDiv.appendChild(table)
        collapseDiv.appendChild(tableDiv)
        collapseDiv.appendChild(divButtons)
        objectivesCard.appendChild(collapseDiv)
        accordion.appendChild(objectivesCard)
        headerdiv.appendChild(accordion)
    })
    headerdiv.appendChild(btnEditGoal)
    headerdiv.appendChild(btnAddObjective)
}

function editPi(pi) {
    editedPi = pi.id
    inputPiName.value = pi.name
    inputStartDate.value = pi.start_date
    inputDueDate.value = pi.due_date
    $("#selectPiStatus").val(pi.status)
}

function editGoal(goal) {
    editedGoal = goal.id
    inputGoalName.value = goal.name
    inputGoalDescription.value = goal.description
    $(selectGoalLead).val(goal.lead)
}

function editObjective(objective) {
    editedObjective = objective.id
    $(selectObjectiveGoal).val(objective.goal_id)
    inputObjectiveName.value = objective.name
    inputObjectiveDesc.value = objective.description
    $(selectObjectiveLead).val(objective.lead)
}

function clearPiDialog() {
    editedPi = ""
    document.getElementById("formPi").reset()
}

function clearGoalDialog() {
    editedGoal = ""
    document.getElementById("formGoal").reset()
}

function clearObjectiveDialog() {
    editedObjective = ""
    document.getElementById("formObjective").reset()
}

function saveGoal() {
    let name = inputGoalName.value.trim()
    let description = inputGoalDescription.value.trim()
    let lead = selectGoalLead.options[selectGoalLead.selectedIndex].value
    let error = ""
    if (name === "") error += "Enter a valid name \n"
    if (description === "") error += "Enter a valid description \n"
    if (lead === "") error += "Select a valid lead \n"
    if (error !== "") {
        // TODO: handle error
        return
    }
    let data = new FormData()
    data.append("name", name)
    data.append("description", description)
    data.append("lead", lead)
    data.append("id", editedGoal)
    $.ajax({
        type: "POST",
        url: "./../save_goal",
        data: data,
        success: response => {
            let goals = JSON.parse(response)
            $("#divGoalModal").modal("hide");
            loadGoals(goals)
        },
        error: error => {
            // TODO: handle error
        },
        cache: false,
        contentType: false,
        processData: false,
    })
}

function savePi() {
    let name = inputPiName.value.trim()

    for (let i = 0; i < memberOptions.length; i++) {
        let option = memberOptions[i];
        if (option.selected) {
            members.push(option.value);
        }
    }
    let data = new FormData()
    data.append("name", name)
    $.ajax({
        type: "POST",
        url: "./../save_pi",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        success: () => {
            $('#divPiModal').modal('hide');
            initialize()
        },
        error: error => {
            //TODO handle error
        }
    })
}

function saveObjective() {
    let goal_id = selectObjectiveGoal.options[selectObjectiveGoal.selectedIndex].value
    let name = inputObjectiveName.value.trim()
    let description = inputObjectiveDesc.value.trim()
    let lead = selectObjectiveLead.options[selectObjectiveLead.selectedIndex].value
    let error = ""
    if (name === "") error += "Enter a valid objective name \n"
    if (lead === "") error += "Select a valid objective lead \n"
    if (error !== "") {
        //TODO handle error
        return
    }
    let data = new FormData()
    data.append("id", editedObjective)
    data.append("name", name)
    data.append("description", description)
    data.append("lead", lead)
    data.append("goal_id", goal_id)
    $.ajax({
        type: "POST",
        url: "./../save_objective",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        success: response => {
            let goals = JSON.parse(response)
            $("#divObjectiveModal").modal("hide")
            loadGoals(goals)
        },
        error: error => {
            //TODO: handle error
        }
    })
}




initialize()
