$(document).ready(function() {
	$(".v_drop_down").click(function() {
        $(this).next().slideToggle("fast");
    });
});