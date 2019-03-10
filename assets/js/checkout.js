$(function(){
	var current = window.location.href;
	var param = current.split("?");

	$('#complete-purchase').submit(function(e){
		e.preventDefault();
		var req_method = $(this).attr('method');
		var req_url = $(this).attr('action');
		var form_data = $(this).serialize();
		/*console.log(form_data);*/
		$.ajax({
			url:req_url,
			method: req_method,
			data: form_data
		}).done(function(res){
			console.log(res);
			var c = JSON.parse(res);
			if(c.type == 'error'){
				alert(c.text);
			}
			if(c.type=="success"){
				$('#_c_m').addClass('visible');$('._m').html(c.text);
				window.location = c.link;
			}
		});
	});

	$(document).keydown(function(e){
		if(e.which == 116){
			var r = confirm('Do you wish to refresh?');
			if(!r){
				e.preventDefault();
			}
		}
	});
});