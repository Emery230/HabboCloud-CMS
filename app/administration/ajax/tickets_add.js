$(document).ready(function() {
    $('#hc_ticket_add').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/admin_ticket_add/'+idticket+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
                    window.location = document.location.href;
				} else {
					$('#error').html('<div class="alert alert-danger">'+json.response+'</div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
	$('#reply').keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $(this).parents('form').submit()
        }
    });
});

$(document).ready(function() {
    $('#hc_close_ticket').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/admin_close_ticket/'+idticket+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
                    $('#error').html('<div class="alert alert-success">'+json.response+'</div>');
					setTimeout(function(){
						 window.location = '/administration/tickets';
					}, 2000);
				} else {
					$('#error').html('<div class="alert alert-danger">'+json.response+'</div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});