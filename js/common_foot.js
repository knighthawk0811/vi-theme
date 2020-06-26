/**
 * version_8_js_foot.js
 * loaded in the footer
 *
 * @link
 * @version 8.3.190625
 */
 "use strict";






/**
 * Do Things Only Once
 *
 * @link
 * @version 7.2.190415
 * @since 7.2.190415
 */
var event_call_function_once = (function ()
{
	var timers = {};
	return function (callback, ms, uniqueId)
	{
		if (!ms)
		{
			ms = 2000;
		}
		if (!uniqueId)
		{
			uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId])
		{
			clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();





jQuery(document).ready(function(){
	//set the GCS placeholder text
	//wait until we click it, because we can't be faster than GCS loading
	jQuery("#modal-button").click(function(event){
		jQuery("#gsc-i-id1").attr("placeholder", "Search");
	});
});

//bootstrap modals, help with z-index
/*
jQuery('.modal-dialog').parent().on('show.bs.modal', function(e){
	jQuery(e.relatedTarget.attributes['data-target'].value).appendTo('body');
});
*/


/**
 * modal menu toggling function
 *
 * @link
 * @version 8.3.190923
 * @since 8.3.190923
 */
jQuery(document).ready(function(){
	//side-nav and modal slide
	//ON and OFF
	jQuery("#modal-button a").click(function(event){
		jQuery("body").toggleClass( "modal-main-toggle-on" );
	});
	//secondary OFF
	jQuery("#modal-main-shade").click(function(event) {
		jQuery("body").removeClass( "modal-main-toggle-on" );
	});
});

/**
 * modal inner menu toggling function
 *
 * @link
 * @version 8.3.190923
 * @since 8.3.190923
 */
jQuery(document).ready(function()
{
	jQuery("#nav-modal ul.menu a[href='#']").click(function(event){
		jQuery(this).parent().toggleClass( "toggle-on" );
		jQuery(this).parent().siblings().removeClass( "toggle-on" );
	});
});


(function ()
{

	var cookie_name = 'urgent_notice_3'; // The cookie name

	var cookie_expiry = new Date(); // Cookie expiry in days
	cookie_expiry.setTime(cookie_expiry.getTime() + ( 0.3 * 24 * 60 * 60 * 1000 ));//~ 8 hours


	// Show the popup on load if cookie is not previously stored
	// then store the cookie so it will remember
	function do_this_once()
	{
		if ( !document.cookie.split( '; ' ).find( row => row.startsWith( cookie_name ) ) )
		{
			jQuery('#sidebar-urgent-notice-3').addClass('show');// notice ID

			document.cookie = "" + cookie_name + "=true; expires=" + cookie_expiry + "; sameSite=Strict";
		}
	}
	function show_this_thing()
	{
		if ( !document.cookie.split( '; ' ).find( row => row.startsWith( cookie_name ) ) )
		{
			jQuery('#sidebar-urgent-notice-3').addClass('show');// notice ID
		}
	}
	function hide_this_thing()
	{
		jQuery('#sidebar-urgent-notice-3').removeClass('show');// notice ID
		document.cookie = "" + cookie_name + "=true; expires=" + cookie_expiry + "; sameSite=Strict";
	}

	jQuery( document ).ready( function() {
		show_this_thing();
	});

	// Modal dismiss button
	jQuery('#sidebar-urgent-notice-3-button').on('click', function ()
	{
		hide_this_thing();
	});

})();