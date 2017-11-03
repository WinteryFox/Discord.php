<!DOCTYPE html>

<html>
	<head>
		<title>HoroBot - A Discord Bot</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="WiNteR">
		<meta name="description" content="HoroBot - a very capable and helpful Discord bot">
		
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://horobot.pw/" />
		<meta property="og:site_name" content="HoroBot" />
		<meta property="og:title" content="HoroBot - Discord Bot" />
		<meta property="og:image" content="./img/icon-small.png" />
		<meta property="og:description" content="HoroBot - a very capable and helpful Discord bot" />
		<meta name="twitter:card" value="HoroBot - a very capable and helpful Discord bot" /> 
		
		<link rel="icon" href="./img/favicon.ico" type="image/x-icon">
		<link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet" type="text/css">
		<link href="./css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="./css/animate.css" rel="stylesheet" type="text/css">
		<link href="./css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body id="top">
		<nav class="navbar navbar-inverse navbar-fixed-top animated fadeInDown" role="navigation" style="background: linear gradient(to right, rgb(255, 255, 255), rgb(242, 242, 242));">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="./index">
						<img class="circle-icon" src="./img/icon-small.png">
						<h1>HoroBot</h1>
						<a class="btn btn-default btn-invite hidden-xs" href="https://discordapp.com/oauth2/authorize?client_id=289381714885869568&scope=bot&permissions=372435975" target="_blank">
							<b>Invite HoroBot</b>
						</a>
					</a>
					<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right" style="font-size: 14px">
						<li>
							<a class="btn btn-default btn-invite hidden-xs" href="./index">
								<i class="glyphicon glyphicon-home"></i>
								<b>Home</b>
							</a>
						</li>
						<li>
							<a type="button" class="btn btn-default btn-invite hidden-xs dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="glyphicon glyphicon-info-sign"></i>
								<b>Commands & Info</b>
								<span class="caret">
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="./about">
										<i class="glyphicon glyphicon-question-sign"></i>
										<b>About</b>
									</a>
									<a href="./commands">
										<i class="glyphicon glyphicon-book"></i>
										<b>Commands</b>
									</a>
									<a href="https://github.com/WinteryFox/HoroBot" target="_blank">
										<i class="glyphicon glyphicon-console"></i>
										<b>GitHub</b>
									</a>
									<a href="https://patreon.com/HoroBot" target="_blank">
										<i class="glyphicon glyphicon-euro"></i>
										<b>Patreon</b>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="https://discord.gg/MCUTSZz" class="btn btn-default btn-invite hidden-xs" target="_blank">
								<i class="glyphicon glyphicon-comment"></i>
								<b>Support</b>
							</a>
						</li>
						<?php
							session_start();
						?>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<div class="row" style="margin-top: 8%">
				<hr>
			</div>
			<div class="row">
				<div class="mol-md-5">
			</div>
		</div>
		
		<?php
			include_once __DIR__ . '/DiscordClient.php';
			include_once __DIR__ . '/api/objects/Embed.php';
			
			$client = new DiscordClient('Mjg5MzgxNzE0ODg1ODY5NTY4.DE2n6w.oYGYIvnXkPS98Foyqrsaucm6_q0');
			//var_dump($client->getGuildChannel('288999138140356608')->getMessage('374511883031412746'));
			//$channel = $client->getGuildChannel('288999138140356608');
			//$channel = $client->getChannel('288999138140356608');
			$channel = $client->getOrCreateDMChannel('288996157202497536');
			$builder = new EmbedBuilder();
			$builder->withTitle('Hello');
			$embed = $builder->build();
			echo(json_encode($embed->expose()));
			$channel->sendMessageAndEmbed('Hehe xd', $embed);
			//$channel->sendMessageAndEmbed('Hehe xd', '');
			
		?>
		
		<script src="./js/google-analytics.js"></script>
		<script src="./js/jquery-1.11.1.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				var scroll_start = 0;
				var startchange = $('#top');
				var offset = startchange.offset();
				if (startchange.length){
				$(document).scroll(function() {
				   scroll_start = $(this).scrollTop();
				   if(scroll_start > offset.top) {
					   $(".navbar-inverse").css('background-color', 'rgba(240,240,240,0.85)');
					} else {
					   $('.navbar-inverse').css('background-color', 'transparent');
					}
				});
				}
			 });
		</script>
	</body>
</html>