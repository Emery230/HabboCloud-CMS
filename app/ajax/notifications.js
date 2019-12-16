$(document).ready(function() {
    $('#hc_view_notifications').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/notifications_view',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#hc_nb_notif').html('0');
				}
			}
        });
    });
});