<?php
	require_once "backend/dbconnect.php";
	require_once "backend/session.php";

	/*Get User Id*/
	/*$_SESSION['id']=1;*/
	// $user=$_SESSION['id'];
  $user = $_SESSION['user_id'];

	/* Line Graph */
	$query=$link->query("
		SELECT monthname(due_date)as monthname,count(goal_id) as number FROM `goal` 
		WHERE user_id=$user AND completion_status='100'
		GROUP BY monthname
		ORDER BY due_date;
		");

	foreach($query as $data)
	{
		$month[]=$data['monthname'];
		$num_of_ach[]=$data['number'];
	}

	/* Doughnut */
	$query2=$link->query("
			SELECT category,count(category) as ratio FROM `goal` 
			WHERE user_id=$user
			GROUP BY category;
		");

	foreach($query2 as $data)
	{
		$category[]=$data['category'];
		$ratio[]=$data['ratio'];
	}

	/* Completed goal */
	$query3=$link->query("
		SELECT count(completion_status) as completed FROM `goal` 
		WHERE user_id=$user AND completion_status=100;
	");

	/* In Progress goal */
	$query4=$link->query("
		SELECT count(completion_status) as inProgress FROM `goal` 
		WHERE user_id=$user AND completion_status BETWEEN 1 AND 99;
	");

	/* To-Do goal */
	$query5=$link->query("
		SELECT count(completion_status) as todo FROM `goal` 
		WHERE user_id=$user AND completion_status=0;
	");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./stylesheets/progressbar.css">
    <link rel="stylesheet" href="./stylesheets/notif.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets\chart.css" >
    <!-- Font Import -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="javascript" type="text/js" href="javascript\chart.js">

    <title>GoalMou Report</title>
  </head>

  <body background="images\plant1.jpg">
    <!-- Header Include -->
		<?php
        include_once './header.php';
      ?>
    <div class="card-list">
      <div class="row">
          <div class="col-md-12 grid-margin">
              <div class="card">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-4 col-sm-6 col-12">
                              <div class="card" style="background-color: #B7E9FB;">
                              <div class="card-body text-center">
                                  <h5 class="card-title">Completed!</h5>
                                  <h1 class="card-text"><?php if ($query3->num_rows > 0) {
																while($row = $query3->fetch_assoc()) {
																	echo "" . $row["completed"]. "<br>";
																	}
																} else {
																	echo "0 results";
																	}; ?></h1>
                                  <p>WooooooooHoooooooooooo you're on a roll!</p>
                              </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6 col-12">
                              <div class="card" style="background-color: #bfb6fa;">
                              <div class="card-body text-center">
                                  <h5 class="card-title">In Progress</h5>
                                  <h1 class="card-text"><?php if ($query4->num_rows > 0) {
																while($row = $query4->fetch_assoc()) {
																	echo "" . $row["inProgress"]. "<br>";
																	}
																} else {
																	echo "0 results";
																	}; ?></h1>
                                  <p >You're doing so well so don't fall behind :D</p>
                              </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6 col-12">
                              <div class="card" style="background-color: #7180B9;">
                                  <div class="card-body text-center">
                                  <h5 class="card-title">To-Do</h5>
                                  <h1 class="card-text"><?php if ($query5->num_rows > 0) {
																while($row = $query5->fetch_assoc()) {
																	echo "" . $row["todo"]. "<br>";
																	}
																} else {
																	echo "0 results";
																	}; ?></h1>
                                  <p >Get off your lazy ass :p</p>
                                  </div>
                              </div>
                              </div>
                          </div>         
                  </div>
              </div>
          </div>
        </div>
    </div>

    <div class="chart-list">
      <div class="row justify-content-around">
          <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Completed Goals per Month</h4>
                  <canvas id="myChart" width="10" height="6"></canvas>
                  <div id="myChart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
              </div>
          </div>
          <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Goal Category Ratio</h4>
                  <canvas id="myChart2" width="10" height="6"></canvas>
                  <div id="myChart2-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
              </div>
          </div>
        </div>
    </div>

    <!-- <div class="row justify-content-start">
      <div class="col-md-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Goal Ratio</h4>
              <canvas id="myChart2" width="10" height="2"></canvas>
              <div id="myChart2-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
            </div>
          </div>
      </div>
    </div> -->

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
            const data1 = {
                labels: <?php echo json_encode($month)?>,
                datasets: [{
                    label: 'Accomplised Goals per Month',
                    data: <?php echo json_encode($num_of_ach)?>,
                    fill: false,
                borderColor: 'rgb(104, 110, 149, 0.8)',
                tension: 0.1
            }]
        }
        const myChart = new Chart(ctx, {
            type: 'line',
            data: data1,
            options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        });
    </script>
    <script>
        const pieChart = document.getElementById('myChart2').getContext('2d');
            const data2 = {
                labels: <?php echo json_encode($category)?>,
                datasets: [{
                    label: 'Ratio of Goals',
                    data: <?php echo json_encode($ratio)?>,
                    fill: false,
                    backgroundColor: [  'rgb(255, 159, 28)',
                                        'rgb(255, 191, 105)',
                                        'rgb(249, 132, 74)',
                                        'rgb(240, 243, 189)',
                                        'rgb(203, 243, 240)',
                                        'rgb(46, 196, 182)'],                        
                    hoverOffset: 4
                        }]
                    }
        const myChart2 = new Chart(pieChart, {
            type: 'doughnut',
            data: data2,
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./javascript/progressbar.js"></script>
  </body>
</html>
