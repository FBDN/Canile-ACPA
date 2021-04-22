<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ACPA Canile Comunale di Cesena</title>
        <link rel="stylesheet" href="css/jbclock.css" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="js/jbclock.js"></script>
        <?php
            /* Set start and end dates here */
            $startDate  = strtotime("25 April 2013 14:00:00");
            $endDate    = strtotime("8 September 2013 14:00:00");
            /* /Set start and end dates here */
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                JBCountDown({
                    secondsColor : "#ffdc50",
                    minutesColor : "#9cdb7d",
                    hoursColor   : "#378cff",
                    daysColor    : "#ff6565",
                    
                    startDate   : "<?php echo $startDate; ?>",
                    endDate     : "<?php echo $endDate; ?>",
                    now         : "<?php echo strtotime('now'); ?>",
                    seconds     : "<?php echo date("s"); ?>"
                });
            });
        </script>
    </head>

    <body>

        <div class="wrapper" style="margin-top:150px;">
            <h1>Questo Sito &egrave; in Costruzione!!</h1>
            <h4>Saremo online in:</h4>
            <div class="clock">
                
                <div class="clock_days">
                    <canvas id="canvas_days" height="190px" width="190px" id="canvas_days"></canvas>
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_days">Giorni</p>
                    </div>
                </div>
                <div class="clock_hours">
                    <canvas height="190px" width="190px" id="canvas_hours"></canvas>
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_hours">Ore</p>
                    </div>
                </div>
                <div class="clock_minutes">
                    <canvas height="190px" width="190px" id="canvas_minutes"></canvas>
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_minutes">Minuti</p>
                    </div>
                </div>
                <div class="clock_seconds">
                    <canvas height="190px" width="190px" id="canvas_seconds"></canvas>
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_seconds">Secondi</p>
                    </div>
                </div>
                
            </div><!--/clock -->
        </div><!--/wrapper -->


        <div class="social">
            <div class="wrapper">
                <p>Nel frattempo potete seguirci su <a href="http://www.facebook.com/acpa.cesena">Facebook</a> </p>
            </div>
        </div><!--/social-->
    </body>
</html>
