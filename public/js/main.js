// key events
var ENTER_KEY = 13;
var COMMA_KEY = 188;

$(document).ready(function(){
    // pageCreateFixRequestJS();
});

// to remove the 300ms tap delay on smartphones
window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);


function pageCreateFixRequestJS() {
    var tagsInput = $('.bootstrap-tagsinput > input');
    tagsInput.tagsinput({
        maxTags: 5,
        confirmKeys: [ENTER_KEY, COMMA_KEY],
    });
}