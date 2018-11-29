<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<title>{$controller->title()}</title>
		
	</head>
	
	<body>
		{if $controller->isNotFound() neq false}
			<div class="alert alert-warning">
				{$controller->isNotFound()}
			</div>
		{/if}
		<h1>Index works!</h1>
	</body>
</html>