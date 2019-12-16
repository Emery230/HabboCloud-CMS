$(document).ready(function() {
    $('#hc_tracking_control').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/tracking_control',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#suivi').html('<div class="panel panel-white"><div class="panel-body"><center>'+json.response+'</center></div></div>');
				} else {
					$('#suivi').html('<div class="panel panel-white"><div class="panel-body"><center>'+json.response+'</center></div></div>');
				}
		   }

        });
    });
});