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
                return $filtraForm.is(":visible") ? "Filtra per tipologia -" : "Filtra per tipologia +";
            });
        });
        
    });
});

$(document).ready(function() {
    
    $(".espandi3").click(function () {
        
        $espandi = $(this);
        //getting the next element
        $filtraForm = $(".filtraForm3");
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $filtraForm.slideToggle(500, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $espandi.text(function () {
                //change text based on condition
                return $filtraForm.is(":visible") ? "FILTRA PER AZIENDA -" : "FILTRA PER AZIENDA +";
            });
        });
        
    });
});


$(document).ready(function() {
    
    $(".espandi4").click(function () {
        
        $espandi = $(this);
        //getting the next element
        $filtraForm = $(".filtraForm4");
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $filtraForm.slideToggle(500, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $espandi.text(function () {
                //change text based on condition
                return $filtraForm.is(":visible") ? "FILTRA PER TIPOLOGIA -" : "FILTRA PER TIPOLOGIA +";
            });
        });
        
    });
});

/* Snackbar per gestione della funzionalità stampa (fa comparire il messaggio idoneo)*/
function myFunction() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}

/* funzione per la pagina dei brands generale */
function myFunctionTwo() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

/* Snackbar per gestione della funzionalità stampa (fa comparire il messaggio idoneo)*/
function myFunctionThree() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbartwo")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

/* Snackbar per gestione della funzionalità stampa (fa comparire il messaggio idoneo)*/
function myFunctionFour() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbarthree")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
