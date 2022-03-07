const popupTable = document.getElementById("popupTable")

const completedStatusDiv = "<div class=\"badge badge-success badge-pill p-2\">Completed</div>"
const ongoingStatusDiv = "<div class=\"badge badge-primary badge-pill p-2\">Ongoing</div>"
const notStartedStatusDiv = "<div class=\"badge badge-warning badge-pill p-2\">Not Started</div>"
const overdueStatusDiv = "<div class=\"badge badge-danger badge-pill p-2\">Ongoing</div>"
const ulGoals = document.getElementById('ulGoals')
const divNotStarted = document.getElementById('divNotStarted')
const divDelayedCompletion = document.getElementById('divDelayedCompletion')
const ulDelayedCompletion = document.getElementById('ulDelayedCompletion')
const ulNotStarted = document.getElementById('ulNotStarted')

var allObjectives = []
var chartObjectives = null

//fill and stroke
const notStartedColors = ["#C6C6C6", "#ADADAD"]
const ongoingColors = ["#FFD700", "#FFFF99"]
const completedColors = ["#32CD32", "#32CD32"]
const overdueColors = ["#FA8072", "#DC143C"]

var ganttChart = null;

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
    console.log(loggedInUser);

    $('.date-own').datepicker({
        minViewMode: 2,
        format: 'yyyy'
    })
        .on("change", function () {
            console.log("Got change event from field" + this.value);
            selectYearChanged(this.value)
        });
}
function loadGoals(goals) {
    removeAllChildNodes(ulGoals)

    let allGoalsLi = document.createElement("li")
    allGoalsLi.classList.add("nav-item")
    let allGoalsA = document.createElement("a")
    allGoalsA.classList.add("nav-link")
    allGoalsA.setAttribute("href", "#")
    allGoalsA.appendChild(document.createTextNode("All Goals"))
    allGoalsLi.appendChild(allGoalsA)
    let allObjectives = [];

    for (let i = 0; i < goals.length; i++) {
        let goal = goals[i]
        //Get all objectives
        //For each objective set min date as min date for activities within and max date as max date for activities within
        //create similar data as on for gannt
        /****************************************************************
         * Calculation of progress.
         * 
         * 
         * Things to consider: progress and weight.
         * if not started ? no progresses the default value is zero
         * 
         */

        let goalLi = document.createElement("li")
        goalLi.classList.add("nav-item")
        let goalA = document.createElement("a")
        goalA.classList.add("nav-link")
        if (i === 0) {
            goalA.classList.add("active")
            loadObjectives(goal.objectives)
        }
        goalA.setAttribute("href", "#")
        goalA.appendChild(document.createTextNode(goal.name))
        goalLi.appendChild(goalA)
        goalLi.addEventListener("click", e => {
            e.preventDefault()
            let items = ulGoals.querySelectorAll('li')
            for (let j = 0; j < items.length; j++) {
                let item = items[j]
                item.querySelector('a').classList.remove('active')
            }
            goalLi.querySelector('a').classList.add("active")
            loadObjectives(goal.objectives)
        })
        ulGoals.appendChild(goalLi)
        goal.objectives.forEach(objective => {
            allObjectives.push(objective)
        })
    }
    allGoalsLi.addEventListener("click", e => {
        e.preventDefault()
        let items = ulGoals.querySelectorAll('li')
        for (let j = 0; j < items.length; j++) {
            let item = items[j]
            item.querySelector('a').classList.remove('active')
        }
        allGoalsLi.querySelector('a').classList.add("active")
        loadObjectives(allObjectives)
    })
    ulGoals.appendChild(allGoalsLi)
}

