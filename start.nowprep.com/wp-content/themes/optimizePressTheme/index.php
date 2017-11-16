<?php $img = op_img('',true) ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php _e('OptimizePress - Getting Started', 'optimizepress'); ?></title>
	<?php $op_script_debug_main_style = (OP_SCRIPT_DEBUG === '.min' ) ? '' : '.max'; ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/style<?php echo $op_script_debug_main_style; ?>.css">
	<!--[if !IE 7]>
	<style type="text/css"> #wrapper {display:table;height:100%} </style>
	<![endif]-->
</head>
<body>

	<div id="wrapper"><div id="content">

		<div id="header">
			<div class="container">
				<div class="op-logo"></div>
				<a href="<?php echo admin_url('admin.php?page=optimizepress'); ?>" class="button"><?php _e('Finish Blog Setup', 'optimizepress'); ?></a>
			</div>
		</div>

		<div class="container">
			<h1 class="title"><?php _e("You're almost done, just a few more steps.", "optimizepress"); ?></h1>
			<ul class="steps">
				<li class="completed">
					<h1><img src="<?php echo $img ?>checkmark-alt.png"></h1>
					<h2><?php _e('Download and Install OptimizePress Theme', 'optimizepress'); ?></h2>
					<p><?php _e('Already done.', 'optimizepress'); ?></p>
				</li>
				<li>
					<h1>2</h1>
					<h2><?php _e('Turn on your Blog from the Blog Settings', 'optimizepress'); ?></h2>
					<p><?php _e('Inside Blog Setup you will be able to turn Blog on.', 'optimizepress'); ?></p>
				</li>
				<li>
					<h1>3</h1>
					<h2><?php _e('Choose a Blog Theme for your Website', 'optimizepress'); ?></h2>
					<p><?php _e('Inside Blog Setup you will be able to adjust Blog settings.', 'optimizepress'); ?></p>
				</li>
				<li>
					<h2><?php _e('Troubleshooting', 'optimizepress'); ?></h2>
					<p style="line-height:18px"><?php _e('If you have completed blog setup and still see this message please tick the box in Dashboard -- Global Settings -- External Plugin Compatibility.', 'optimizepress'); ?></p>
				</li>
			</ul>
			<ul class="help">
				<li><a href="<?php echo OP_SUPPORT_LINK; ?>" target="_blank" class="support"><h2><?php _e('Support<br>Knowledgebase', 'optimizepress'); ?></h2></a></li>
				<li><a href="http://www.optimizehub.com/members-home/basics-training/" target="_blank" class="members"><h2><?php _e('Member Tutorials<br>&amp; Training', 'optimizepress'); ?></h2></a></li>
			</ul>
		</div>

	</div>	</div>	<!-- Stick Footer Wrapper -->

	<div id="footer">
		<div class="container">
			<p>&copy; Copyright <?php echo date("Y"); ?> OptimizePress. All Rights Reserved.</p>
		</div>
	</div>

</body>
</html>