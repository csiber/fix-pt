var BASE_URL = 'http://localhost:8888/ldsot3g3/public/';

// key events
var ENTER_KEY = 13;
var COMMA_KEY = 188;

$(document).ready(function(){

    $('#buttonLogin').click(function(){
        $('#signInModal').ready(function(){
            $('#buttonForgotPass').click(function(){
                console.log("FAIL");
                $('#signInModal').modal('hide');
            });
        });
    });
    
    $(".dropdown select").change(function(){
        var user_id =this.getAttribute("name");
        var ut = this.options[this.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: BASE_URL+'users/change_permission',
            data: {
                id: user_id,
                user_type: ut
            }
        }).done(function (msg) {
            window.location.replace("../users/index");
        });
    });

    $('#distritoshome').change(function(){
        var con = $('#concelhos');
        con.empty();
        con.append('<option value="">Escolha um concelho</option>');
        return $.ajax({
            type: "POST",
            url: BASE_URL+"search/getconcelhos",
            data: {did: $("#distritoshome").val()},
            success: function(data) {
                for (var i=0;i<data.length;i++) {
                    con.append('<option value="' + data[i][0] + '">' + data[i][1] + '</option>');
                }
                return true;
            },
            error: function(response) {
                return alert("ERROR:" + response.responseText);
            }
        });
    });

    $('#distritos').change(function(){
        var con = $('#concelhos');
        con.empty();
        con.append('<option value="">Escolha um concelho</option>');
        return $.ajax({
            type: "POST",
            url: "search/getconcelhos",
            data: {did: $("#distritos").val()},
            success: function(data) {
                for (var i=0;i<data.length;i++) {
                    con.append('<option value="' + data[i][0] + '">' + data[i][1] + '</option>');
                }
                return true;
            },
            error: function(response) {
                return alert("ERROR:" + response.responseText);
            }
        });
    });

    // MIGUEL -->

    $('#fixrequest-city').typeahead({
        name: 'districts',
        remote: BASE_URL+'districts/query/%QUERY',
        limit: 5
    });

    $('#fixrequest-location').typeahead({
        name: 'concelhos',
        remote: {
            url: BASE_URL+'concelhos/query/%QUERY',
            replace: function (url, uriEncodedQuery) {
                var q = 'concelhos/query/' + uriEncodedQuery;
                if ($('#fixrequest-city').val()) {
                    q += "/" + encodeURIComponent($('#fixrequest-city').val());
                }
                return BASE_URL + q;
            }
        },
        limit: 5
    });

    $('#promotionpage-city').typeahead({
        name: 'districts',
        remote: BASE_URL+'districts/query/%QUERY',
        limit: 5
    });

    $('#promotionpage-location').typeahead({
        name: 'concelhos',
        remote: {
            url: BASE_URL+'concelhos/query/%QUERY',
            replace: function (url, uriEncodedQuery) {
                var q = 'concelhos/query/' + uriEncodedQuery;
                if ($('#promotionpage-city').val()) {
                    q += "/" + encodeURIComponent($('#promotionpage-city').val());
                }
                return BASE_URL + q;
            }
        },
        limit: 5
    });

    $('.show_comments').click(function() {
        $('.comment').each(function(){
            $(this).removeClass('hide');
        });
        $(this).remove();
    });

    $('#create_comment_form button').click(function(event){
        var form = $("#create_comment_form");
        var comment_text = form.find('textarea').val().trim();
        var fix_request_id = $('.fixrequest').attr('data-fix-request-id');

        var markup = ' \
              <ul class="media-list comment"> \
                <li class="media"> \
                    <a class="pull-left" href="#"> \
                        <img class="media-object" src="${gravatar}" alt="..."> \
                    </a> \
                    <div class="media-body"> \
                        <h5 class="media-heading"><a href="#">${username}</a><span> - ${created_at}</span></h5> \
                        ${text} \
            </div></li></ul>';
        $.template( "commentTemplate", markup);

        $.ajax({
            url: BASE_URL+'comments/create',
            type: "POST",
            dataType: "json",
            data: {
                text: comment_text,
                fix_request_id: fix_request_id
            }
        }).done(function(data) {
            // console.log(data);
            
            if(data.result === "OK") {

                $.tmpl( "commentTemplate", {
                        'gravatar': data.comment.gravatar,
                        'username': data.comment.username,
                        'created_at': data.comment.created_at_pretty,
                        'text': data.comment.text,
                    }).appendTo( ".comment-list" );

                $('.comments .lead .counter').html($('.comment').length);
                form.find('textarea').val('');
            } else {
                alert("Something went wrong. Try again.");
            }
        });
    });

    // pageCreateFixRequestJS();

    // fix request photo lightbox
    $(".fancybox").fancybox();

    // open fix request if click on index page
    $(".fixrequests .panel").each(function(){
        $(this).click(function(){
            var url = $(this).find("h4 a").attr('href');
            window.location.href = url;
        });
    });
	
	$(".searchresults .panel").each(function(){
        $(this).click(function(){
            var url = $(this).find("h4 a").attr('href');
            window.location.href = url;
        });
    });

    $('.fixoffer .accept').click(function(event){
        var fix_request_id = $('.fixrequest').attr('data-fix-request-id');
        var fixer_id = $(event.target).parents('.fixoffer').attr('data-fixer-id');
        var fix_offer_id = $('.fixoffer').attr('data-fix-offer-id');

        $.ajax({
            url: BASE_URL+"jobs/create",
            type: "POST",
            data: {fix_request_id: fix_request_id, fixer_id: fixer_id, fix_offer_id: fix_offer_id},
            dataType: "json"
        }).done(function(data){
            console.log(data);

            if(data.result === "OK") {
                window.location.reload(true);
            } else {
                alert("Something went wrong. Pleasy try again later");
            }

        });
    });

    $("#create_fix_offer_form").submit(function(event){
        event.preventDefault();
    });

    $("#give_rating_form").submit(function(event){
        event.preventDefault();
    });

    $("#give_rating_form button").click(function(event){
        var form = $("#give_rating_form");
        var feedback = form.find('textarea').val().trim();
        var job_id = form.parent('.job').attr('data-job-id');
        var job_rating_score = form.find("input[name='job_rating']").val();

        $.ajax({
            url: BASE_URL+"jobs/rate",
            type: "POST",
            data: {feedback: feedback, score: job_rating_score, job_id: job_id},
            dataType: "json"
        }).done(function(data){
            console.log(data);

            if(data.result === "OK") {
                window.location.reload(true);
            } else {
                alert("Something went wrong. Pleasy try again later");
            }
        });
    });

    $("#create_fix_offer_form button").click(function(event) {
        var form = $("#create_fix_offer_form");
        var fix_offer_text = form.find('textarea').val().trim();
        var fix_offer_value = form.find('input[type="number"]').val();
        var fix_request_id = $('.fixrequest').attr('data-fix-request-id');

        var markup = (' \
            <ul class="media-list fixoffer"> \
                <li class="media"> \
                    <a href="#" class="pull-left"><img src="${gravatar}" alt="" class="media-object"></a> \
                    <div class="media-body"> \
                        <h5 class="media-heading"><a href="#">${username}</a><span> - ${created_at}</span></h5> \
                        ${text} \
                        <h5>Value: ${value}€</h5> \
            </div></li></ul>');
        $.template( "fixOfferTemplate", markup);

        $.ajax({
            url: BASE_URL+"fixoffers/create",
            type: "POST",
            data: {text: fix_offer_text, value: fix_offer_value, fix_request_id: fix_request_id},
            dataType: "json"
        }).done(function(data) {
            console.log(data);

            if(data.result === "OK") {

                $.tmpl( "fixOfferTemplate", {
                    'gravatar': data.fixoffer.gravatar,
                    'username': data.fixoffer.username,
                    'created_at': data.fixoffer.created_at_pretty,
                    'text': data.fixoffer.text,
                    'value': data.fixoffer.value
                }).appendTo( ".fixoffers-list" );

                $('#create_fix_offer_form').remove();
                $('.fix-offers .lead .counter').html($('.fixoffer').length);

            } else {
                if(data.error_code == 1) {
                    alert("The input is invalid. Text must be at least 20 characters long and the value has to be an integer");
                }
            }
        });
    });

    // to remove the 300ms tap delay on smartphones
    window.addEventListener('load', function() {
        new FastClick(document.body);
    }, false);

    // <-- MIGUEL

});


// TODO validate
function markFixerAsFavorite(star) {
    star = $(star);
    if(star.hasClass('favorite-fixer1')) {
        var id = $(".promotionpage-details").attr('data-promotionpage-id');

        star.removeClass('favorite-fixer1').addClass('favorite-fixer2');
        $.ajax({
            url: "../../users/favorite/" + id,
            context: document
        });
    }
    else {
        var id = $(".promotionpage-details").attr('data-promotionpage-id');

        star.removeClass('favorite-fixer2').addClass('favorite-fixer1');
        $.ajax({
            url: "../../users/removeFav/" + id,
            context: document
        });
    }
}

// MIGUEL -->

// TODO not functional for now
function pageCreateFixRequestJS() {
    var tagsInput = $('.bootstrap-tagsinput > input');
    tagsInput.tagsinput({
        maxTags: 5,
        confirmKeys: [ENTER_KEY, COMMA_KEY],
    });
}

// <-- MIGUEL
