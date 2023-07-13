<?php

$date = $_POST["date"];

if (!isset($date)) {
  $date = "";
}

$chart_type = $_POST["chart_type"];

if (!isset($chart_type)) {
  $chart_type = "bar";
}

$food_wastage = predict_food_wastage($date);

$food_items = array_keys($food_wastage);
$wastage_amounts = array_values($food_wastage);

if ($chart_type == "bar") {
  echo create_bar_chart($food_items, $wastage_amounts);
} else if ($chart_type == "pie") {
  echo create_pie_chart($food_items, $wastage_amounts);
}

function predict_food_wastage($date) {
  $food_wastage = array();

  $csv_file = "food-data.csv";

  $fp = fopen($csv_file, "r");

  while ($row = fgetcsv($fp)) {
    if ($row[0] == $date) {
      $food_wastage[$row[4]] = $row[5];
    }
  }

  fclose($fp);

  return $food_wastage;
}

function create_bar_chart($food_items, $wastage_amounts) {
  $chart = "<html><body><canvas id='myChart' width='400' height='400'></canvas></body></html>";

  $script = "<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: $food_items,
        datasets: [{
          data: $wastage_amounts,
          backgroundColor: ['#FF0000', '#00FF00', '#0000FF']
        }]
      },
      options: {
        title: 'Food Waste'
      }
    });
  </script>";

  return $chart . $script;
}

function create_pie_chart($food_items, $wastage_amounts) {
  $chart = "<html><body><canvas id='myChart' width='400' height='400'></canvas></body></html>";

  $script = "<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: $food_items,
        datasets: [{
          data: $wastage_amounts,
          backgroundColor: ['#FF0000', '#00FF00', '#0000FF']
        }]
      },
      options: {
        title: 'Food Waste'
      }
    });
  </script>";

  return $chart . $script;
}

?>
