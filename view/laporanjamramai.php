<h1 id="judul">Laporan Jam Ramai <?php echo $_POST['tanggal1'] ?> - <?php echo $_POST['tanggal2'] ?></h1>
<table id="table-laporan">
    <tr>
        <th>Tanggal/Jam</th>
        <th>10:00-11:00</th>
        <th>11:00-12:00</th>
        <th>12:00-13:00</th>
        <th>13:00-14:00</th>
        <th>14:00-15:00</th>
        <th>15:00-16:00</th>
        <th>16:00-17:00</th>
        <th>17:00-18:00</th>
        <th>18:00-19:00</th>
        <th>19:00-20:00</th>
        <th>20:00-21:00</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu() . "</td>";
        for ($i = 10; $i <= 20; $i++) {
            if (array_key_exists("$i", $value->jam)) {
                echo "<td>";
                echo $value->jam["$i"]->getTotal();
                echo "</td>";
            } else {
                echo "<td>-</td>";
            }
        }
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>Total</td>";
    foreach ($result2 as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
    echo "<tr>";
    echo "<td>Rata-rata</td>";
    foreach ($result3 as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
    ?>   
</table>

<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>