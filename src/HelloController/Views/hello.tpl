<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
		
		<title>Hello</title>
		
	</head>
	
	<body>
		<h1>Hello works !</h1>
		
		<ul>
			{foreach $controller->greetings() as $greeting}
				{if $greeting eq $controller->greeting()}
					<li><strong>{$greeting}</strong></li>
				{else}
					<li><a href="{$controller->createUrl($greeting)}">{$greeting}</a></li>
				{/if}
			{/foreach}
		</ul>
	</body>
</html>
		