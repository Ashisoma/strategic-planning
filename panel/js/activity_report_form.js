const inputStartDate = document.getElementById('inputStartDate')
const inputEndDate = document.getElementById('inputEndDate')
const inputCompletedTasks = document.getElementById('inputCompletedTasks');
const inputPendingTasks = document.getElementById('inputPendingTasks');
const inputRecommendations = document.getElementById('inputRecommendations');
const inputChallenges = document.getElementById('inputChallenges');
const inputLeadComment = document.getElementById('inputLeadComment');
const userDisplay = document.getElementById("userDisplay");
const selectActivity = document.getElementById("selectActivity")

var myActivities = []
var viewedReportId = ""

function initialize() {
    setWordCount();

    $.ajax({
        type: "GET",
        url: "my_activities",
        success: response => {
            myActivities = JSON.parse(response)
            myActivities.forEach(activity => {
                let option = document.createElement("option");
                option.setAttribute("value", activity.id);
                option.appendChild(document.createTextNode(activity.name));
                selectActivity.appendChild(option)
            })

            if (localStorage.getItem('viewed_report') != null) {
                let report = JSON.parse(localStorage.getItem('viewed_report'))
                inputStartDate.value = report.start_date
                inputEndDate.value = report.end_date
                inputCompletedTasks.value = report.completed_tasks
                inputPendingTasks.value = report.pending_tasks
                inputRecommendations.value = report.recommendations
                inputChallenges.value = report.challenges
                inputLeadComment.value = report.lead_comment
                $(selectActivity).val(report.activity.id)
                //TODO Know if loggedInUser is supervisor abd modify
                window.localStorage.clear();
            }

        }
    })

    selectActivity.addEventListener("change", () => activitySelectChanged())
    document.getElementById('btnSubmit').addEventListener("click", () => saveReport())
}

function setWordCount() {
    // set maximum word count for pending tasks
    var completedtasks_text_max = 250;
    $("#completedtasks_text_count").html("0 / " + completedtasks_text_max);

    $("#inputCompletedTasks").keyup(function () {
        var completedtasks_text_length = $("#inputCompletedTasks").val().length;
        $("#completedtasks_text_count").html(completedtasks_text_length + " / " + completedtasks_text_max);
    });

    // set maximum word count for pending tasks
    var pendingtasks_text_max = 250;
    $("#pendingtasks_text_count").html("0 / " + pendingtasks_text_max);

    $("#inputPendingTasks").keyup(function () {
        var pendingtasks_text_length = $("#inputPendingTasks").val().length;
        $("#pendingtasks_text_count").html(pendingtasks_text_length + " / " + pendingtasks_text_max);
    });

    // set maximum word count for recommendations
    var recommendations_text_max = 250;
    $("#recommendations_text_count").html("0 / " + recommendations_text_max);

    $("#inputRecommendations").keyup(function () {
        var recommendations_text_length = $("#inputRecommendations").val().length;
        $("#recommendations_text_count").html(recommendations_text_length + " / " + recommendations_text_max);
    });

    // set maximum word count for challenges
    var challenges_text_max = 250;
    $("#challenges_text_count").html("0 / " + recommendations_text_max);

    $("#inputRecommendations").keyup(function () {
        var challenges_text_length = $("#inputChallenges").val().length;
        $("#challenges_text_count").html(challenges_text_length + " / " + challenges_text_max);
    });

    // set maximum word count for supervisor comment
    var supervisor_text_max = 500;
    $("#sup_text_count").html("0 / " + supervisor_text_max);

    $("#inputLeadComment").keyup(function () {
        var sup_text_length = $("#inputLeadComment").val().length;
        $("#sup_text_count").html(sup_text_length + " / " + supervisor_text_max);
    });
}

function saveReport() {
    ['activity_id', 'completed_tasks', 'pending_tasks', 'recommendations',
        'lead_comment']
    let activity = selectActivity.options[selectActivity.selectedIndex].value
    let start = inputStartDate.value
    let end = inputEndDate.value
    let completedTasks = inputCompletedTasks.value.trim()
    let pendingTasks = inputPendingTasks.value.trim()
    let recommendations = inputRecommendations.value.trim()
    let challenges = inputChallenges.value.trim()
    let leadComment = inputLeadComment.value.trim()
    let errors = ""
    if (activity === "") errors += "Please select a valid activity \n"
    if (start === "") errors += "Please enter a valid start date \n"
    else if (end === "") errors += "Please enter a valid end date \n"
    else if (Date.UTC(start.substring(0, 4), start.substring(5, 7), start.substring(8)) > Date.UTC(end.substring(0, 4), end.substring(5, 7), end.substring(8))) {
        errors += "start date must be less than the end date"
    }
    if (completedTasks === "") errors += "Enter the tasks completed \n"
    if (errors !== "") {
        //TODO handle error
        return
    }
    $.ajax({
        type: "POST",
        url: "save_activity_report",
        data: {
            activity_id: activity,
            completed_tasks: completedTasks,
            pending_tasks: pendingTasks,
            recommendations: recommendations,
            challenges: challenges,
            lead_comment: leadComment,
            start_date: start,
            end_date: end,
        },
        success: response => {
            document.getElementById("formPiReport").reset()
            viewedReportId = ""
        },
        error: err => {
            //TODO Handle error
        }
    })


}

function activitySelectChanged() {
    let selected = selectActivity.options[selectActivity.selectedIndex].value
    myActivities.forEach(activity => {
        if (activity.id == selected){
            inputStartDate.value = activity.expected_start_date
            inputEndDate.value = activity.due_date
        }
    })
}



initialize();
