<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 include '../menu.php';
 ?>

<div class="content-wrapper">
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">Dashboard</h1>
    </div>

<div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="#">Home</a></li>
  <li class="breadcrumb-item active">Dashboard </li>
 </ol>
</div>
  </div>
 </div>
</div>

<section class="content">
 <div class="container-fluid">
  <div class="row">

<div class="col-lg-3 col-6 offset-lg-0">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
       $result = $dbConn->query ("select round(((SELECT count(1) FROM det_agreement 
where status='Active')/
(select count(1) from det_property where status = 'Active'))* 100,2) as perc from dual");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>'.$row.'%</h1>';
      ?>

                <p><a href="#" onclick="occupancywindow()">Occupency</a></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="occupancywindow()">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

   <div class="col-lg-3 col-6">
    <div class="small-box bg-warning" >
     <div class="inner">
     <?php
       $result = $dbConn->query ("SELECT count(agreement_to) FROM det_agreement 
Where agreement_to between now() and date_add(now() , interval 3 month)");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>'.$row.'</h1>';
      ?>
    <p><a href="#" onclick="openwindow()">Expiry Within 3 Months</a></p>
      </div>
    <div class="icon">
     <i class="fa fa-clock-o" aria-hidden="true"></i>
     
    </div>
    <a href="#" class="small-box-footer" onclick="openwindow()">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
    </div>

<div class="col-lg-3 col-6">
 <div class="small-box bg-danger">
  <div class="inner">
    <?php
       $result = $dbConn->query ("SELECT count(1) FROM det_rent where rent_status <> 'PAID'");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>'.$row.'</h1>';
      ?>
    <p><a href="#" onclick="rentwindow()">Rent Defaults</a></p>
   </div>
<div class="icon">
 <i class="fa fa-calendar" aria-hidden="true"></i>
</div>
 <a href="#" class="small-box-footer" onclick="rentwindow()">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
   </div>


<div class="col-lg-3 col-6">
 <div class="small-box bg-info">
  <div class="inner">
     <?php
       $result = $dbConn->query ("SELECT count(*)  FROM det_property 
WHERE property_id NOT IN (SELECT property_id FROM det_agreement) and status = 'Active'");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>  '.$row.'</h1>';
      ?>
    <p><a href="#" onclick="vaccantnwindow()">Vaccant Property</a></p>
   </div>
<div class="icon">
 <i  class="fa fa-home" aria-hidden="true"></i>
</div>
  <a href="#" class="small-box-footer" onclick="vaccantnwindow()">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
    </div>

     </div>

<div class="row">

<div class="col-12 col-sm-6 col-md-3 offset-lg-0">
  <div class="info-box">
   <span class="info-box-icon bg-success elevation-1"><i class="fa fa-building-o" aria-hidden="true"></i></span>
    <div class="info-box-content">
     <span class="info-box-text">Total Property</span>
 <?php
       $result = $dbConn->query ("SELECT count(1)  FROM det_property WHERE status='Active' ");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>  '.$row.'</h1>';
      ?>   </div>
  </div>
 </div>

<div class="col-12 col-sm-6 col-md-3">
 <div class="info-box mb-3">
  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users" aria-hidden="true"></i></span>
   <div class="info-box-content">
    <span class="info-box-text">Total Tenant</span>
 <?php
       $result = $dbConn->query ("SELECT count(1)  FROM det_tenant where status = 'Active'");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>  '.$row.'</h1>';
      ?>   </div>
  </div>
 </div>

<div class="col-12 col-sm-6 col-md-3">
 <div class="info-box mb-3">
  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-building" aria-hidden="true"></i></span>
   <div class="info-box-content">
    <span class="info-box-text">Sold Property</span>
 <?php
       $result = $dbConn->query ("SELECT count(1)  FROM det_property WHERE status='InActive' ");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>  '.$row.'</h1>';
      ?>   </div>
  </div>
  </div>

<div class="col-12 col-sm-6 col-md-3">
  <div class="info-box">
   <span class="info-box-icon bg-info elevation-1"><i class="fa fa-file" aria-hidden="true"></i></span>
    <div class="info-box-content">
     <span class="info-box-text">Total Agreement</span>
 <?php
       $result = $dbConn->query ("SELECT count(1)  FROM det_agreement WHERE status='Active'");
       $result->execute();
       $row =$result->fetchColumn();
       echo '<h1>  '.$row.'</h1>';
      ?>   </div>
  </div>
 </div>

  
 </div>




        <div class="row">
          <section class="col-lg-12 connectedSortable">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Oustanding Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    
                    <th>Property</th>
                    <th>Tenant</th>
                    <th>Period (in Months)</th>
                    <th>Total Rent (Rs.)</th>
                    <th>Outstanding</th>
                  </tr>
                  </thead>
                  <tbody>

<?php 
  $result = $dbConn->query("select tenant_name, property_name, CONCAT(TIMESTAMPDIFF(YEAR, agreement_from,agreement_to), ' Yrs, ',
TIMESTAMPDIFF(MONTH, agreement_from, agreement_to)%12, ' Months, ',
TIMESTAMPDIFF(DAY, (agreement_from + INTERVAL TIMESTAMPDIFF(YEAR, agreement_from, 
agreement_to) YEAR
+ INTERVAL TIMESTAMPDIFF(MONTH, agreement_from, agreement_to)%12 MONTH), agreement_to), ' 
Days') AS period,  rent_per_month, invoice_amount, invoice_amount-total_amount_paid as outstanding
from (SELECT p.property_name, t.tenant_name, a.rent_per_month, r.total_amount as invoice_amount, 
a.agreement_from, a.agreement_to,
nvl((select sum(rd.amount_paid) from det_rent_details rd 
where rd.rent_id = r.rent_id group by rd.rent_id),0) as total_amount_paid  
FROM det_rent r, det_agreement a, det_property p, det_tenant t 
where a.tenant_id = t.tenant_id and a.property_id = p.property_id 
and a.agreement_id = r.agreement_id) a");

//  $srNumber = 0;
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {  

//$srNumber=$srNumber+1;

    echo "<tr>";
    //echo "<td>".$srNumber."</td>";
    echo "<td>".$row['property_name']."</td>"; 
    echo "<td>".$row['tenant_name']."</td>"; 
    
    echo "<td>".$row['period']."</td>"; 
    echo "<td>".$row['invoice_amount']."</td>"; 
    echo "<td>".$row['outstanding']."</td>"; 
 echo "</tr>";
}
?>
                  </tbody>
                  <tfoot>
                  <tr>
                    
                    <th>Property</th>
                    <th>Tenant</th>
                    <th>Period (in Months)</th>
                    <th>Total Rent (Rs.)</th>
                    <th>Outstanding</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </section>
        </div><!--/.row datatable-->
</div> 

</div>

</div>
</div>
</div>
</div>
</div>
  </div>

   </div>
</section>
    </div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChartLeads);
        google.charts.setOnLoadCallback(topLeadAssignedEmp);
        google.charts.setOnLoadCallback(expireInThreeMonth);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Asset Management Location', 'No of Customer'],
                ['Property',     25],['Tenant',     30],['Lease',     5],['Tenant',     10],['Lease',     4],['Property',     17],['Mumbai',     33],['Thane',     24],['Navi Mumbai',     7],['Pen',     48],['Panvel',     2],['Kalyan',     6],['Borivali',     1]            ]);
            var options = {
                title: 'Total Asset Location Wise',
                pieSliceText: 'value',
                'width': 350,
                'height': 350
            };
            3
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
        function drawChartLeads() {
            var data = google.visualization.arrayToDataTable([
                ['Asset Management Location', 'No of Customer'],
                ['Property',     20],['Lease',     40],['Tenant',     4]            ]);
            var options = {
                pieHole: 0.4,
                title: 'Total Asset Leads Source Wise',
                pieSliceText: 'value',
                'width': 350,
                'height': 350
            };
            3
            var chart = new google.visualization.PieChart(document.getElementById('leadchart'));
            chart.draw(data, options);
        }



      function topLeadAssignedEmp() {
        var data = google.visualization.arrayToDataTable([
          ['Asset Management', 'Property Leads'],
          ['Lease',     10],['Tenant',     3],['Property',     7],['Tenant',     21],['Property',     2],['Tenant',     3],['Lease',    12]        ]);

        var options = {
          chart: {
            title: 'Top Lead Property Employees',
            subtitle: '',
          },
          bars: 'verticle' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('topLeadAssignedEmp'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      function expireInThreeMonth() {
        var data = google.visualization.arrayToDataTable([
          ['Tenant', 'Expiry Date'],
          ['Property',     28],['Tenant',     5],['Lease',     9],['Mumbai',     33],['Thane',     17]        ]);

        var options = {
          chart: {
            title: 'Total Tenant– Expiring in 3 months',
            subtitle: '',
          },
          bars: 'verticle' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('chartExpireInThreeMonth'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

  </script>
 <script type="text/javascript">
function openwindow()
{
  var myWindow= window.open("expiry.php", "myWindow", "width=1000 , height=1000 ")  
   
}

function rentwindow()
{
  var rentWindow= window.open("rent.php", "rentWindow", "width=1000 , height=1000 ")  
   
}

function vaccantnwindow()
{
  var vaccantWindow= window.open("vaccant-property.php", "vaccantWindow", "width=1000 , height=1000 ")  
   
}

function occupancywindow()
{
  var occupancywindow= window.open("occupancy.php", "occupancywindow", "width=1000 , height=1000 ")  
 
}
</script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
<?php include '../footer.php';?> 
