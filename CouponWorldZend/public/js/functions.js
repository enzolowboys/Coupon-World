$(document).ready(function(){

	/* <![CDATA[ */
	//Tutti i sottomenu devono essere resi invisibili
	$("#menutendina li > ul").hide();
	
	//A tutte le ancore dirette discendenti degli li che hanno un ul associato, aggiungo la classe open per evienziare che hanno sottocategorie associate
	$("#menutendina li:has(ul) > a").addClass("open");
	
	//A tutti gli li:last-child diretti discendenti di un ul , attribuisco la classe last
	$("#menutendina ul > li:last-child").addClass("last");
	
	//Creo un elemento span per aprire i sottomenu
	$("<span class='plus'></span>").insertAfter(".open");
	
	//Al click dello span apro/chiudo i sottomenu
	$(".plus").click(function(){
		if($(this).next().is(":hidden")){
			$(this).next().slideDown();
			$(this).fadeOut(200, function(){
				$(this).addClass("up").fadeIn(); // Durtante il fadeOut aggiungo la classe up e riporto a 1 l'opacità
			});
		} else {
			$(this).next().slideUp();
			$(this).fadeOut(200, function(){
				$(this).removeClass("up").fadeIn(); // Durtante il fadeOut rimuovo la classe up e riporto a 1 l'opacità
			});
		}
	});
	/* ]]> */
});

 
  /* Cambiare l'effetto da utilizzare */
  $.easing.def = "easeOutBounce";
 
  /* Associare una funzione all'evento click sul link */
  $('li.title a').click(function(e){
     
    /* Finding the drop down list that corresponds to the current section: */
    var subMenu = $(this).parent().next();
         
    /* Trovare il sotto menu che corrisponde alla voce cliccata */
    $('.sub-menu').not(subMenu).slideUp('slow');
    subMenu.stop(false,true).slideToggle('slow');
         
    /* Prevenire l'evento predefinito (che sarebbe di seguire il collegamento) */
    e.preventDefault();
  })
     
});

