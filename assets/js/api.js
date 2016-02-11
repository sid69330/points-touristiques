$(document).ready(function(){
	get_categ_menu();
	show_hide_cat();
	update_point_list();

	$('#constructionParcours ul li .remove_point_lm').on('click', function(){
		add_point_itineraire($(this).parent().data('id'));
	});

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

function show_hide_cat(){
	if(window.location.pathname != '/'){
		$('#categ_list').css('display', 'none');
	}
}

function add_point_itineraire(id){
	var point_selector = $('#point_'+id+' .point_name');
		name = point_selector.html();
		button = $('#button_'+id);

	if(button.hasClass('remove')){
		localStorage.removeItem(id);
		button.removeClass('remove').html('Ajouter');
	}else{
		localStorage.setItem(id, name);
		button.addClass('remove').html('Retirer');
	}

	update_point_list();
}

function update_point_list(){
	var list = $('ul#listeConstructionParcours');
		badge = $('#constructionParcours .badge');

	list.html('');

	$.each(localStorage, function(index, elem){
		list.append('<li data-id="'+index+'">'+elem+'<span class="remove_point_lm"><i class="fa fa-times"></i></span></li>');
	});

	badge.html(localStorage.length);
}