var https = require('https');
var fs = require('fs');
var crypto = require('crypto');
var mysql = require('mysql');
var emoji = require('node-emoji');
var emoji_js = require('emoji-js'); 
var colors = require('colors');
var connection = mysql.createConnection({
	host: '',
	user: '',
	password: '',
	database: '',
	charset: 'utf8mb4'
});
var options = {
  key: fs.readFileSync('/etc/letsencrypt/live/shoutbox.habbo.cloud/privkey.pem'),
  cert: fs.readFileSync('/etc/letsencrypt/live/shoutbox.habbo.cloud/cert.pem'),
  ca: fs.readFileSync('/etc/letsencrypt/live/shoutbox.habbo.cloud/chain.pem')
};

var emojie = new emoji_js();

console.log('');
console.log('##     ##     ######  ##        #######  ##     ## ########  '.blue);
console.log('##     ##    ##    ## ##       ##     ## ##     ## ##     ## '.blue);
console.log('##     ##    ##       ##       ##     ## ##     ## ##     ## '.blue);
console.log('#########    ##       ##       ##     ## ##     ## ##     ## '.blue);
console.log('##     ##    ##       ##       ##     ## ##     ## ##     ## '.blue);
console.log('##     ##    ##    ## ##       ##     ## ##     ## ##     ## '.blue);
console.log('##     ##     ######  ########  #######   #######  ########  '.blue);
console.log('');

connection.connect(function(err){
	if(err){
		console.error('Impossible de se connecter ', err);
	}
});

httpsServer = https.createServer(options, function(req, res){
	console.log('Un utilisateur a affiche la page');
});

httpsServer.listen(8080);

var io = require('socket.io').listen(httpsServer);
var users = {};

console.log("La Shoutbox est maintenant -> " + "En ligne".green);

