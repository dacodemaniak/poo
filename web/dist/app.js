/**
 * @name app Fonctions utiles de gestion Ajax
 */

$('.delete-action').on('click', function(event) {
	
	// Stopper la propagation de l'événement
	event.stopPropagation();
	
	// Quel id dois-je supprimer
	const clickObject = $(this);
	console.info('Click détecté sur l\'id : ' + clickObject.data('rel'));
	
	const row = clickObject.parents('tr');
	
	// On a les infos, on peut faire l'appel Ajax
	$.ajax({
		url: 'http://poo.wrk/user/update/' + clickObject.data('rel'),
		method: 'delete',
		responseType: 'json',
		success: function(data) {
			// Ce qui doit se passer si l'appel réussi
			console.info(JSON.stringify(data));
			// On peut supprimer la ligne du tableau correspondante
			row.remove();
		},
		error: function(error) {
			// Ce qui doit se passer si l'appel échoue
			console.error(error);
		}
	});
});