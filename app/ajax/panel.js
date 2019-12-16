$(document).ready(function() {
    $('#hc_bdd').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/reinstall_bdd/'+host+'/'+user+'/'+password+'/'+database+'/'+retroid+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible"><div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Succès!</strong> '+json.response+'</div></div>');
				} else {
					$('#error').html('<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible"><div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Erreur!</strong> '+json.response+'</div></div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});

$(document).ready(function() {
    $('#hc_swf').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/order_swf/'+retroid+'',
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#errorop').html('<div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible"><div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Succès!</strong> '+json.response+'</div></div>');
				} else {
					$('#errorop').html('<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible"><div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Erreur!</strong> '+json.response+'</div></div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});

$(document).ready(function() {
    $('#hc_renouvellement').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '/system/ajax/renouvellement/'+retroid,
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success') {
					$('#error').html('<div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible"><div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Succès!</strong> '+json.response+'</div></div>');
				} else {
					$('#error').html('<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible"><div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Erreur!</strong> '+json.response+'</div></div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});

$(document).ready(function() {
    $('#hc_renouvellement_auto').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: '../../system/ajax/renouvellement_auto/'+retroid,
            type: 'POST',
            data: $this.serialize(),
            dataType: 'json',
			success: function(json){
				if(json.status === 'success_active') {
					$('#errorop').html('<div role="alert" class="alert bg-success">'+json.response+'</div>');
					$('#hc_renouvellement_auto').html('<i class="fa fa-angle-right"></i> Désactiver');
					$('#ren_auto_t').html('Oui')
				} else if(json.status === 'success_desactive') {
					$('#errorop').html('<div role="alert" class="alert bg-success">'+json.response+'</div>');
					$('#hc_renouvellement_auto').html('<i class="fa fa-angle-right"></i> Activer');``
					$('#ren_auto_t').html('Non');
				} else {
					$('#errorop').html('<div role="alert" class="alert bg-danger">'+json.response+'</div>');
					setTimeout(function(){
						$('#error').empty();
					}, 2000);
				}
		   }

        });
    });
});