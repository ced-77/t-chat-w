$(document).ready(function(){

	$( 'button.close' ).click( function( e ) {
		e.preventDefault();
		// $(this).attr('data-dismiss');
		var dataDismiss = $(this).data('dismiss');

		// closet selectionne l'element le plus proche 
		$(this).closest('.'+dataDismiss).remove();

	});

	$('#enClaire').click(function(event){ 
		// annulation du comportement par defautl
		event.preventDefault(); 

		var attribumotDePasse = $('#mot_de_passe').attr('type');

			// controle de l'attribue
				if (attribumotDePasse == 'password'){
					$('#mot_de_passe').attr('type',"text");
					$('#enClaire').text('Caché');	

				} else { 
					$('#mot_de_passe').attr('type',"password");
					$('#enClaire').text('En claire');
				}
		// fin de la condition
	});

});