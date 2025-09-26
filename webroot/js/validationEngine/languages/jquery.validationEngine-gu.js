(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* આ ક્ષેત્ર જરૂરી છે",
                    "alertTextCheckboxMultiple": "* કૃપા કરીને એક વિકલ્પ પસંદ કરો",
                    "alertTextCheckboxe": "* આ ચેકબોક્સ જરૂરી છે",
                    "alertTextDateRange": "* બંને તારીખ શ્રેણી ફીલ્ડ આવશ્યક છે"
                },
                "requiredInFunction": { 
                    "func": function(field, rules, i, options){
                        return (field.val() == "test") ? true : false;
                    },
                    "alertText": "* ફીલ્ડ ટેસ્ટ સમાન હોવું જોઈએ"
                },
                "dateRange": {
                    "regex": "none",
                    "alertText": "* અમાન્ય",
                    "alertText2": "તારીખ શ્રેણી"
                },
                "dateTimeRange": {
                    "regex": "none",
                    "alertText": "અમાન્ય",
                    "alertText2": "તારીખ શ્રેણી"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* ન્યૂનતમ",
                    "alertText2": "અક્ષરો જરૂરી"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* મહત્તમ",
                    "alertText2": "અક્ષરો માન્ય છે"
                },
		"groupRequired": {
                    "regex": "none",
                    "alertText": "* તમારે નીચેનામાંથી એક ફીલ્ડ ભરવાનું રહેશે",
                    "alertTextCheckboxMultiple": "* કૃપા કરીને એક વિકલ્પ પસંદ કરો",
                    "alertTextCheckboxe": "* આ ચેકબોક્સ જરૂરી છે"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* ન્યૂનતમ મૂલ્ય છે"
                },
                "max": {
                    "regex": "none",
                    "alertText": "* મહત્તમ મૂલ્ય છે"
                },
                "past": {
                    "regex": "none",
                    "alertText": "* પહેલાની તારીખ"
                },
                "future": {
                    "regex": "none",
                    "alertText": "* ભૂતકાળની તારીખ"
                },	
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* મહત્તમ",
                    "alertText2": "વિકલ્પોની મંજૂરી"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* કૃપા કરી પસંદ કરો",
                    "alertText2": "વિકલ્પો"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* ક્ષેત્રો મેળ ખાતા નથી"
                },
                "creditCard": {
                    "regex": "none",
                    "alertText": "* અમાન્ય ક્રેડિટ કાર્ડ નંબર"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
                    "alertText": "* અમાન્ય ફોન નંબર"
                },
                "email": {
                    // HTML5 compatible email regex ( http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#    e-mail-state-%28type=email%29 )
                    "regex": /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                    "alertText": "* અમાન્ય ઇમેઇલ સરનામું"
                },
                "fullname": {
                    "regex":/^([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]*)+[ ]([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]+)+$/,
                    "alertText":"* પ્રથમ અને છેલ્લું નામ હોવું આવશ્યક છે"
                },
                "zip": {
                    "regex":/^\d{5}$|^\d{5}-\d{4}$/,
                    "alertText":"* અમાન્ય ઝિપ ફોર્મેટ"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* માન્ય પૂર્ણાંક નથી"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
                    "alertText": "* અમાન્ય ફ્લોટિંગ દશાંશ સંખ્યા"
                },
                "date": {                    
                    //	Check if date is valid by leap year
			"func": function (field) {
					var pattern = new RegExp(/^(\d{4})[\/\-\.](0?[1-9]|1[012])[\/\-\.](0?[1-9]|[12][0-9]|3[01])$/);
					var match = pattern.exec(field.val());
					if (match == null)
					   return false;
	
					var year = match[1];
					var month = match[2]*1;
					var day = match[3]*1;					
					var date = new Date(year, month - 1, day); // because months starts from 0.
	
					return (date.getFullYear() == year && date.getMonth() == (month - 1) && date.getDate() == day);
				},                		
			 "alertText": "* અમાન્ય તારીખ, YYYY-MM-DD ફોર્મેટમાં હોવી આવશ્યક છે"
                },
                "ipv4": {
                    "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* અમાન્ય IP સરનામું"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* અમાન્ય URL"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* માત્ર નંબરો"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \u3300-\u9fff\uf900-\ufaff\u00C0-\u00ff\u0500-\u05FF']+$/,
                    "alertText": "* માત્ર પત્રો"
                },
				"onlyLetterAccentSp":{
                    "regex": /^[a-z\u00C0-\u017F\ ]+$/i,
                    "alertText": "* માત્ર અક્ષરો (ઉચ્ચારો મંજૂર)"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* કોઈ વિશિષ્ટ અક્ષરોની મંજૂરી નથી"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
				/* Change */
				"onlyLetterNumberSp": {
                    "regex": /^[0-9a-zA-Z\s-]+$/,
                    "alertText": "* કોઈ વિશિષ્ટ અક્ષરોની મંજૂરી નથી"
                },
				/* end change */
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* આ વપરાશકર્તા પહેલેથી જ લેવામાં આવ્યો છે",
                    "alertTextLoad": "* માન્ય કરી રહ્યું છે, કૃપા કરીને રાહ જુઓ"
                },
				"ajaxUserCallPhp": {
                    "url": "phpajax/ajaxValidateFieldUser.php",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* આ વપરાશકર્તા નામ ઉપલબ્ધ છે",
                    "alertText": "* આ વપરાશકર્તા પહેલેથી જ લેવામાં આવ્યો છે",
                    "alertTextLoad": "* માન્ય કરી રહ્યું છે, કૃપા કરીને રાહ જુઓ"
                },
                "ajaxNameCall": {
                    // remote json service location
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* આ નામ પહેલેથી જ લેવામાં આવ્યું છે",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* આ નામ ઉપલબ્ધ છે",
                    // speaks by itself
                    "alertTextLoad": "* માન્ય કરી રહ્યું છે, કૃપા કરીને રાહ જુઓ"
                },
				 "ajaxNameCallPhp": {
	                    // remote json service location
	                    "url": "phpajax/ajaxValidateFieldName.php",
	                    // error
	                    "alertText": "* આ નામ પહેલેથી જ લેવામાં આવ્યું છે",
	                    // speaks by itself
	                    "alertTextLoad": "* માન્ય કરી રહ્યું છે, કૃપા કરીને રાહ જુઓ"
	                },
                "validate2fields": {
                    "alertText": "* કૃપા કરીને હેલો ઇનપુટ કરો"
                },
	            //tls warning:homegrown not fielded 
                "dateFormat":{
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
                    "alertText": "* અમાન્ય તારીખ"
                },
                //tls warning:homegrown not fielded 
				"dateTimeFormat": {
	                "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/,
                    "alertText": "* અમાન્ય તારીખ અથવા તારીખ ફોર્મેટ",
                    "alertText2": "અપેક્ષિત ફોર્મેટ:",
                    "alertText3": "mm/dd/yyyy hh:mm:ss AM|PM અથવા", 
                    "alertText4": "yyyy-mm-dd hh:mm:ss AM|PM"
	            }
            };
            
        }
    };

    $.validationEngineLanguage.newLang();
    
})(jQuery);
