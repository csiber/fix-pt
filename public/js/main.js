var BASE_URL = 'http://localhost:8888/ldsot3g3/public/';

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

    $("#create_fix_offer_form").submit(function(event){
        event.preventDefault();
    });

    $("#create_fix_offer_form button").click(function(event) {
        var form = $("#create_fix_offer_form");
        var fix_offer_text = form.find('textarea').val().trim();
        var fix_offer_value = form.find('input[type="number"]').val();
        var fix_request_id = $('.fixrequest').attr('data-fix-request-id');

        // console.log(fix_offer_text);
        // console.log(fix_offer_value);
        // console.log(fix_request_id);

        $.ajax({
            url: BASE_URL+"fixoffers/create",
            type: "POST",
            data: {text: fix_offer_text, value: fix_offer_value, fix_request_id: fix_request_id},
            dataType: "json"
        }).done(function(data) {
            console.log(data);

            if(data.result === "OK") {
                // insert the new fix offer dinamically to the fix request and remove the
                // form to add another one
                var fixoffer = '<ul class="media-list fixoffer">';
                fixoffer += '<li class="media">';
                fixoffer += '<a href="#" class="pull-left">';
                fixoffer += '<img src="'+data.fixoffer.gravatar+' alt="" class="media-object">';
                fixoffer += '</a><div class="media-body">';
                fixoffer += '<h5 class="media-heading"><a href="#">'+data.fixoffer.username+'</a><span> - '+data.fixoffer.created_at_pretty+'</span></h5>';
                fixoffer += data.fixoffer.text;
                fixoffer += '</div></li></ul>';

                $('.fixoffers-list').append(fixoffer);
                $('#create_fix_offer_form').remove();

                // update the fix offers counter
                $('.fix-offers .lead .counter').html($('.fixoffer').length);

            } else {
                if(data.error_code == 1) {
                    alert("The input is invalid. Text must be at least 20 characters long and the value has to be an integer");
                }
            }
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
