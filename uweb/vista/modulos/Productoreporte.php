<?php

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

?>
<div class="box box-default">
	<div class="box-header with-border">
      <h3 class="box-title">Productos o servicios más vendidos</h3>
    </div>
	<div class="box-body">
      	<div class="row">
	        <div class="col-md-7">
	 			<div class="chart-responsive">
	            	<canvas id="pieChart" height="150"></canvas>
	          	</div>
	        </div>
		    <div class="col-md-5">
		  	 	<ul class="chart-legend clearfix">
                   <?php
                   for($i = 0; $i < 10; $i++){
                       //echo ' <li><i class="fa fa-circle-o text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';
                    }
                    ?>
		  	 	</ul>
		    </div>
		</div>
    </div>
    <div class="box-footer no-padding">
		<ul class="nav nav-pills nav-stacked">
		</ul>
    </div>
</div>