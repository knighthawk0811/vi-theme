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
	var cookie_name = 'urgent_notice_popup'; // The cookie name
	var cookie_increment = 2; // number of times to incerment

	//const time_now = Date.now();
	const expiry_length = 0.04 * 24 * 60 * 60 * 1000;//~ 1 hours
	//const cookie_expiry = time_now + expiry_length; // Cookie expiry date


	//initialize the value
	//return the new value
	function init_value()
	{
		//
		var value = get_storage(cookie_name, true);
		if ( value == null)
		{
			value = 0;
			set_storage( cookie_name, value, expiry_length );
		}
		return value;
	}
	//increment the value
	//return the new value
	function increment_value()
	{
		var value = init_value();
		set_storage( cookie_name, ++value, expiry_length );
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
		//init_value();
		if( init_value() < cookie_increment )
		{
			action = true;
		}

		//alert(action + ', ' + init_value() + ', ' + get_storage(cookie_name, true) );//***************
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



/**
 * set local storage with or without an expiration time
 * expiry matters most when reading or deleting
 *
 * test if localStorage/sessionStorage is both supported and available
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Web_Storage_API/Using_the_Web_Storage_API
 * @link https://www.sohamkamani.com/blog/javascript-localstorage-with-ttl-expiry/
 * @version 8.3.200714
 * @since 8.3.200714
 */
function storage_available( type )
{
	//storage_available('localStorage');// last forever, unless we are using the expiry below
	//storage_available('sessionStorage');// last for a session

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

function create_storage( key, value = true, ttl = 0 )
{
	//not sure how this is different than update
	//alternative for update_storage
	return update_storage( key, value, ttl);
}

function get_storage( key, expiry = false )
{
	//alternative for read_storage
	return read_storage( key, expiry );
}
function read_storage( key, expiry = false )
{
	var value = false;
	if ( storage_available('localStorage') )
	{
		//We can use localStorage
		// delete if expired?
		if( expiry )
		{
			//delete if expired
			delete_storage(key, true);
		}

		const itemStr = localStorage.getItem(key);
		// if the item doesn't exist, return null
		if (!itemStr)
		{
			value = null;
		}
		else
		{
			const item = JSON.parse(itemStr);
			value = item.value;
		}
	}
	else
	{
		//We have to use cookies
		if( document.cookie.split( '; ' ).find( row => row.startsWith( key ) ) )
		{
			value = document.cookie.split('; ').find(row => row.startsWith( key )).split('=')[1];
		}
	}
	return value;
}

function set_storage( key, value = 0, ttl = 0)
{
	//alternative for update_storage
	return update_storage( key, value, ttl);
}
function update_storage( key, value = 0, ttl = 0)
{
	var output = false;
	//const now = new Date();
	const time_now = Date.now();
	var expiration = time_now + ttl;
	if ( storage_available('localStorage') )
	{
		//We can use localStorage
		output = true;
		// `item` is an object which contains the original value
		// as well as the time when it's supposed to expire
		const item = {
			value: value,
			expiry: expiration
		};
		localStorage.setItem(key, JSON.stringify(item));
	}
	else
	{
		//We have to use cookies
		document.cookie = "" + key + "=" + value + "; expires=" + expiration.toUTCString() + "; sameSite=Strict";
	}
	return output;
}
function delete_storage( key, expiry = false)
{
	var output = false;
	if ( storage_available('localStorage') )
	{
		//We can use localStorage
		const itemStr = localStorage.getItem(key)
		// if the item doesn't exist, return null
		if (itemStr)
		{
			const item = JSON.parse(itemStr)
			//confirm for deletion by default
			confirm = true;
			//check if we care about the expiration date
			if( expiry )
			{
				const now = new Date()
				const time_now = Date.now();
				// compare the expiry time of the item with the current time
				//if NOT expired the unconfirm the deletion
				if (time_now < item.expiry)
				{
					confirm = false;
				}
			}
			if( confirm )
			{
				// delete the item from storage
				localStorage.removeItem(key)
				output = true;
			}
		}
	}
	else
	{
		//We have to use cookies
		if( !expiry )
		{
			document.cookie = "" + key + "=false; expires=Thu, 01 Jan 1970 00:00:00 GMT; sameSite=Strict";

		}
	}
	return output;
}
