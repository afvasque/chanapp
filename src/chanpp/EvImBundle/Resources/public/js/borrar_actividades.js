// Get the ul that holds the collection of tags
var collectionHolder = $('div#chanpp_evimbundle_fichaproyectotype_activities');

jQuery(document).ready(function() {

    // add a delete link to all of the existing tag form li elements
    $("div[id^='chanpp_evimbundle_fichaproyectotype_activities_']").each(function() {
        addTagFormDeleteLink($(this).parent());
    });

    
});

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#">delete this activity</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}