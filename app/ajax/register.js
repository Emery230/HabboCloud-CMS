$(document).ready(function() {
    $('#hc_register').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/register',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = "/Client/Dashboard?Register=OK";
                    }, 1500);
				} else {
					$('#error').html('<div class="alert-danger">'+json.response+'</div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});