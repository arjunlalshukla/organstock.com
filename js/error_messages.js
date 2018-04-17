$(document).ready(function() {
	$(".close").click(function() {
		$(this).parent().append("Clicked");
		$(this).parent().remove();
	});
});