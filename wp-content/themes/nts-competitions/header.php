<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/hup3toi.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		<script type="text/javascript">
		$(document).ready(function(){
		
			$("input[type=text]").attr("disabled",true);
			
			$("input[type=radio]").click(function(){
			
				$("input[type=text]").removeAttr("disabled");
				$(".form_title").css({"opacity": "1"});
				$("input[type=text]").css({"opacity": "1"});
						 
			});
		
		});
		
		//Initial load of page
		$(document).ready(sizeContent);
		
		//Every resize of window
		$(window).resize(sizeContent);
		
		//Dynamically assign height
		function sizeContent() {
		    var newHeight = $("html").height() - $("header").height() - $("footer").height() - "110" + "px";
		    $("#content").css("height", newHeight);
		}
		</script>
	</head>

	<body <?php body_class(); ?>>
	
		<div class="page">
	
		<a id="top"></a>

		<header id="header">
		
			<div class="responsive-container">

				<div class="logo">
					<a href="<?php bloginfo('url'); ?>" title=""><img src="<?php bloginfo('template_directory'); ?>/library/images/logo.png" alt="Scotland In Trust" class="logoimg" width="275"></a>
					<h1 class="site-title">Competitions</h1>
				</div>
				
			</div>

		</header> <!-- end header -->


		<div class="wrapper">