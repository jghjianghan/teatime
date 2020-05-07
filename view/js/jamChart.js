// new Chart(document.getElementById("line-chart"), {
//     type: 'line',
//     data: {
//         labels: [10.00 - 11.00,
//             11.00 - 12.00,
//             12.00 - 13.00,
//             13.00 - 14.00,
//             14.00 - 15.00,
//             15.00 - 16.00,
//             16.00 - 17.00,
//             17.00 - 18.00,
//             18.00 - 19.00,
//             19.00 - 20.00,
//             20.00 - 21.00
//         ],
//         datasets: [{
//             data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
//             label: "Rata-rata per jam",
//             borderColor: "#3e95cd",
//             fill: false
//         }]
//     },
//     options: {
//         title: {
//             display: true,
//             text: 'Linear Graphic of Popular Hours'
//         }
//     }
// });

$(document).ready(function() {
    showGraph();
});


function showGraph() {
    {
        $.post("manajerController.php",
            function(arr) {
                let mean = [];

                for ($i = 10; $i <= 20; $i++) {
                    if ($i !== '0') {
                        mean.push(arr[i]);
                    } else {
                        mean.push('0');
                    }
                }

                let chartdata = {
                    labels: [10.00 - 11.00,
                        11.00 - 12.00,
                        12.00 - 13.00,
                        13.00 - 14.00,
                        14.00 - 15.00,
                        15.00 - 16.00,
                        16.00 - 17.00,
                        17.00 - 18.00,
                        18.00 - 19.00,
                        19.00 - 20.00,
                        20.00 - 21.00
                    ],
                    datasets: [{
                        label: 'Mean per hour',
                        borderColor: "#3e95cd",
                        fill: false,
                        data: mean
                    }]
                };

                let graphTarget = $("#line-chart");

                let lineGraph = new Chart(graphTarget, {
                    type: 'line',
                    data: chartdata
                });
            });
    }
}