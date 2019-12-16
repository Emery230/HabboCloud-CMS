$(document).ready(function() {
    $('#hc_order').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/order',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div style="margin-top: -40px; margin-bottom: 80px;" class="alert bg-success">'+json.response+'</div></div>');
					$('#name').val('');
					window.setTimeout(function() {
                        window.location = "/Client/Tracking_Control";
                    }, 1500);
				} else {
					$('#error').html('<div style="margin-top: -40px; margin-bottom: 80px;" class="alert bg-danger">'+json.response+'</div></div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});