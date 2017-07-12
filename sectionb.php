<?php 


   $hn = 'localhost'; //hostname
    $db = 'yussufa_pbl'; //database
    $un = 'yussufa_pbl'; //username
   $pw = 'mypassword'; //password

 $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);
  
$query = "SELECT category ,COUNT(*) as cnt FROM classics GROUP BY category;";
$result = $conn->query($query);
?>
<!DOCTYPE html>

<html>
<head>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['classics', 'category'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['category']."', ".$row['cnt']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        title: 'Percentage of publications',
        width: 800,
        height: 400,
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}
</script>
</head>
<body>
    <!-- Display the pie chart -->
    <div id="piechart"></div>
</body>
</html>