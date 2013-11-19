


$(document).ready(function(){

	$('#buttonLogin').click(function(){
		$('#signInModal').ready(function(){
			$('#buttonForgotPass').click(function(){
				console.log("FAIL");
				$('#signInModal').modal('hide');
				
			});	
		});
			
	});

	
});

// to remove the 300ms tap delay on smartphones
window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);