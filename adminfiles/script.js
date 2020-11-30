google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var active = parseInt(document.getElementById("unblockuser").value);
    var block = parseInt(document.getElementById("blockuser").value);
    var data = google.visualization.arrayToDataTable([
        ['USERS', 'TYPE'],
        ['ACTIVEUSER', active],
        ['BLOCKEDUSER', block],
    ]);

    var options = { 'title': 'USER DATA', 'width': 550, 'height': 300 };


    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(ride);

function ride() {
    var cancelled = parseInt(document.getElementById("cancelled").value);
    var completed = parseInt(document.getElementById("completed").value);
    var pending = parseInt(document.getElementById("pending").value);
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['CANCELLED RIDES', cancelled],
        ['COMPLETED RIDES', completed],
        ['PENDING RIDES', pending]
    ]);

    var options = { 'title': 'RIDE DATA', 'width': 500, 'height': 300 };


    var chart = new google.visualization.PieChart(document.getElementById('RIDERS'));
    chart.draw(data, options);
}