$(document).ready(function() {
    $('#hc_create_ticket').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/create_ticket',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div style="margin-top: -20px; margin-bottom: 39px" role="alert" class="alert bg-success">'+json.response+'</div>');
					$('input').val('');
					window.setTimeout(function() {
                        window.location = "/Client/Support";
                    }, 1500);
				} else {
					$('#error').html('<div style="margin-top: -20px; margin-bottom: 39px" role="alert" class="alert bg-danger">'+json.response+'</div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
	$('#contenu').keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $(this).parents('form').submit()
        }
    })
});



$(document).ready(function() {
    $('#hc_reply').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/reply_ticket/'+idticket,
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('textarea').val('');
					window.location = document.location.href;
				} else {
					$('#error').html('<div role="alert" class="alert bg-danger" style="margin-top: -20px; margin-bottom: 30px">'+json.response+'</div>');
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
    })
});