/**
 * version_8_js_foot.js
 * loaded in the footer
 *
 * @link
 * @version 8.3.200713
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



jQuery(document).ready(function()
{
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
jQuery(document).ready(function()
{
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


/**
 * autorun function to set local storage
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie
 * @version 8.3.200713
 * @since 8.3.200709
 */
(function ()
{
	var cookie_name = 'cookie_consent'; // The cookie name
	var cookie_increment = 3; // number of times to incerment

	const time_now = Date.now();
	const expiry_length = 0.04 * 24 * 60 * 60 * 1000;//~ 1 hours
	const cookie_expiry = time_now + expiry_length; // Cookie expiry date


	/**
	 * test if localStorage/sessionStorage is both supported and available
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Web_Storage_API/Using_the_Web_Storage_API
	 * @version 8.3.200713
	 * @since 8.3.200713
	 */
	function storage_available(type)
	{
	    var storage;
	    try
	    {
	        storage = window[type];
	        var x = '__storage_test__';
	        storage.setItem(x, x);
	        storage.removeItem(x);
	        return true;
	    }
	    catch(e)
	    {
	        return e instanceof DOMException && (
	            // everything except Firefox
	            e.code === 22 ||
	            // Firefox
	            e.code === 1014 ||
	            // test name field too, because code might not be present
	            // everything except Firefox
	            e.name === 'QuotaExceededError' ||
	            // Firefox
	            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
	            // acknowledge QuotaExceededError only if there's something already stored
	            (storage && storage.length !== 0);
	    }
	}

	//set if it's the first time, don't override if it's already set
	function create_expiry(input)
	{
		var value = cookie_expiry;
		if ( storage_available('localStorage') )
		{
			//We can use localStorage
			var name = input + '_expiry';

			if( localStorage.getItem(name) )
			{
				value = localStorage.getItem(name);
			}
			else
			{
				localStorage.setItem(name, value);

			}
		}
		return value;
	}
	//check that the value isn't expired
	//returns boolean
	function check_expiry(input)
	{
		create_expiry(input);
		var value = true;//true == not expired
		if ( storage_available('localStorage') )
		{
			//We can use localStorage
			var name = input + '_expiry';
			if( localStorage.getItem(name) < time_now )
			{
				//expiry date already happened
				value = false;
				delete_expiry(input);
			}
		}
		return value;
	}
	//update the expiry date
	function update_expiry(input)
	{
		if ( storage_available('localStorage') )
		{
			//We can use localStorage
			var name = input + '_expiry';
			localStorage.setItem(name, cookie_expiry);
		}
	}
	//force the expiry to happen
	function delete_expiry(input)
	{
		if ( storage_available('localStorage') )
		{
			//We can use localStorage
			var name = input + '_expiry';
			localStorage.removeItem(name);
			set_value(0);
		}
	}

	//increment the value
	//return the new value
	function increment_value()
	{
		var value = get_value()
		return set_value( ++value );
	}

	//get and return the value
	function get_value()
	{
		var value = 0;
		if ( storage_available('localStorage') )
		{
			//We can use localStorage
			if( check_expiry(cookie_name) && localStorage.getItem(cookie_name) )
			{
				value = Number( localStorage.getItem(cookie_name) );
			}
		}
		else
		{
			//We have to use cookies
			if( document.cookie.split( '; ' ).find( row => row.startsWith( cookie_name ) ) )
			{
				value = Number( document.cookie.split('; ').find(row => row.startsWith( cookie_name )).split('=')[1] );
			}
		}
		return value;
	}
	//set a new value
	function set_value(input)
	{
		var value = Number( input );
		if ( storage_available('localStorage') )
		{
			//We can use localStorage
			create_expiry(cookie_name);
			localStorage.setItem(cookie_name, value);
		}
		else
		{
			//We have to use cookies
			document.cookie = "" + cookie_name + "=" + value + "; expires=" + cookie_expiry + "; sameSite=Strict";
		}
		return value;
	}



	// Show the popup on load if cookie is not previously stored
	// then store the cookie so it will remember
	function do_this_once()
	{
		var action = false;
		if( increment_value() == 1 )
		{
			action = true;
		}

		start_the_action(action);
	}
	function do_this_multiple_times()
	{
		var action = false;
		if( get_value() < cookie_increment )
		{
			action = true;
		}

		start_the_action(action);
	}
	function start_the_action(action = true)
	{
		if(action)
		{
			jQuery('#sidebar-urgent-notice-3').addClass('show');// notice ID
		}

	}
	function stop_the_action(action = false)
	{
		if(!action)
		{
			jQuery('#sidebar-urgent-notice-3').removeClass('show');// notice ID
			increment_value();
		}
	}

	jQuery( document ).ready( function() {
		//do_this_once()
		do_this_multiple_times();
	});

	// Modal dismiss button
	jQuery('#sidebar-urgent-notice-3-button').on('click', function ()
	{
		stop_the_action();
	});

})();


/**
 * aspect-ratio 2.0
 *
 * @link
 * @version 8.3.200706
 * @since 8.3.200706
 */
jQuery(document).ready(function()
{
	jQuery(".aspect-ratio").css('background-image', function(index){
		jQuery(this).find( 'img' ).css( "opacity", "0" );

		var first_image = jQuery(this).find( 'img' ).first();
		index = jQuery(first_image).attr( "src" );
		return  'url(' + index + ')';
	});
});

