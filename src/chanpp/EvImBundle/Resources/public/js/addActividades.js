jQuery(document).ready(function() {

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        collectionHolder.data('index', (collectionHolder.find(':input').length)/indexNo);

        $("a#agregar_actividad").on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // add a new tag form (see next code block)
            addTagForm(collectionHolder);
        });

    

   
});

function addTagForm(collectionHolder) {
    // Get the data-prototype explained earlier
    var prototype = collectionHolder.data('prototype');

    // get the new index
    var index = collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    //var $newFormDiv = $("<div id=borrar_actividad></div>");
    collectionHolder.append("<div>" + newForm + "</div>");
    // increase the index with one for the next item
    collectionHolder.data('index', index + 1);
    //$addTagLink.before($newFormDiv);

     // add a delete link to the new form
    addTagFormDeleteLink();
}

function addTagFormDeleteLink() {
    //var $removeFormA = $('<a href="#">delete this tag</a>');
    collectionHolder.children().last().append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        collectionHolder.children().last().remove();
    });
}