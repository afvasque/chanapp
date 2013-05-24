// Get the ul that holds the collection of tags
//var collectionHolder = $('div#chanpp_evimbundle_indgestiontype_metas');

jQuery(document).ready(function() {

    // add a delete link to all of the existing tag form li elements
    $("a#boton_borrar").click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    
});