/*
 * forest-themes-list.js v.0.1
 *
 * TERMS OF USE
 *
 * Open source under the BSD License.
 *
 * Copyright © 2014 MediaClaim
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
*/
jQuery(document).ready(function(e) {
	jQuery(".landscape-image-magnifier","#ftl_gallery").each(function(index, element) {
        jQuery(this).webuiPopover({
			placement: 'auto',
			width	 : '400px',
			title    : jQuery(this).attr('data-item-name'),
			content  : '<img src="' + jQuery(this).attr('data-preview-url') + '" style="width:372px; height:189px" />',
			trigger  : 'hover',
			style	 : 'inverse'
		});
		var themeName = jQuery(this).attr("data-item-name");
		/* ADD Evanto Username refer if exist */
		var newThemeUrl;
		if ( empty(ftl_evanto_username) ) {
			newThemeUrl = 'http://themeforest.net'+jQuery(this).parent().attr('href');		
		}else{
			newThemeUrl = 'http://themeforest.net'+jQuery(this).parent().attr('href')+'&ref='+ftl_evanto_username;
		}
		jQuery(this).parent().attr('href',newThemeUrl).attr('target','_blank');
		/* Active advanced options */
		if ( !empty(ftl_active_form) ) {
			/* Add select button */
			jQuery(this).closest('.web-graphic').find('.sale-info--search').each(function(index, element) {
                jQuery(this).append('<input type="button" value="'+ ftl_lang.ftl_bt_seleziona +'" class="button button-primary ftl_selectButton" onclick="ftl_selectedTheme(\''+themeName+'\',\''+newThemeUrl+'\')" />');
            });
			/* Hide next form */
			jQuery("#ftl_container").parent().find("form").hide();
		}
    });
	
	jQuery("a","#ftl_pagination").each(function(index, element) {
		var url = jQuery(this).attr("href");
		var query = url.split('&');
		var pkey = 'page=';
		var page;
		for( var i=0; i < query.length; i++ ){
			if(query[i].indexOf(pkey) > -1){
				page = query[i].replace(pkey,'');
			}
		}
		var newUrl = window.location.protocol+'//' + window.location.host + window.location.pathname + "?ftl_page=" + page;
		jQuery(this).attr("href",newUrl);
	});	
	
	/* Currency Exchange */
	if ( !empty(ftl_price_change) ) {
		if ( empty(ftl_price_symbol) ) ftl_price_symbol = '$';
		jQuery(".price","#ftl_gallery").each(function(index, element) {
			var price_string = jQuery(this).text();
			var price = price_string.replace('$','');
			var newPrice = Math.ceil(parseFloat(price) * parseFloat(ftl_price_change));
			//var numero_arrotondato = Math.round(newPrice*Math.pow(10,2))/Math.pow(10,2);
			jQuery(this).text(ftl_price_symbol+' '+newPrice);
		});
	}
	
	
	
}); // document

/* After theme selected */
var ftl_pageContent;
function ftl_selectedTheme(ftl_themeName, ftl_themeUrl){
	ftl_pageContent = jQuery("#ftl_container").html(); //save page content
	//remove ftl gallery
	jQuery("#ftl_container").html("<p>"+ ftl_lang.ftl_selected_theme +" <b>"+ftl_themeName+"</b> <a href=\"javascript:ftl_gallery_show()\" class=\"dashicons dashicons-welcome-widgets-menus\" title=\""+ ftl_lang.ftl_return +"\" id=\"ftl_return\" style=\"color:white\"></a></p>");
	//show forms
	jQuery("#ftl_container").parent().find("form").fadeIn("fast",function(){
		//active tooltip
		jQuery("#ftl_return").tooltip({
			position : { my: 'left center', at: 'right+10 center' }
		});
		//set hidden input with the theme selected
		if ( empty(ftl_selectedTheme_input) ) {
			if( jQuery("#ftl_themeSelected").length > 0){
				//update
				jQuery("#ftl_themeSelected").val(ftl_themeUrl);
			}else{
				//insert
				jQuery(this).prepend('<input type="text" id="ftl_themeSelected" name="ftl_themeSelected" value="'+ftl_themeUrl+'" style="display:none" />');
			}	
		}else{
			if( jQuery("input[name='"+ftl_selectedTheme_input+"']").length > 0 ){
				//update
				jQuery("input[name='"+ftl_selectedTheme_input+"']").val(ftl_themeUrl);
			}else{
				//insert
				jQuery(this).prepend('<input type="text" id="'+ftl_selectedTheme_input+'" name="'+ftl_selectedTheme_input+'" value="'+ftl_themeUrl+'" style="display:none" />');
			}
		}
	});
}

function ftl_gallery_show(){
	jQuery("#ftl_container").parent().find("form").hide();
	jQuery("#ftl_container").fadeOut("fast",function(){
		jQuery(this).html(ftl_pageContent).fadeIn("fast");
	});
}

function empty(mixed_var) {
  //  discuss at: http://phpjs.org/functions/empty/
  // original by: Philippe Baumann
  //    input by: Onno Marsman
  //    input by: LH
  //    input by: Stoyan Kyosev (http://www.svest.org/)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Onno Marsman
  // improved by: Francesco
  // improved by: Marc Jansen
  // improved by: Rafal Kukawski
  //   example 1: empty(null);
  //   returns 1: true
  //   example 2: empty(undefined);
  //   returns 2: true
  //   example 3: empty([]);
  //   returns 3: true
  //   example 4: empty({});
  //   returns 4: true
  //   example 5: empty({'aFunc' : function () { alert('humpty'); } });
  //   returns 5: false

  var undef, key, i, len;
  var emptyValues = [undef, null, false, 0, '', '0'];

  for (i = 0, len = emptyValues.length; i < len; i++) {
    if (mixed_var === emptyValues[i]) {
      return true;
    }
  }

  if (typeof mixed_var === 'object') {
    for (key in mixed_var) {
      // TODO: should we check for own properties only?
      //if (mixed_var.hasOwnProperty(key)) {
      return false;
      //}
    }
    return true;
  }

  return false;
}
	
