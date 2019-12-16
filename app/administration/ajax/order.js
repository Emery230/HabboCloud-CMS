$(document).ready(function() {
    $('#hc_order_waiting').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/admin_order_waiting/'+name+'/'+extension+'/'+solution+'/'+cms+'/'+emulator+'/'+sso+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = "/administration/commandes/waiting";
                    }, 1500);
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

$(document).ready(function() {
    $('#hc_order_actives').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/admin_order_actives/'+name+'/'+extension+'/'+sso+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = "/administration/commandes/actives";
                    }, 1500);
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

$(document).ready(function() {
    $('#hc_order_refund').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../../system/ajax/admin_order_refund/'+name+'/'+extension+'/'+solution+'/'+sso+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = "/administration/";
                    }, 1500);
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

$(document).ready(function() {
    $('.supprsusp').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);
		var idretro = $this.attr('id');
		
        $.ajax({
            url: '../../../system/ajax/admin_order_suspended/'+idretro+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = "/administration/commandes/suspended";
                    }, 1500);
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

$(document).ready(function() {
    $('#hc_order_swf').on('submit', function(e) {
        e.preventDefault();

        var $this = $(this);
		var idretro = $this.attr('id');
		
        $.ajax({
            url: '../../../system/ajax/admin_order_swf/'+name+'/'+extension+'/'+sso+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div class="alert alert-success">'+json.response+'</div>');
					window.setTimeout(function() {
                        window.location = "/administration/commandes/swfs";
                    }, 1500);
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