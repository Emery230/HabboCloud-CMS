$(document).ready(function() {
    $('#hc_login').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/login',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = json.url;
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