function loadObjectives(objectives) {
    let chartData = []
    let labels = []
    let datasetData = []
    let currentActivities = []
    objectives.forEach(objective => {
        let totalWeight = 0;
        let minObjectiveDate = Date.now()
        let maxObjectiveDate = Date.now()
        let objectiveChartData = {
            id: objective.id,
            name: objective.name,
            progressValue: "75%",
            category: "Objective",
            status: "",
            actual: {
                fill: "#E0FFFF", stroke: "1 #E0FFFF"
            },
            lead: objective.leadname
        }
        let objectiveTotal = 0
        let objectiveProgress = 0;
        let activities = objective.activities
        let activitiesChartData = []
        activities.forEach(activity => {
            currentActivities.push(activity)
            let start = activity.expected_start_date.split('-')
            let end = activity.due_date.split('-')
            let activityStart = Date.UTC(Number(start[0]), Number(start[1]) - 1, Number(start[2]))
            let activityEnd = Date.UTC(Number(end[0]), Number(end[1]) - 1, Number(end[2]))
            minObjectiveDate = (minObjectiveDate > activityStart) ? activityStart : minObjectiveDate
            maxObjectiveDate = (maxObjectiveDate < activityEnd) ? activityEnd : maxObjectiveDate
            let colors = notStartedColors
            objectiveTotal += activity.weight
            // let progress = '50%'
            if (activity.status === "Ongoing") {
                objectiveProgress = '50%'
                colors = ongoingColors
                progress = '50%'
                if (Date.now() > activityEnd) colors = overdueColors
            } else if (activity.status === "Not Started") {
                // objectiveProgress = '0%'
                colors = notStartedColors
                objectiveProgress += activity.weight
                progress = '0%'
                if (Date.now() > activityStart) colors = overdueColors
            } else if (activity.status === "Completed") {
                colors = completedColors
                objectiveProgress += activity.weight
                progress = '100%'
            }
            console.log(progress);
            let data = {
                id: activity.id,
                name: activity.name,
                actualStart: activityStart,
                actualEnd: activityEnd,
                category: "Activity",
                status: activity.status === "" ? "Not Started" : activity.status,
                actual: {
                    fill: colors[0], stroke: "0.5 " + colors[1]
                },
                progressValue: progress,
                progress: {
                    fill: colors[0], stroke: "0.5 " + colors[1]
                },
                lead: activity.personResponsible.name
            }
            activitiesChartData.push(data)
        })
        activitiesAlerts(currentActivities)
        console.log(objectiveTotal);
        objectiveChartData.children = activitiesChartData
        objectiveChartData.actualStart = minObjectiveDate
        objectiveChartData.actualEnd = maxObjectiveDate
        objectiveChartData.progressValue = (objectiveTotal === 0 ? 0 : ((objectiveProgress / objectiveTotal)))
        chartData.push(objectiveChartData)

        labels.push(objective.name)
        datasetData.push(objectiveTotal === 0 ? 0 : ((objectiveProgress / objectiveTotal) * 100).toFixed(2))

        allObjectives.push(objective)
    })

    createGanttAnyChart(chartData)

    console.log(labels);
    let chartData0 = {
        labels: labels,
        datasetData: datasetData,
    }
    // drawObjectivesChart(chartData0)
}

