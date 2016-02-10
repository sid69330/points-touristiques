$(document).ready(function(){
	get_categ_menu();
});

function get_categ_menu(){
	$.ajax({
		url: '/categorie',
		type: 'GET',
		dataType: 'json',
		data: {},
	}).done(function(data){
		var menu = $('#_ajax_load_menu');
		$.each(data, function(key, elem){
			menu.append('<li class="_map_point_clicker" data-value="'+key+'" title="Ajouter les marqueurs '+elem+'"><a href="#">'+elem+'</a></li>');
		});
	})
	.fail(function() {
		console.log("error");
	});
}