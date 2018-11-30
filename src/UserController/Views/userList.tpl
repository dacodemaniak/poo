<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
		
		<title>Gestion des utilisateurs</title>
		
		<link href="/web/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		
	</head>
	
	<body>
		<h1>Gestion des utilisateurs</h1>
		
		<table class="table table-stripped table-condensed">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			
			<tbody>
			{foreach $controller->users() as $user}
				<tr>
					<td>{$user->id()}</td>
					<td>{$user->getName()}</td>
					<td>
						<a href="{$controller->createUrl(null,"update",$user->id())}" class="btn btn-primary">M</a>
						<a href="#" data-rel="{$user->id()}" class="btn btn-danger delete-action">S</a>
					</td>
				</tr>
			{/foreach}
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<a href="{$controller->createUrl(null,"insert")}" class="btn btn-success">Nouveau</a>
					</td>
			</tfoot>
		</ul>
		
		<!-- Intégration des librairies JS -->
		<script src="/web/node_modules/jquery/dist/jquery.min.js"></script>
		<script src="/web/dist/app.js"></script>
	</body>
</html>
		