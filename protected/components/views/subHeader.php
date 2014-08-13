
<!--SUB HEADER-->

<div id="top-shadow" class="headersub navbar navbar-inverse navbar-fixed-topsub"> 
<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
	<div class="row">
	<div class="kv">
	<div class="sub-menu-head">
		<div class="list-sub">
		<span tabindex="0" class="ma-den hidden-480 hidden-320 hidden-600 hidden-620 active" role="button">Top Member</span> 
		<span tabindex="0" class="ma-den dropdown hidden-md hidden-lg hidden-sm active" role="button">	
		<?php 
		echo CHtml::link('Top Member<i class="icon-caret-down"></i>',array('site/index'), array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown','data-close-others'=>'true')); 
		?>
		<!--<a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">Top Member<i class="icon-caret-down"></i>
		</a> -->		
		<ul class="dropdown-menu more-menu">		
			<li>
			<?php 
			echo CHtml::link('Going Viral',array('site/index'), array('class'=>'gren first')); 
			?>
			<!--<a class="gren first" href="#">Going Viral</a>-->
			</li>		
			<li>
			<?php 
			echo CHtml::link('New Member',array('site/newmembers'), array('class'=>'gren last')); 
			?>
			<!--<a class="gren last" href="#">New Member</a> -->
			
			</li>
		</ul>
		</span>		
		<span tabindex="0" class="ma-den hidden-480 hidden-320 hidden-600 hidden-620" role="button">Going Viral</span>		
		<span tabindex="0" class="ma-den hidden-480 hidden-320 hidden-600 hidden-620" role="button">New Member</span>
		<div class="ma-den dropdown"> 
		<!-- CAPTION LOCATION --> 
		<a class="dropdown-toggle caption" data-close-others="true"  data-toggle="dropdown" href="#">Monaco<i class="icon-map-marker"></i></a>
		<ul data-delay="1000" class="dropdown-menu extended loc">
		<li>
		<div class="rowb">
		<div class="gender-lo">			
			<?php echo CHtml::link('<span class="badge"><i class="icon-female" aria-hidden="true"></i></span>',array('site/females')); ?>
			<?php echo CHtml::link('<span class="badge"><i class="icon-male" aria-hidden="true"></i></span>',array('site/males')); ?>
		</div>
		<div class="country-lo"><span class="text">From</span><i data-toggle="modal" href="#country-list" class="icon-map-marker"></i>
		<div class="btn-group">
		<button class="btn btn-default" type="button">Germany</button>
		<button data-close-others="false" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="btn btn-defaultb dropdown-toggle part-right" type="button"><i class="icon-caret-down"></i></button>
		<ul data-delay="1000" role="menu" class="dropdown-menu">
		<li class="row1">
		<div class="gey">
		<ul>
		<li><a href="#">Countries Nearby...</a></li>
		</ul>
		</div>
		<div class="white">
		<ul>
			<li><?php echo CHtml::link('Belgium',array('site/country', 'c'=>'Belgium')); ?></li>
			<li><?php echo CHtml::link('Denmark',array('site/country', 'c'=>'Denmark')); ?></li>
			<li><?php echo CHtml::link('France',array('site/country', 'c'=>'France')); ?></li>
			<li><?php echo CHtml::link('India',array('site/country', 'c'=>'India')); ?></li>
			<li><?php echo CHtml::link('Netherlands',array('site/country', 'c'=>'Netherlands')); ?></li>
			<li><?php echo CHtml::link('Switzerland',array('site/country', 'c'=>'Switzerland')); ?></li>
		<li>&nbsp;</li>
		<li><a class="green" data-toggle="modal" href="#country-list">Browse all Countries</a></li>
		</ul>
		</div>
		</li>
		<li class="row2">
		<div class="gey">
		<ul>
		<li><a href="#">Currently Viewing</a></li>
		</ul>
		</div>
		<div class="white">
		<ul>
		<li>
		<?php
		if(isset($_GET['c']))
			echo CHtml::link($_GET['c'],array('site/country', 'c'=>$_GET['c']));
		else
			echo CHtml::link('All Countries',array('site/country', 'c'=>''));
		?>
		</li>
		</ul>
		</div>
		</li>
		</ul>
		</div>
		</div>
		<div class="button-lo">
		<div class="addbut">
		<input type="submit" value="Start Search" class="le-button">
		</div>
		</div>
		</div>
		</li>
		</ul>
		<!-- END LOCATION -->
		</div>
		</div>
	</div>
	</div>
	</div>
	<!--END LEFT ICON--> 
	</div>
	<!-- END TOP NAVIGATION BAR --> 

</div>
<!--END SUB HEADER-->