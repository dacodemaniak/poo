<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
		
		<title>{$controller->title}</title>
		
		<link href="./web/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
		<h1>{$controller->title}</h1>
		
		<form method="post" action="{$controller->getAction()}">	
			<div class="form-group">
				<label for="name">Nom</label>
				<input name="name" type="text" id="name" value="{$controller->user()->name()}" class="form-control">
			</div>
			
			<div class="form-group">
				<label for="firstname">Prénom</label>
				<input name="firstName" type="text" id="firstname" value="{$controller->user()->firstName()}" class="form-control">
			</div>
			
			<div class="form-group">
				<label for="username">Login</label>
				<input name="userName" type="text" id="username" value="{$controller->user()->userName()}" class="form-control">
			</div>
			
			<div class="form-group">
				<label for="password">Mot de passe</label>
				<input name="password" type="password" id="password" value="{$controller->user()->password()}" class="form-control">
			</div>
			
			<div>
				<button class="btn btn-default" type="reset">Annuler</button>
				<button class="btn btn-success" name="submit" type="submit">{$controller->btnTitle}</button>
			</div>
		</form>
	</body>
</html>
		