<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Calendrier</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

        <script type="text/javascript">
            jQuery(function($){
                $('.month').hide();
                $('.month:first').show();
                $('.months a:first').addClass('active');
                var current = 1;
                $('.months a').click(function(){
                    var month = $(this).attr('id').replace('linkMonth','');
                    if(month != current){
                        $('#month'+current).slideUp();
                        $('#month'+month).slideDown();
                        $('.months a').removeClass('active'); 
                        $('.months a#linkMonth'+month).addClass('active'); 
                        current = month;
                    }
                    return false; 
                });
            });
        </script>
    </head>
    <body>
        <?php
        require('connexionhdb.php'); 
        require('date.php');
        $date = new Date();
        $year = date('Y');
        //$month = date('n');
        //$day = date('j');
        $events = $date->getEvents($year);
        $dates = $date->getAll($year);
        ?>
        <div class="periods">

            <!-- START Affichage de l'année .year -->
            <div class="year"><?php echo $year ; ?></div>
            <!-- END Affichage de l'année -->

            <div class="months">
                <ul>
                    <?php foreach ($date->months as $id=>$m): ?>
                    <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <?php $dates = current($dates); ?>
            <?php foreach ($dates as $m=>$days): ?>
            <div class="month relative" id="month<?php echo $m; ?>">
                <table>

                    <!-- START Affichage des jours de la semaine -->
                    <thead>
                        <tr>
                            <?php foreach ($date->days as $d): ?>
                            <th><?php echo substr($d,0,3); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <!-- END Affichage des jours de la semaine -->

                    <tbody>
                        <tr>
                            <?php $end = end($days); foreach($days as $d=>$w): ?>
                            <?php $time = strtotime("$year-$m-$d"); ?>
                            <?php if($d == 1 && $w != 1): ?>
                            <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                            <?php endif; ?>
                            <td<?php if($time == strtotime(date('Y-m-d'))): ?> class="today" <?php endif; ?>>
                                <div class="relative">
                                    <div class="day"><?php echo $d; ?></div>
                                </div>
                                <div class="daytitle">
                                    <?php echo $date->days[$w-1]; ?> <?php echo $d; ?>  <?php echo $date->months[$m-1]; ?>
                                </div>
                                
                                <!-- START Affichage des dots events -->
                                <ul class="events">
                                    <?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
                                    <li><?php echo $e; ?></li><br />
                                    <?php endforeach; endif;  ?>
                                </ul>
                                <!-- END Affichage des dots events -->
                                
                            </td>
                            <?php if($w == 7): ?>
                        </tr><tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if($end != 7): ?>
                        <td colspan="<?php echo 7-$end; ?>" class="padding"></td>
                        <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="clear"></div>
        <!--        <pre><?php // print_r($events); ?></pre>-->
    </body>
</html>