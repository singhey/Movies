$(function(){
	var price = 0;
	var link = $('a#book-ticket').attr('href');
	var current = window.location.href;
	var param = current.split("?");
	link= link+"?"+param[1];
	console.log(link);
	var seats = '';

	$('svg').click(function(){
		/*console.log('entered');*/
		if($(this).hasClass('reserved')){
			alert('Seat is occupied');
			return false;
		}
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
			amount = parseInt($(this).attr('data-price'));
			price -= amount;
			seats = seats.replace($(this).attr('data-location')+'|', '');
		}else{
			$(this).addClass('selected');
			amount = parseInt($(this).attr('data-price'));
			price+=amount;
			seats = seats+''+$(this).attr('data-location')+'|';
		}
		dynamicLink = link+'&amount='+price+'&seats='+seats;
		$('#amount').html(price);
		$('a#book-ticket').attr('href', dynamicLink);
	});
});