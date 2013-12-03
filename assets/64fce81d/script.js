$(function() {
	$( "#hybridauth-openid-div" ).dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			resizable: false,
			title: 'Open ID Provider',
			buttons: {
				"Login": function() {
					$('#hybridauth-openid-form').submit();
				}
				,
				Cancel: function() {
					$(this).dialog( "close" );
				}
			}
	});

	$("li.inactive #hybridauth-openid").click(function() {
		event.preventDefault();
		$( "#hybridauth-openid-div").dialog( "open" );
	});
	
	$( "#hybridauth-confirmunlink" ).dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			resizable: false,
			title: 'Unlink Provider',
			buttons: {
				"Unlink": function() {
					$('#hybridauth-unlink-form').submit();
				}
				,
				Cancel: function() {
					$(this).dialog( "close" );
				}
			}
	});
	
	$('.hybridauth-providerlist li.active a').click(function(e) {
		e.preventDefault();
		$('#hybridauth-unlinkprovider').val(this.id.split('-')[1]);
		$( "#hybridauth-confirmunlink").dialog( "open" );
		
	});
	
});