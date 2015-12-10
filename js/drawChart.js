var data = jQuery.parseJSON('<?php echo json_encode($toPass) ?>');
//alert(data.Bad);
var labels = [];
var values = [];
for(var k in data) {
	labels.push(k);
	if (data.hasOwnProperty(k)) {
		values.push(data[k]);
		alert(data[k]);
	}
}

var dataFin = {
    labels: labels,
    datasets: [
        {
            label: "DataSet",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: values
        }
    ]
};
		var ctx = document.getElementById("myChart").getContext("2d");
		var myLineChart = new Chart(ctx).Line(dataFin, { bezierCurve: false });
