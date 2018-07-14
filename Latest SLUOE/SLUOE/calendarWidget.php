<title>Calendar</title>
<link rel="stylesheet" href="css/calendar1.css">

<br><br><br>
<div class="container">
    <div class="row">
        
        <div class="col-md-9">
            <div class="pull-right form-inline" style="width: 100%;">
            <div class="btn-group">
                <button class="btn btn-primary" data-calendar-nav="prev" style="background: gainsboro; border: none;color:white;"><< Prev</button>
                <button class="btn btn-default" data-calendar-nav="today" style="background: gainsboro;border: none;color:black">Today</button>
                <button class="btn btn-primary" data-calendar-nav="next" style="background: gainsboro;border: none;color:black">Next >></button>
                <button class="btn btn-warning" data-calendar-view="year" style="background: gainsboro;border: none;color:black">Year</button>
                <button class="btn btn-warning active" data-calendar-view="month" style="background: gainsboro;border: none;color:black">Month</button>
                <button class="btn btn-warning" data-calendar-view="week" style="background: gainsboro;border: none;color:black">Week</button>
                <button class="btn btn-warning" data-calendar-view="day" style="background: gainsboro;border: none; color:black">Day</button>
            </div>
            <div class="btn-group">
                
            </div>
        </div>
            <div id="showEventCalendar"></div>
        </div>
        
    </div>
</div>
 <div class="page-header" style="background-color: transparent">
        
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>
</div>
<?php include('footer.php');?>
