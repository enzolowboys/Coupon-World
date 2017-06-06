$(document).ready(function(){
    
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

$(document).ready(function() {
    
    $(".espandi").click(function () {
        
        $espandi = $(this);
        //getting the next element
        $filtraForm = $(".filtraForm");
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $filtraForm.slideToggle(500, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $espandi.text(function () {
                //change text based on condition
                return $filtraForm.is(":visible") ? "Filtra per azienda -" : "Filtra per azienda +";
            });
        });
        
    });
});

$(document).ready(function() {
    
    $(".espandi2").click(function () {
        
        $espandi = $(this);
        //getting the next element
        $filtraForm = $(".filtraForm2");
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $filtraForm.slideToggle(500, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $espandi.text(function () {
                //change text based on condition
                return $filtraForm.is(":visible") ? "Filtra per azienda -" : "Filtra per azienda +";
            });
        });
        
    });
});