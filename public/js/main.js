$(document).ready(function(){

});

// to remove the 300ms tap delay on smartphones
window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);