$(document).ready(function() {
    $('#sondage_like').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/surveys/like/'+idsondage,
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#liketotal').html(json.response);
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

$(document).ready(function() {
    $('#sondage_dislike').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/surveys/dislike/'+idsondage,
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#disliketotal').html(json.response);
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