// key events
var ENTER_KEY = 13;
var COMMA_KEY = 188;

// pageCreateFixRequestJS();

$(document).ready(function(){

	$('#buttonLogin').click(function(){
		$('#signInModal').ready(function(){
			$('#buttonForgotPass').click(function(){
				console.log("FAIL");
				$('#signInModal').modal('hide');
			});
		});
    });

    // fix request photo lightbox
    $(".fancybox").fancybox();

    // open fix request if click on index page
    $(".fixrequests .panel").each(function(){
        $(this).click(function(){
            var url = $(this).find("h4 a").attr('href');
            window.location.href = url;
        });
    });
});


// to remove the 300ms tap delay on smartphones
window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);


// TODO validate
function markFixerAsFavorite(star) {
	star = $(star);
	if(star.hasClass('glyphicon-star-empty')) {
		star.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
	}
    else {
    star.removeClass('glyphicon-star').addClass('glyphicon-star-empty');
 	}
 }


// TODO not functional for now
function pageCreateFixRequestJS() {
    var tagsInput = $('.bootstrap-tagsinput > input');
    tagsInput.tagsinput({
        maxTags: 5,
        confirmKeys: [ENTER_KEY, COMMA_KEY],
    });
}
