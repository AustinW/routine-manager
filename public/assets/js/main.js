$(function() {
	$('.athlete-birthday .input-append.date').datepicker({
	    format: "yyyy-mm-dd",
	    todayHighlight: true
	});

	var selectedGender = $('.athlete-gender input[type=radio]:checked').val();
	$('.athlete-gender label#athlete-gender-' + selectedGender).addClass('active');
});