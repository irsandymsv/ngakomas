var hal = $('#page').text();
// alert(hal);
$('a[name="side"]').each(function() {
	var sideName = $(this).html();
	if (sideName.indexOf(hal) != -1) {
		console.log(sideName);
		$(this).addClass('active');

	} else {
		// console.log($(this).text());
		$(this).removeClass('active');
	}
});
