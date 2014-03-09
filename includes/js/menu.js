jQuery(document).ready( function(){

	jQuery( '.genesis-nav-menu' ).addClass( 'header-menu' ).before( '<div id="header-menu-icon" class="fa fa-bars fa-lg"></div>' );

	jQuery( '#header-menu-icon' ).click( function() {
		jQuery( '.genesis-nav-menu').fadeToggle();
	} );

});