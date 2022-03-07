const reportsDataTable = document.getElementById('reportsDataTable')


function initialize(){
    $.ajax({
        type: 'GET',
        url: "activities_reports",
        success: response => {
            let reports = JSON.parse(response)
            loadReports(reports)
        },
        error: error => {

        }
    })
    document.getElementById("btnReportExcel").addEventListener("click", ()=>generateExcelReport())
}

function loadReports(reports){
    reportsDataTable.removeChild(reportsDataTable.querySelector('tbody'))
    let tbody = document.createElement('tbody')
    let i = 0
    reports.forEach(report => {
        let row = tbody.insertRow(i)
        row.insertCell(0).appendChild(document.createTextNode(report.user.name))
        row.insertCell(1).appendChild(document.createTextNode(report.activity.name))
        row.insertCell(2).appendChild(document.createTextNode(DateFormatter.formatDate(new Date(report.start_date), 'DD MMM YYYY') + " - " + DateFormatter.formatDate(new Date(report.end_date), 'DD MMM YYYY')))
        row.insertCell(3).appendChild(document.createTextNode(""))

        let viewButton = document.createElement("button")
        viewButton.classList.add("btn")
        viewButton.classList.add("btn-datatable")
        viewButton.classList.add("btn-icon")
        viewButton.classList.add("btn-transparent-dark")
        viewButton.classList.add("mr-2")
        viewButton.classList.add("ml-2")
        viewButton.setAttribute("data-tooltip", "tooltip");
        viewButton.setAttribute("data-placement", "bottom");
        viewButton.setAttribute("title", "View this report");
        viewButton.innerHTML = "<i data-feather=\"more-vertical\" class=\"fas fa-eye\"></i>"
        viewButton.addEventListener("click", () =>{
            localStorage.setItem("viewed_report", JSON.stringify(report))
            window.location.replace("activity_report_form")
        })

        row.insertCell(4).appendChild(viewButton)
        i++
    })
    reportsDataTable.appendChild(tbody)
}

function generateExcelReport(){
    window.open('./../reports_activity_report')
}








initialize()
