<?php
	
//	quand on essaye d'acceder à localhost/cedric/t-chat-w/public/
// l'url qui esst reelement reçus est : localhost/cedric/t-chat-w/index.php
// GET pour dire que cela passera par l'url

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/test', 'Test#monAction', 'test_index'],
		['GET', '/users', 'User#listUsers', 'users_list'],
		['GET|POST', '/salon/[i:id]', 'Salon#seeSalon', 'see_salon' ],
		['GET|POST', '/login', 'User#login', 'login' ],
		['GET', '/logout', 'User#logout', 'logout' ],
		['GET|POST', '/register', 'User#register', 'register'],
		// cette route va etre axessible en ajax et va servir à renvoyer les messagess d'un salon qui ont été 
		// posté depuis un id donné
		['GET', '/newmessages/[i:idSalon]/[i:idMessage', 'Salons#newMessages', 'new_messages' ]
	);