io.sockets.on('connection', function(socket){
	var me = false;
	var getLastComments = function(){
		connection.query('' +
			'SELECT * ' +
			'FROM hc_shoutbox ' +
			'LEFT JOIN hc_users ON hc_users.id = user_id ' +
			'ORDER BY created_at DESC ' +
			'LIMIT 30', function(err, rows){
			if(err){
				console.log('Erreur'.red +' -> Chargement message')
			} else {
				var messages = [];
				rows.reverse();
				for(k in rows){
					var row = rows[k];
					var message = {
						message: emojie.replace_colons(row.message),
						created_at: row.created_at,
						user: {
							id: row.user_id,
							username: row.username,
							rank: row.rank,
							avatar: row.avatar
						}
					};
					messages.push(message)
				}
				socket.emit('newmsg', messages)
			}
		})
	};

	for(var k in users){
		socket.emit('newusr', users[k]);
	}
	
	//listen on typing
	socket.on('typing', (data) => {
    	socket.broadcast.emit('typing', {username : me.username});
    })

	socket.on('newmsg', function(message){
		
		commandeban = message.message.split("/ban");
		commandeaccess = message.message.split("/");
		commandebot = message.message.split("/bot");
		commandeaverto = message.message.split("/averto");
		
		connection.query('SELECT count(*) as total FROM hc_bans WHERE username = ?', [
			me.username
		], function(err, result) {
 
			if(result[0].total == 0 || me.username == "Arwantys") {
				
				if(message.message.trim().length === 0) {
					socketuser = me.username;
					error = 'Vous devez entrer un message.';
					io.sockets.emit('error', error, socketuser);
				} else {
				
				if(message.message === '/clean') {
			connection.query('SELECT * FROM hc_users WHERE hc_users.id = ?', [
				me.id
			], function(err, rows){
				if(rows[0].rank >= 3) {
					connection.query('TRUNCATE hc_shoutbox');
					cleanmsg = 'clean';
					io.sockets.emit('clean', cleanmsg);
					console.log('Shoutbox'.blue +' -> '+ me.username +' vient de vider la Shoutbox.');
				} else {
					socketuser = me.username;
					error = 'Vous n\'avez pas la permission de vider la Shoutbox.';
					io.sockets.emit('error', error, socketuser);
					console.log('Attention'.red +' -> '+ me.username +' a essayé de vider la Shoutbox.');
				}
			});
			
		} else if (commandeban[1]) {
			connection.query('SELECT * FROM hc_users WHERE hc_users.id = ?', [
				me.id
			], function(err, rows){
				if(rows[0].rank >= 3) {
					
					if(commandeban[1].trim() != "Arwantys") {
					
					var myDate = new Date();
					
					function addDays(days) {
						var result = new Date();
						result.setDate(result.getDate() + days);
						return result;
					}
					
					connection.query('INSERT INTO hc_bans SET username = ?, type = ?, expiration = ?', [
						commandeban[1].trim(),
						'Shoutbox',
						addDays(1)
					], function (err) {
						if(err) {
							console.log('Erreur'.red +' -> Bannissement');
						} else {
							message.user = me;
							var id = me.id;
							var username = me.username;
							var rank = me.rank;
							var avatar = me.avatar;
							me.username = 'BOT';
							me.id = 2;
							me.rank = 3;
							me.avatar = '/app/assets/images/avatars/bot-avatar.png';
							message.created_at = Date.now();
							connection.query('INSERT INTO hc_shoutbox SET user_id = ?, message = ?, created_at = ?', [
								2,
								'vient de bannir '+commandeban[1].trim()+' de la Shoutbox',
								new Date(message.created_at)
							], function (err) {
								if(err){
									console.log('Erreur'.red +' -> Bannissement');
								} else {
									message.message = 'vient de bannir '+commandeban[1].trim()+' de la Shoutbox';
									io.sockets.emit('newmsg', message)
									me.id = id;
									me.username = username;
									me.rank = rank;
									me.avatar = avatar;
									console.log('Bannissement'.blue +' -> '+ me.username +' vient de bannir '+commandeban[1].trim()+' de la Shoutbox.');
								}
							})
						}
					});
					} else {
						socketuser = me.username;
						error = 'Vous n\'avez pas la permission de bannir un Dieu.';
						io.sockets.emit('error', error, socketuser);
						console.log('Attention'.red +' -> '+ me.username +' a essayé de bannir Arwantys.');
					}
				} else {
					socketuser = me.username;
					error = 'Vous n\'avez pas la permission de bannir un utilisateur.';
					io.sockets.emit('error', error, socketuser);
					console.log('Attention'.red +' -> '+ me.username +' a essayé de bannir un membre.')
				}
			});
			
		} else if (commandeaverto[1]) {
			connection.query('SELECT * FROM hc_users WHERE hc_users.id = ?', [
				me.id
			], function(err, rows){
				if(rows[0].rank >= 3) {
					
					if(commandeaverto[1].trim() != "Arwantys") {
					
					var myDate = new Date();
					
					function addDays(days) {
						var result = new Date();
						result.setDate(result.getDate() + days);
						return result;
					}
					
					connection.query('INSERT INTO hc_avertos SET username = ?, date = ?', [
						commandeaverto[1].trim(),
						new Date(Date.now())
					], function (err) {
						if(err) {
							console.log('Erreur'.red +' -> Avertissement');
						} else {
							message.user = me;
							var id = me.id;
							var username = me.username;
							var rank = me.rank;
							var avatar = me.avatar;
							me.username = 'BOT';
							me.id = 2;
							me.rank = 3;
							me.avatar = '/app/assets/images/avatars/bot-avatar.png';
							message.created_at = Date.now();
							connection.query('INSERT INTO hc_shoutbox SET user_id = ?, message = ?, created_at = ?', [
								2,
								'vient d\'avertir '+commandeaverto[1].trim()+'',
								new Date(message.created_at)
							], function (err) {
								if(err){
									console.log('Erreur'.red +' -> Avertissement');
								} else {
									message.message = 'vient d\'avertir '+commandeaverto[1].trim()+'';
									io.sockets.emit('newmsg', message)
									me.id = id;
									me.username = username;
									me.rank = rank;
									me.avatar = avatar;
									console.log('Avertissement'.blue +' -> '+ me.username +' vient d\'avertir '+commandeaverto[1].trim()+'.');
								}
							})
						}
					});
					} else {
						socketuser = me.username;
						error = 'Vous n\'avez pas la permission de bannir un Dieu.';
						io.sockets.emit('error', error, socketuser);
						console.log('Attention'.red +' -> '+ me.username +' a essayé de bannir Arwantys.');
					}
				} else {
					socketuser = me.username;
					error = 'Vous n\'avez pas la permission de bannir un utilisateur.';
					io.sockets.emit('error', error, socketuser);
					console.log('Attention'.red +' -> '+ me.username +' a essayé de bannir un membre.')
				}
			});
			
		} else if (commandebot[1]) {
			connection.query('SELECT * FROM hc_users WHERE hc_users.id = ?', [
				me.id
			], function(err, rows){
				if(rows[0].rank >= 4) {
					
				
					
					var myDate = new Date();
					
					function addDays(days) {
						var result = new Date();
						result.setDate(result.getDate() + days);
						return result;
					}
					
							message.user = me;
							var id = me.id;
							var username = me.username;
							var rank = me.rank;
							var avatar = me.avatar;
							me.username = 'BOT';
							me.id = 2;
							me.rank = 3;
							me.avatar = '/app/assets/images/avatars/bot-avatar.png';
							message.created_at = Date.now();
							connection.query('INSERT INTO hc_shoutbox SET user_id = ?, message = ?, created_at = ?', [
								2,
								emojie.replace_colons(commandebot[1].trim()),
								new Date(message.created_at)
							], function (err) {
								if(err){
									console.log('Erreur'.red +' -> Bannissement');
								} else {
									message.message = emojie.replace_colons(commandebot[1].trim());
									io.sockets.emit('newmsg', message)
									me.id = id;
									me.username = username;
									me.rank = rank;
									me.avatar = avatar;
									console.log('BOT'.blue +' -> ' + commandebot[1].trim());
								}
							})
					
				} else {
					socketuser = me.username;
					error = 'Vous n\'avez pas la permission d\'utiliser le BOT.';
					io.sockets.emit('error', error, socketuser);
					console.log('Attention'.red +' -> '+ me.username +' a essayé d\'utiliser le BOT.')
				}
			});
			
		} else if (me.id === undefined){
			
		} else {
			message.user = me;
			message.created_at = Date.now();
			
			function addSeconds(second, date) {
				var result = new Date(date);
				result.setSeconds(result.getSeconds() + second);
				return result;
			}
			
			
			
			connection.query('SELECT * FROM hc_shoutbox WHERE user_id = ? ORDER BY created_at DESC LIMIT 1', [
				me.id,
			], function (err, rows) {
				if(err){
					console.log('Erreur'.red +' -> Anti-Spam ')
				} else {
					if(me.rank == 2) {
						if(rows.length == 0 || new Date() >= addSeconds(2, rows[0].created_at)) {
							connection.query('INSERT INTO hc_shoutbox SET user_id = ?, message = ?, created_at = ?', [
								message.user.id,
								message.message,
								new Date(message.created_at)
							], function (err) {
								if(err){
									console.log('Erreur'.red +' -> Envoie message')
								} else {
									message.message = emojie.replace_colons(message.message);
									io.sockets.emit('newmsg', message);
									console.log('Message'.green +' -> ['+ me.username +']: ' + message.message)
								}
							})
					
						} else {
							socketuser = me.username;
							error = 'Un message tous les 2 secondes';
							io.sockets.emit('error', error, socketuser);
						}
						
					} else {
						if(me.username === 'Arwantys' || rows.length == 0 || new Date() >= addSeconds(5, rows[0].created_at)) {
							connection.query('INSERT INTO hc_shoutbox SET user_id = ?, message = ?, created_at = ?', [
								message.user.id,
								message.message,
								new Date(message.created_at)
							], function (err) {
								if(err){
									console.log('Erreur'.red +' -> Envoie message')
								} else {
									
										message.message = emojie.replace_colons(message.message);
										io.sockets.emit('newmsg', message)
										console.log('Message'.green +' -> ['+ me.username +']: ' + message.message)
									
								}
							})
					
						} else {
							socketuser = me.username;
							error = 'Un message tous les 5 secondes';
							io.sockets.emit('error', error, socketuser);
						}
					}
				}
			})
			
			
		}
				}
			} else {
				socketuser = me.username;
				error = 'Vous êtes banni de la Shoutbox.';
				io.sockets.emit('error', error, socketuser);
				console.log('Attention'.red +' -> '+ me.username +' essaye de parler alors qu\'il est banni.');
			}
 
		});
	});

	socket.on('login', function(user){
		connection.query('SELECT * FROM hc_users WHERE id = ?', [user.id], function (err, rows, fields) {
			if(err){
				console.log('Erreur -> Connexion -> Login')
			}else if(rows.length === 1 && rows[0].sso === user.token) {
				me = {
					username: rows[0].username,
					id: rows[0].id,
					avatar: rows[0].avatar,
					rank: rows[0].rank
				};
				socket.emit('logged');
				users[me.id] = me;
				io.sockets.emit('newusr', me);
				getLastComments()
			} else {
				io.sockets.emit('error', 'Aucun utilisateur ne correspond');
			}
		})
	});

	socket.on('disconnect', function(){
		if(!me){
			return false;
		} else {
			delete users[me.id];
			io.sockets.emit('disusr', me);
		}
	})


});