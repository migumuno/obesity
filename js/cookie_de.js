document.write("<style>.cookies_obesity_ok p{color:#fff !important}.cookies_obesity_ok{display:block;position:fixed;z-index:100;bottom:0;width:100%;background:rgba(0,0,0,0.8);color:#fff;font-size:11px;font-family:sans-serif}.cookies_obesity_ok p{margin:0 auto;padding:10px 0 0 30px}.cookies_obesity_ok p a:link,.cookies_obesity_ok p a:active,.cookies_obesity_ok p a:visited,.cookies_obesity_ok p a:hover{color:#fff}.cookies_obesity_ok a.close{float:left;display:block;width:16px;height:25px;background:url(http://www.obesity.es/img/cookie.png) 0 -45px no-repeat;overflow:hidden;text-indent:-80px;opacity:0.5;margin:0 20px 0 0}a.close:hover{opacity:1}</style>");



/*!
 * jQuery Cookie Plugin v1.4.0
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as anonymous module.
		define(['jquery'], factory);
	} else {
		// Browser globals.
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}
	
	

	var config = $.cookie = function (key, value, options) {

		// Write
		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}
			
			var expire=new Date();
		    expire=new Date(expire.getTime()+7776000000);
		    /*document.cookie="cookies_obesity_ok=aceptada; expires="+expire;*/
		    var exdate=new Date();
		    exdate.setDate(exdate.getDate() + 90);
		    var c_value=escape('aceptada') + ((90==null) ? "" : "; expires="+exdate.toUTCString());
		    document.cookie='cookies_obesity_ok' + "=" + c_value + ";domain=.obesity.es;path=/";
			
			/*return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));*/
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));




$(document).ready(function() 
{
	if (!$.cookie("cookies_obesity_ok"))
	{
		$("body").prepend("<div class='cookies_obesity_ok'><p><a href='#' class='close'>Nachricht schließen</a>Diese Website verwendet Cookies. Indem Sie weiter auf dieser Website navigieren, ohne die Cookie-Einstellungen Ihres Internet Browsers zu ändern, stimmen Sie unserer Verwendung von Cookies zu. <a href='/legal'>Mehr Informationen</a></p></div>");
		
		$("body").on("click", ".close", function(e) {
			e.preventDefault();
			$.cookie('cookies_obesity_ok', 'aceptado');
			$(".cookies_obesity_ok").fadeOut();
		});
	}
});