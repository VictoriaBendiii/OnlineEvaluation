<?php 
include('header.php');
?>
<title>Calendar</title>
<link rel="stylesheet" href="css/calendar.css">
<br><br><br>
<div class="container">	
    <h2>Event Calendar</h2>	
    <div class="page-header">
        <div class="pull-right form-inline">
            <div class="btn-group">
                <button class="btn btn-primary" data-calendar-nav="prev" style="background: gainsboro; border: none;color:black"><< Prev</button>
                <button class="btn btn-default" data-calendar-nav="today" style="background: gainsboro;border: none;color:black">Today</button>
                <button class="btn btn-primary" data-calendar-nav="next" style="background: gainsboro;border: none;color:black">Next >></button>
            </div>
            <div class="btn-group">
                <button class="btn btn-warning" data-calendar-view="year" style="background: gainsboro;border: none;color:black">Year</button>
                <button class="btn btn-warning active" data-calendar-view="month" style="background: gainsboro;border: none;color:black">Month</button>
                <button class="btn btn-warning" data-calendar-view="week" style="background: gainsboro;border: none;color:black">Week</button>
                <button class="btn btn-warning" data-calendar-view="day" style="background: gainsboro;border: none; color:black">Day</button>
            </div>
        </div>
        <h3></h3>
        
    </div>
    <div class="row">
        <div class="col-md-9">
            <div id="showEventCalendar"></div>
        </div>
        <div class="col-md-3">
            <h4>Events, News & Announcements</h4>
            <?php
                $result = mysqli_query($conn,"SELECT formName, startDate, due, expTime from form");

                while($row = mysqli_fetch_array($result))
                {
                    echo "Title: " . $row['formName'];
                    echo "<br>";
                    echo "Start date: " . $row['startDate'];
                    echo "<br>";
                    echo "Due date: " . $row['due'];
                    echo "<br>";
                    echo "Expiration Time: " . $row['expTime'];
                    echo "<br>";
                    echo "<br>";
                }
                ?>
            
           
        </div>
    </div>	
    
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>
<?php include('footer.php');?>
