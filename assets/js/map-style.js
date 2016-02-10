$(document).ready(function(){
	map_height();

	$(window, document).on('resize', function(){
		map_height();
	});

	cacherMenuCategorie();
	cacherConstructionParcours(true);
});

function map_height(){
	var WindowHeight = $(window).height();
		MenuHeight = $('#barre_menu_haut').height();
		MapHeight = WindowHeight - MenuHeight;

	$('#map').css({'margin': MenuHeight+'px 0px 0px 0px', 'height': MapHeight+'px'});
}

function cacherMenuCategorie()
{
	if($('._map_point_clicker').css('display') != 'none')
	{
		$('._map_point_clicker').css({'display':'none'});
		$('#flecheCatMenu').html('<i class="fa fa-angle-down fa-2x"></i>');
	}
	else
	{
		$('._map_point_clicker').css({'display':'block'});
		$('#flecheCatMenu').html('<i class="fa fa-angle-up fa-2x"></i>');
	}
}

function cacherConstructionParcours(premierChargement)
{
	if(premierChargement)
	{
		$("#listeConstructionParcours").hide();
		$('#constructionParcours p span.fleche').html('<i class="fa fa-angle-up"></i>');
	}
	else
	{
		if($( "#listeConstructionParcours").is(":hidden"))
		{
			$("#listeConstructionParcours").slideDown("slow");
			$('#constructionParcours p span.fleche').html('<i class="fa fa-angle-down"></i>');
		}
		else
		{
			$("#listeConstructionParcours").slideUp("slow");
			$('#constructionParcours p span.fleche').html('<i class="fa fa-angle-up"></i>');
		}
	}
}