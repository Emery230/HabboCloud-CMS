var startTchat;

(function($){

	var socket = io.connect('https://shoutbox.habbo.cloud:8080');
	var msgtpl = $('#msgtpl').html();
	var lastmsg= false;

	$('#msgtpl').remove();

	startTchat = function(user_id, token){
		socket.emit('login', {
			id: user_id,
			token: token
		});
	}

	socket.on('logged', function(event){
		
	});

	socket.on('reconnecting', function(event){
		$('#status_shout').html('Statut: <span style="color: red">déconnecté</span>');
	});
	
	socket.on('connect', function(data){
		$('#status_shout').html('Statut: <span style="color: green">connecté</span>');
	});
	
	$('#message').bind("keypress", () => {
		socket.emit('typing')
	});

	socket.on('typing', (data) => {
		$('#typing').html("<p><i>" + data.username + " est entrain d'écrire..." + "</i></p>")
	});
	

	$('#shoutboxmsg').submit(function(event){
		event.preventDefault();
		socket.emit('newmsg', {message: $('#message').val() });
		$('#message').val('');
		$('#message').focus();
	})

	socket.on('newmsg', function(messages){
		if(!Array.isArray(messages)){
			messages = [messages]
		}
		for(k in messages){
			var message = messages[k];
			var datemin = new Date(message.created_at);
			message.h = new Date(message.created_at).getHours();
			message.m = datemin.getMinutes() < 10 ? '0' + datemin.getMinutes() : datemin.getMinutes();
			if(lastmsg != message.user.id){
				$('#messages').prepend('<div class="sep"></div>');
				lastmsg = message.user.id;
			}
			$('#typing').html('');
			$('#messages').prepend('<div class="message">' + Mustache.render(msgtpl, message) + '</div>');
		}
		$('#messages').animate({scrollTop : $('#messages').prop('scrollHeight') }, 500);
	});

	socket.on('newusr', function(user){
		if(user.username) {
			$('#' + user.id).remove();
		}
		$('#users').append('<span class="'+RankGroupe(user.rank)+'" id="'+ user.id +'">' + user.username + ', </span>');
	})

	socket.on('disusr', function(user){
		$('#' + user.id).remove();
	})
	
	socket.on('clean', function(clean){
		$('.shout').empty();
	})
	
	socket.on('error', function(error, socketuser){
		if(UsernameSession == socketuser) {
			$('#error').html('<div style="margin-top: -30px; margin-bottom: 60px;" class="alert bg-danger">'+error+'</div></div>')
			setTimeout(function(){
				$('#error').empty();
			}, 3000);
		}
	})
	

})(jQuery);