function activitiesAlerts(activities) {
    let currentDate = new Date();
    // let delayedAlerts = divDelayedCompletion.querySelectorAll('.activity_alert')
    // for (let i = 0; i < delayedAlerts.length; i++) {
    //     divDelayedCompletion.removeChild(delayedAlerts[i])
    // }
    // let notStartedAlerts = divNotStarted.querySelectorAll('.activity_alert')
    // for (let i = 0; i < notStartedAlerts.length; i++) {
    //     divNotStarted.removeChild(notStartedAlerts[i])
    // }
    removeAllChildNodes(ulDelayedCompletion)
    removeAllChildNodes(ulNotStarted)
    activities.forEach(activity => {
        let expectedStart = new Date(activity.expected_start_date)
        let dueDate = new Date(activity.due_date)
        let dateStarted = activity.date_started
        let dateCompleted = activity.date_completed
        if (currentDate > expectedStart && activity.status === 'Not Started') {
            console.log("Status One" +activity.description );
            let listItem = document.createElement('li');
            let alert = document.createElement('a')
            alert.setAttribute("id", "linkA_"+activity.id)
            alert.classList.add("dropdown-item", "d-flex", "align-items-center")
            let alertDiv = document.createElement("div")
            alertDiv.classList.add("activity_alert")
            let descriptionDiv = document.createElement("div")
            descriptionDiv.classList.add("text-truncate")
            descriptionDiv.appendChild(document.createTextNode(activity.description))
            let smallDiv = document.createElement("div")
            smallDiv.classList.add("small", "text-gray-500")
            smallDiv.appendChild(document.createTextNode(activity.personResponsible.name + ' : ' + DateFormatter.formatDate(new Date(activity.expected_start_date), 'DD MMM YYYY') + ' - ' + DateFormatter.formatDate(new Date(activity.due_date), 'DD MMM YYYY')))
            alertDiv.appendChild(descriptionDiv)
            alertDiv.appendChild(smallDiv)
            // divNotStarted.appendChild(alertDiv)
            listItem.appendChild(alertDiv)
            ulNotStarted.appendChild(listItem)
            // alert.appendChild(alertDiv)
        }else if (currentDate > dueDate && activity.status !== "Completed") {
            console.log("Status Two" + activity.description);
            let listItem = document.createElement('li');
            let alert = document.createElement('a')
            alert.setAttribute("id", "linkA_"+activity.id)
            alert.classList.add("dropdown-item", "d-flex", "align-items-center")
            let alertDiv = document.createElement("div")
            alertDiv.classList.add("activity_alert")
            let descriptionDiv = document.createElement("div")
            descriptionDiv.classList.add("text-truncate")
            descriptionDiv.innerText = activity.description
            let smallDiv = document.createElement("div")
            smallDiv.classList.add("small", "text-gray-500")
            smallDiv.innerText = activity.personResponsible.name + ' : ' + DateFormatter.formatDate(new Date(activity.expected_start_date), 'DD MMM YYYY') + ' - ' + DateFormatter.formatDate(new Date(activity.due_date), 'DD MMM YYYY')
            alertDiv.append(descriptionDiv, smallDiv)
            // divNotStarted.appendChild(alertDiv)
            listItem.appendChild(alertDiv)
            ulDelayedCompletion.appendChild(listItem)
            // return abc
            // alert.appendChild(alertDiv)
        }
        
    })
    let delayedActivities = divDelayedCompletion.querySelectorAll('.activity_alert')
    let notStartedActivities = divNotStarted.querySelectorAll('.activity_alert')
    document.getElementById("spanDelayed").innerText = delayedActivities.length
    document.getElementById("spanNotStarted").innerText = notStartedActivities.length
}

function selectYearChanged(yearText) {
    if (ganttChart != null) {
        ganttChart.zoomTo(Date.UTC(yearText, 0, 1), Date.UTC(yearText, 11, 31))
    }
}

var chartColors = {
    success: 'rgb(0, 172, 105)',
    danger: 'rgb(232, 21, 0)',
    primary: 'rgb(0, 207, 213)',
    warning: 'rgb(244, 161, 0)'

};

function setBgColor(chart) {
    let dataset = chart.data.datasets[0];
    for (let i = 0; i < dataset.data.length; i++) {
        if (dataset.data[i] > 80) {
            dataset.backgroundColor[i] = chartColors.success;
        } else if (dataset.data[i] > 50) {
            dataset.backgroundColor[i] = "#00cfd5";
        } else if (dataset.data[i] > 20) {
            dataset.backgroundColor[i] = "#f4a100";
        } else {
            dataset.backgroundColor[i] = "#e81500";
        }
    }
    chart.update();
}

