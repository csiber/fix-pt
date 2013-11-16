// key events
var ENTER_KEY = 13;
var ESC_KEY = 8;

$(document).ready(function(){
    $(this).keyup(function(e){
        console.log(e.which);
    });
    pageCreateFixRequestJS();

});

// to remove the 300ms tap delay on smartphones
window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);

function pageCreateFixRequestJS() {

    var tagsInput = $('.bootstrap-tagsinput > input');
    tagsInput.tagsinput({
        maxTags: 5,
        confirmKeys: [13, 188]
    });
}