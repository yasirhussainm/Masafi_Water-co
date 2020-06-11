<?php
session_start();
require_once "pdo.php";
$stmt = $pdo->query("SELECT name,Sum(added) as sales from transactions join pass_driver where
                            pass_driver.driver_id = transactions.driver_id group by transactions.driver_id");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 ?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Driver', 'Sales']
          <?php foreach ($rows as $row) {
            echo(',[\''.$row['name'].'\','.$row['sales'].']');
          }
          ?>
        ]);

        var options = {
          title: 'Sales Of Drivers',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
    <p><a href="admin_portal.php">Go Back</a></p>
  </body>
</html>