function createGanttAnyChart(chartData) {
    // console.log(chartData)
    removeAllChildNodes(document.getElementById("ganttContainer"))
    // create data{sample data}
    var data = [{
        id: "1",
        name: "Objective 1",
        actualStart: Date.UTC(2020, 1, 2),
        actualEnd: Date.UTC(2023, 6, 15),
        children: [{
            id: "1_1",
            name: "Activity 1",
            actualStart: Date.UTC(2020, 1, 2),
            actualEnd: Date.UTC(2021, 1, 22),
            // connectTo: "1_2",
            connectorType: "finish-start",
            progressValue: "75%"
        },
        {
            id: "1_2",
            name: "Activity 2",
            actualStart: Date.UTC(2020, 1, 23),
            actualEnd: Date.UTC(2020, 2, 20),
            // connectTo: "1_3",
            connectorType: "start-start",
            progressValue: "60%"
        },
        {
            id: "1_3",
            name: "Activity 3",
            actualStart: Date.UTC(2020, 2, 23),
            actualEnd: Date.UTC(2020, 2, 23),
            // connectTo: "1_4",
            connectorType: "start-start",
            progressValue: "80%"
        },
        {
            id: "1_4",
            name: "Activity 4",
            actualStart: Date.UTC(2020, 2, 26),
            actualEnd: Date.UTC(2020, 4, 26),
            // connectTo: "1_5",
            connectorType: "finish-finish",
            progressValue: "90%"
        },
        {
            id: "1_5",
            name: "Activity 5",
            actualStart: Date.UTC(2020, 4, 29),
            actualEnd: Date.UTC(2020, 5, 15),
            // connectTo: "1_6",
            connectorType: "start-finish",
            progressValue: "60%"
        },
        {
            id: "1_6",
            name: "Activity 6",
            actualStart: Date.UTC(2020, 5, 20),
            actualEnd: Date.UTC(2020, 5, 27),
            // connectTo: "1_7",
            connectorType: "start-finish",
            progressValue: "100%"
        },
        {
            id: "1_7",
            name: "Activity 7",
            actualStart: Date.UTC(2020, 5, 30),
            actualEnd: Date.UTC(2020, 6, 11),
            progressValue: "40%"
        },

        ]
    }];
    var treeData = anychart.data.tree(chartData, "as-tree");
    // create a chart
    ganttChart = anychart.ganttProject();
    // set the data
    ganttChart.data(treeData);
    //set height
    ganttChart.height('100%')
    ganttChart.splitterPosition(213);
    //set title
    ganttChart.title('Objectives Gantt Chart')

    let dataGrid = ganttChart.dataGrid()
    dataGrid.column(1).width(80).title('Objective Name')

    // set chart row's height
    ganttChart.defaultRowHeight(30);
    ganttChart.rowSelectedFill("#006699 0.3");
    // configure the scale
    // chart.getTimeline().scale().maximum(Date.UTC(2020, 06, 30));
    // set the container id
    ganttChart.container("ganttContainer");
    ganttChart.dataGrid().tooltip(false);
    var timeline = ganttChart.getTimeline();
    timeline.rowHoverFill("#ffd54f 0.3");
    // timeline.rowSelectedFill("#ffd54f 0.3");
    timeline.columnStroke(null);
    timeline.tooltip().useHtml(true);
    timeline.tooltip().format(
        "<span style='font-weight:600;font-size:12pt'>" +
        "{%actualStart}{dateTimeFormat:dd MMM yyyy} - " +
        "{%actualEnd}{dateTimeFormat:dd MMM yyyy}</span><br><br>" +
        "Status: {%status}<br>" +
        "Progress: {%progress}<br>" +
        "Person Responsible: {%lead}"
    );
    timeline.tasks().background = "white"
    // timeline.elements().fill('#5A3DAD')
    console.dir(timeline.elements());
    ganttChart.listen("rowDblClick", e => {
        e.preventDefault();
        if (e.item.get('category') === "Objective") {
            popUpObjective(e.item.get("id"));
        }
    })


    // initiate drawing the chart
    ganttChart.draw();


    //zooming feature
    var zoomingCoef = 1;
    var isPreviousNegative = true;

    //mouse wheel listener
    $("#ganttContainer").on('wheel', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        //define the zoomingCoef
        if (e.originalEvent.deltaY > 0 ^ isPreviousNegative) {
            zoomingCoef -= e.originalEvent.deltaY / 10;
        } else {
            zoomingCoef = 1;
        }

        //zoomIn or zoomOut
        if (e.originalEvent.deltaY < 0) {
            ganttChart.zoomIn(zoomingCoef);
            isPreviousNegative = true;
        } else {
            ganttChart.zoomOut(zoomingCoef);
            isPreviousNegative = false;
        }
    })

    // fit elements to the width of the timeline
    ganttChart.fitAll();

}

