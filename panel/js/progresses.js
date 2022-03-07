
var activityId = null

const inputProgressDate = document.getElementById("inputProgressDate")
const inputProgressNote = document.getElementById("inputProgressNote")
const inputProgressIncrement = document.getElementById("inputProgressIncrement")
const progressesDataTable = document.getElementById("progressesDataTable")

var editedProgress = ""

function initialize() {
    let activity = JSON.parse(sessionStorage.getItem("activity"))
    if (activity == null) goBack()
    activityId = activity.id

    $.ajax({
        type: "GET",
        url: "activity_progresses/" + activityId,
        success: response => {
            let progresses = JSON.parse(response)
            loadProgresses(progresses)
        },
        error: err => {}
    })

    document.getElementById("btnSaveProgress").addEventListener("click", () =>  savePiProgress())
}

function savePiProgress() {
    let date = inputProgressDate.value
    let note = inputProgressNote.value.trim()
    let increment = inputProgressIncrement.value.trim()
    let error = ""
    if (date === "") error += "Enter a valid date. \n"
    if (note === "") error += "Kindly write a note for this progress. \n"
    if (increment === "" || increment == 0) error += "Enter a valid increment"

    if (error != "") {
        // TODO handle error
        return
    }
    $.ajax({
        type: "POST",
        url: "save_activity_progress",
        data: {
            id: editedProgress,
            activity_id: activityId,
            date: date,
            note: note,
            increment: increment
        },
        success: response => {
            let progresses = JSON.parse(response)
            loadProgresses(progresses)
            $('#divProgressModal').modal('hide');
        },
        error: err => {

        }
    })

}

function loadProgresses(progresses) {
    let cumulativeProgress = 0
    progressesDataTable.removeChild(progressesDataTable.querySelector("tbody"))
    let tbody = document.createElement("tbody")
    for(let i = 0; i < progresses.length; i++){
        let progress = progresses[i]
        let row = tbody.insertRow(i)
        
        cumulativeProgress += progress.increment
        row.insertCell(0).appendChild(document.createTextNode(progress.date))
        row.insertCell(1).appendChild(document.createTextNode(progress.note))
        row.insertCell(2).appendChild(document.createTextNode(progress.increment))
        row.insertCell(3).appendChild(document.createTextNode(cumulativeProgress))
        row.insertCell(4).appendChild(document.createTextNode("hello"))
    }
    progressesDataTable.appendChild(tbody)
}

function goBack() {
    window.location.replace("objective")
}

function clearProgressDialog() {
    editedActivity = ""
    document.getElementById("formProgress").reset()
}














initialize()
