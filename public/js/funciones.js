$(document).ready(function(){
	
	var nuevo;//url final
	var base = window.location.origin;//alert(base);Http://ip:8000
	var url = window.location.pathname;//alert(url);/url/url/..
		nuevo = url.split('/',3);//separamos la url que interesa
	var url_compl = base+'/'+nuevo[1]+'/'+nuevo[2];//unimos toda la url despues de separar
	var target = $('a[href="'+url_compl+'"]');//identificamos en cual enlace esta la url
		//target.css('color',' #161010');//agregamos estilo al enlace <a>
		target.addClass('active');


	//var node = $('a[href="'+url_compl+'"] > i');//agregamos clase al tag <i>
		//node.removeClass('fa-circle-notch');
		//node.addClass('fas fa-circle-notch');

	
	var menus = $(target).parents('li');//activamos el menu hamburguesa retrocediendo al tag padre DOM
		menus.addClass('open');//agregamos la clase active


  	/*$('.nav-link').click(function(){
  		//alert('aca');
  		$('.nav-link').removeClass('active');
  		$(this).addClass('active');
  	});*/
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})