function drawObjectivesChart(chartData) {
    // console.log(chartData);
    if (chartObjectives === null) {
        chartObjectives = new Chart(document.getElementById("chartObjectives"), {
            "type": "horizontalBar",
            "data": {
                "labels": ["Objective #1", "Objective #2", "Objective #3", "Objective #4"],
                "datasets": [{
                    "label": "Objective Progress (%)",
                    "data": [30, 100, 58, 80],
                    "fill": false,
                    backgroundColor: '#0724ab',
                    borderColor: '#3895D3'

                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "Percentage",
                        },
                        ticks: {
                            beginAtZero: true,
                            max: 100
                        }
                    }]
                },
                animation: {
                    duration: 1,
                    onComplete: function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        this.data.datasets.forEach(function (dataset, i) {
                            let meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                let data = dataset.data[index]
                                if (meta.hidden) ctx.fillText("", 0, 0)
                                else ctx.fillText(data, bar._model.x + 15, bar._model.y + 7)
                            });

                        });
                    }
                },
            }
        });
    }
    chartObjectives.data.labels = chartData.labels
    //chartObjectives.data.datasets[0].backgroundColor = chartData.datasetBackgroundColor
    chartObjectives.data.datasets[0].data = chartData.datasetData
    chartObjectives.update()
}

function popUpObjective(id) {
    allObjectives.forEach(objective => {
        if (objective.id === id) {
            //get the table
            //reload tbody
            //show modal
            document.getElementById('popupHeader').innerText = "Objective: " + objective.description;
            popupTable.removeChild(popupTable.querySelector('tbody'))
            let tbody = document.createElement('tbody')
            let activities = objective.activities
            let i = 0
            activities.forEach(activity => {
                let row = tbody.insertRow(i)
                row.insertCell(0).appendChild(document.createTextNode(activity.description))
                row.insertCell(1).appendChild(document.createTextNode(activity.personResponsible.name))
                row.insertCell(2).appendChild(document.createTextNode(DateFormatter.formatDate(new Date(activity.expected_start_date), 'DD MMM YYYY') + ' - ' + DateFormatter.formatDate(new Date(activity.due_date), 'DD MMM YYYY')))
                row.insertCell(3).appendChild(document.createTextNode(activity.weight))
                let activityStatus = ""
                switch (activity.status) {
                    case "Completed":
                        activityStatus = completedStatusDiv
                        break;
                    case "Ongoing":
                        activityStatus = ongoingStatusDiv
                        break;
                    case "Not Started":
                        activityStatus = notStartedStatusDiv
                        break;
                    default:
                        activityStatus = notStartedStatusDiv
                        break;
                }
                row.insertCell(4).innerHTML = activityStatus
                row.insertCell(5).appendChild(document.createTextNode(activity.completion_note))

                i++
            })
            popupTable.appendChild(tbody)
            console.log('here');
            $('#divPopupModal').modal({ show: true })
        }
    })
}

initialize()
