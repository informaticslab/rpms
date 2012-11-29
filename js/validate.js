$(document).ready(function(){

	var jVal = {
		'fullName' : function() {

			$('body').append('<div id="nameInfo" class="info"></div>');

			var nameInfo = $('#nameInfo');
			var ele = $('#fullname');
			var pos = ele.offset();

			nameInfo.css({
				top: pos.top-3,
				left: pos.left+ele.width()+15
			});

			if(ele.val().length < 6) {
				jVal.errors = true;
					nameInfo.removeClass('correct').addClass('error').html('&larr; at least 6 characters').show();
					ele.removeClass('normal').addClass('wrong');
			} else {
					nameInfo.removeClass('error').addClass('correct').html('&radic;').show();
					ele.removeClass('wrong').addClass('normal');
			}
		}
	};

	// bind jVal.fullName function to "Full name" form field
	$('#fullname').change(jVal.fullName);

});
