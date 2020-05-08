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


function showGraph() {
    let mean = [];
    
    console.log(meanData);
    for (let i = 10; i <= 20; i++) {
        mean.push(meanData[i]);
    }

    let chartdata = {
        labels: [
            "10.00 - 11.00",
            "11.00 - 12.00",
            "12.00 - 13.00",
            "13.00 - 14.00",
            "14.00 - 15.00",
            "15.00 - 16.00",
            "16.00 - 17.00",
            "17.00 - 18.00",
            "18.00 - 19.00",
            "19.00 - 20.00",
            "20.00 - 21.00"
        ],
        datasets: [{
            label: 'Mean per hour',
            borderColor: "#3e95cd",
            fill: false,
            data: mean
        }]
    };

    let graphTarget = document.querySelector("#line-chart");

    let lineGraph = new Chart(graphTarget, {
        type: 'line',
        data: chartdata
    });
}


showGraph();