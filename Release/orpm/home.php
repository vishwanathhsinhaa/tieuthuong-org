<?php if(!isset($Translation)){ @header('Location: index.php'); exit; } ?>
<?php include_once("{$currDir}/header.php"); ?>
<?php @include("{$currDir}/hooks/links-home.php"); ?>

<?php
	/*
		Classes of first and other blocks
		---------------------------------
		For possible classes, refer to the Bootstrap grid columns, panels and buttons documentation:
			Grid columns: http://getbootstrap.com/css/#grid
			Panels: http://getbootstrap.com/components/#panels
			Buttons: http://getbootstrap.com/css/#buttons
	*/
	$block_classes = array(
		'first' => array(
			'grid_column' => 'col-sm-12 col-md-8 col-lg-6',
			'panel' => 'panel-warning',
			'link' => 'btn-warning'
		),
		'other' => array(
			'grid_column' => 'col-sm-6 col-md-4 col-lg-3',
			'panel' => 'panel-info',
			'link' => 'btn-info'
		)
	);
?>

<style>
	.panel-body-description{
		margin-top: 10px;
		height: 100px;
		overflow: auto;
	}
	.panel-body .btn img{
		margin: 0 10px;
		max-height: 32px;
	}
</style>


<div class="row" id="table_links">
	<?php
		/* accessible tables */
		if(is_array($arrTables) && count($arrTables)){
			$i=0;
			foreach($arrTables as $tn=>$tc){
				$tChkFF = array_search($tn, array());
				$tChkHL = array_search($tn, array('residence_and_rental_history','employment_and_income_history','references'));
				if($tChkHL !== false && $tChkHL !== null) continue;

				$searchFirst = (($tChkFF !== false && $tChkFF !== null) ? '?Filter_x=1' : '');
				?>
				<div id="<?php echo $tn; ?>-tile" class="col-xs-12 <?php echo (!$i ? $block_classes['first']['grid_column'] : $block_classes['other']['grid_column']); ?>">
					<div class="panel <?php echo (!$i ? $block_classes['first']['panel'] : $block_classes['other']['panel']); ?>">
						<div class="panel-body">
							<a class="btn btn-block btn-lg <?php echo (!$i ? $block_classes['first']['link'] : $block_classes['other']['link']); ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", htmlspecialchars(strip_tags($tc[1]))); ?>" href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>"><?php echo ($tc[2] ? '<img src="' . $tc[2] . '">' : '');?><strong><?php echo $tc[0]; ?></strong></a>
							<div class="panel-body-description"><?php echo $tc[1]; ?></div>
						</div>
					</div>
				</div>
				<?php
				$i++;
			}
		}else{
			?><script>window.location='index.php?signIn=1';</script><?php
		}
	?>
</div>

<div class="row" id="custom_links">
	<?php
		/* custom home links, as defined in "hooks/links-home.php" */
		if(is_array($homeLinks)){
			$memberInfo = getMemberInfo();
			foreach($homeLinks as $link){
				if(!isset($link['url']) || !isset($link['title'])) continue;

				/* fall-back classes if none defined */
				if(!isset($link['grid_column_classes'])) $link['grid_column_classes'] = $block_classes['other']['grid_column'];
				if(!isset($link['panel_classes'])) $link['panel_classes'] = $block_classes['other']['panel'];
				if(!isset($link['link_classes'])) $link['link_classes'] = $block_classes['other']['link'];

				if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])){
					?>
					<div class="col-xs-12 <?php echo $link['grid_column_classes']; ?>">
						<div class="panel <?php echo $link['panel_classes']; ?>">
							<div class="panel-body">
								<a class="btn btn-block btn-lg <?php echo $link['link_classes']; ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", htmlspecialchars(strip_tags($link['description']))); ?>" href="<?php echo $link['url']; ?>"><?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?><strong><?php echo $link['title']; ?></strong></a>
								<div class="panel-body-description"><?php echo $link['description']; ?></div>
							</div>
						</div>
					</div>
					<?php
				}
			}
		}
	?>
</div>

<script>
	jQuery(function(){
		var table_descriptions_exist = false;
		jQuery('div[id$="-tile"] .panel-body-description').each(function(){
			if(jQuery.trim(jQuery(this).html()).length) table_descriptions_exist = true;
		});

		if(!table_descriptions_exist){
			jQuery('div[id$="-tile"] .panel-body-description').css({height: 'auto'});
		}

		jQuery('.panel-body .btn').height(32);
	});
</script>

<?php include_once("$currDir/footer.php"); ?>