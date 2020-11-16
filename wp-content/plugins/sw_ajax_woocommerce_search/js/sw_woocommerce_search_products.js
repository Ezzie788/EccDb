/**
*  Ajax Autocomplete for jQuery, version 1.4.3
*  (c) 2017 Tomas Kirda
*
*  Ajax Autocomplete for jQuery is freely distributable under the terms of an MIT-style license.
*  For details, see the web site: https://github.com/devbridge/jQuery-Autocomplete
*/
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports&&"function"==typeof require?require("jquery"):jQuery)}(function(a){"use strict";function b(c,d){var e=this;e.element=c,e.el=a(c),e.suggestions=[],e.badQueries=[],e.selectedIndex=-1,e.currentValue=e.element.value,e.timeoutId=null,e.cachedResponse={},e.onChangeTimeout=null,e.onChange=null,e.isLocal=!1,e.suggestionsContainer=null,e.noSuggestionsContainer=null,e.options=a.extend({},b.defaults,d),e.classes={selected:"autocomplete-selected",suggestion:"autocomplete-suggestion"},e.hint=null,e.hintValue="",e.selection=null,e.initialize(),e.setOptions(d)}function c(a,b,c){return a.value.toLowerCase().indexOf(c)!==-1}function d(b){return"string"==typeof b?a.parseJSON(b):b}function e(a,b){if(!b)return a.value;var c="("+g.escapeRegExChars(b)+")";return a.value.replace(new RegExp(c,"gi"),"<strong>$1</strong>").replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/&lt;(\/?strong)&gt;/g,"<$1>")}function f(a,b){return'<div class="autocomplete-group">'+b+"</div>"}var g=function(){return{escapeRegExChars:function(a){return a.replace(/[|\\{}()[\]^$+*?.]/g,"\\$&")},createNode:function(a){var b=document.createElement("div");return b.className=a,b.style.position="absolute",b.style.display="none",b}}}(),h={ESC:27,TAB:9,RETURN:13,LEFT:37,UP:38,RIGHT:39,DOWN:40},i=a.noop;b.utils=g,a.Autocomplete=b,b.defaults={ajaxSettings:{},autoSelectFirst:!1,appendTo:"body",serviceUrl:null,lookup:null,onSelect:null,width:"auto",minChars:1,maxHeight:300,deferRequestBy:0,params:{},formatResult:e,formatGroup:f,delimiter:null,zIndex:9999,type:"GET",noCache:!1,onSearchStart:i,onSearchComplete:i,onSearchError:i,preserveInput:!1,containerClass:"autocomplete-suggestions",tabDisabled:!1,dataType:"text",currentRequest:null,triggerSelectOnValidInput:!0,preventBadQueries:!0,lookupFilter:c,paramName:"query",transformResult:d,showNoSuggestionNotice:!1,noSuggestionNotice:"No results",orientation:"bottom",forceFixPosition:!1},b.prototype={initialize:function(){var c,d=this,e="."+d.classes.suggestion,f=d.classes.selected,g=d.options;d.element.setAttribute("autocomplete","off"),d.noSuggestionsContainer=a('<div class="autocomplete-no-suggestion"></div>').html(this.options.noSuggestionNotice).get(0),d.suggestionsContainer=b.utils.createNode(g.containerClass),c=a(d.suggestionsContainer),c.appendTo(g.appendTo||"body"),"auto"!==g.width&&c.css("width",g.width),c.on("mouseover.autocomplete",e,function(){d.activate(a(this).data("index"))}),c.on("mouseout.autocomplete",function(){d.selectedIndex=-1,c.children("."+f).removeClass(f)}),c.on("click.autocomplete",e,function(){d.select(a(this).data("index"))}),c.on("click.autocomplete",function(){clearTimeout(d.blurTimeoutId)}),d.fixPositionCapture=function(){d.visible&&d.fixPosition()},a(window).on("resize.autocomplete",d.fixPositionCapture),d.el.on("keydown.autocomplete",function(a){d.onKeyPress(a)}),d.el.on("keyup.autocomplete",function(a){d.onKeyUp(a)}),d.el.on("blur.autocomplete",function(){d.onBlur()}),d.el.on("focus.autocomplete",function(){d.onFocus()}),d.el.on("change.autocomplete",function(a){d.onKeyUp(a)}),d.el.on("input.autocomplete",function(a){d.onKeyUp(a)})},onFocus:function(){var a=this;a.fixPosition(),a.el.val().length>=a.options.minChars&&a.onValueChange()},onBlur:function(){var a=this;a.blurTimeoutId=setTimeout(function(){a.hide()},200)},abortAjax:function(){var a=this;a.currentRequest&&(a.currentRequest.abort(),a.currentRequest=null)},setOptions:function(b){var c=this,d=a.extend({},c.options,b);c.isLocal=Array.isArray(d.lookup),c.isLocal&&(d.lookup=c.verifySuggestionsFormat(d.lookup)),d.orientation=c.validateOrientation(d.orientation,"bottom"),a(c.suggestionsContainer).css({"max-height":d.maxHeight+"px",width:d.width+"px","z-index":d.zIndex}),this.options=d},clearCache:function(){this.cachedResponse={},this.badQueries=[]},clear:function(){this.clearCache(),this.currentValue="",this.suggestions=[]},disable:function(){var a=this;a.disabled=!0,clearTimeout(a.onChangeTimeout),a.abortAjax()},enable:function(){this.disabled=!1},fixPosition:function(){var b=this,c=a(b.suggestionsContainer),d=c.parent().get(0);if(d===document.body||b.options.forceFixPosition){var e=b.options.orientation,f=c.outerHeight(),g=b.el.outerHeight(),h=b.el.offset(),i={top:h.top,left:h.left};if("auto"===e){var j=a(window).height(),k=a(window).scrollTop(),l=-k+h.top-f,m=k+j-(h.top+g+f);e=Math.max(l,m)===l?"top":"bottom"}if("top"===e?i.top+=-f:i.top+=g,d!==document.body){var n,o=c.css("opacity");b.visible||c.css("opacity",0).show(),n=c.offsetParent().offset(),i.top-=n.top,i.left-=n.left,b.visible||c.css("opacity",o).hide()}"auto"===b.options.width&&(i.width=b.el.outerWidth()+"px"),c.css(i)}},isCursorAtEnd:function(){var a,b=this,c=b.el.val().length,d=b.element.selectionStart;return"number"==typeof d?d===c:!document.selection||(a=document.selection.createRange(),a.moveStart("character",-c),c===a.text.length)},onKeyPress:function(a){var b=this;if(!b.disabled&&!b.visible&&a.which===h.DOWN&&b.currentValue)return void b.suggest();if(!b.disabled&&b.visible){switch(a.which){case h.ESC:b.el.val(b.currentValue),b.hide();break;case h.RIGHT:if(b.hint&&b.options.onHint&&b.isCursorAtEnd()){b.selectHint();break}return;case h.TAB:if(b.hint&&b.options.onHint)return void b.selectHint();if(b.selectedIndex===-1)return void b.hide();if(b.select(b.selectedIndex),b.options.tabDisabled===!1)return;break;case h.RETURN:if(b.selectedIndex===-1)return void b.hide();b.select(b.selectedIndex);break;case h.UP:b.moveUp();break;case h.DOWN:b.moveDown();break;default:return}a.stopImmediatePropagation(),a.preventDefault()}},onKeyUp:function(a){var b=this;if(!b.disabled){switch(a.which){case h.UP:case h.DOWN:return}clearTimeout(b.onChangeTimeout),b.currentValue!==b.el.val()&&(b.findBestHint(),b.options.deferRequestBy>0?b.onChangeTimeout=setTimeout(function(){b.onValueChange()},b.options.deferRequestBy):b.onValueChange())}},onValueChange:function(){var b=this,c=b.options,d=b.el.val(),e=b.getQuery(d);return b.selection&&b.currentValue!==e&&(b.selection=null,(c.onInvalidateSelection||a.noop).call(b.element)),clearTimeout(b.onChangeTimeout),b.currentValue=d,b.selectedIndex=-1,c.triggerSelectOnValidInput&&b.isExactMatch(e)?void b.select(0):void(e.length<c.minChars?b.hide():b.getSuggestions(e))},isExactMatch:function(a){var b=this.suggestions;return 1===b.length&&b[0].value.toLowerCase()===a.toLowerCase()},getQuery:function(b){var c,d=this.options.delimiter;return d?(c=b.split(d),a.trim(c[c.length-1])):b},getSuggestionsLocal:function(b){var c,d=this,e=d.options,f=b.toLowerCase(),g=e.lookupFilter,h=parseInt(e.lookupLimit,10);return c={suggestions:a.grep(e.lookup,function(a){return g(a,b,f)})},h&&c.suggestions.length>h&&(c.suggestions=c.suggestions.slice(0,h)),c},getSuggestions:function(b){var c,d,e,f,g=this,h=g.options,i=h.serviceUrl;if(h.params[h.paramName]=b,h.onSearchStart.call(g.element,h.params)!==!1){if(d=h.ignoreParams?null:h.params,a.isFunction(h.lookup))return void h.lookup(b,function(a){g.suggestions=a.suggestions,g.suggest(),h.onSearchComplete.call(g.element,b,a.suggestions)});g.isLocal?c=g.getSuggestionsLocal(b):(a.isFunction(i)&&(i=i.call(g.element,b)),e=i+"?"+a.param(d||{}),c=g.cachedResponse[e]),c&&Array.isArray(c.suggestions)?(g.suggestions=c.suggestions,g.suggest(),h.onSearchComplete.call(g.element,b,c.suggestions)):g.isBadQuery(b)?h.onSearchComplete.call(g.element,b,[]):(g.abortAjax(),f={url:i,data:d,type:h.type,dataType:h.dataType},a.extend(f,h.ajaxSettings),g.currentRequest=a.ajax(f).done(function(a){var c;g.currentRequest=null,c=h.transformResult(a,b),g.processResponse(c,b,e),h.onSearchComplete.call(g.element,b,c.suggestions)}).fail(function(a,c,d){h.onSearchError.call(g.element,b,a,c,d)}))}},isBadQuery:function(a){if(!this.options.preventBadQueries)return!1;for(var b=this.badQueries,c=b.length;c--;)if(0===a.indexOf(b[c]))return!0;return!1},hide:function(){var b=this,c=a(b.suggestionsContainer);a.isFunction(b.options.onHide)&&b.visible&&b.options.onHide.call(b.element,c),b.visible=!1,b.selectedIndex=-1,clearTimeout(b.onChangeTimeout),a(b.suggestionsContainer).hide(),b.signalHint(null)},suggest:function(){if(!this.suggestions.length)return void(this.options.showNoSuggestionNotice?this.noSuggestions():this.hide());var b,c=this,d=c.options,e=d.groupBy,f=d.formatResult,g=c.getQuery(c.currentValue),h=c.classes.suggestion,i=c.classes.selected,j=a(c.suggestionsContainer),k=a(c.noSuggestionsContainer),l=d.beforeRender,m="",n=function(a,c){var f=a.data[e];return b===f?"":(b=f,d.formatGroup(a,b))};return d.triggerSelectOnValidInput&&c.isExactMatch(g)?void c.select(0):(a.each(c.suggestions,function(a,b){e&&(m+=n(b,g,a)),m+='<div class="'+h+'" data-index="'+a+'">'+f(b,g,a)+"</div>"}),this.adjustContainerWidth(),k.detach(),j.html(m),a.isFunction(l)&&l.call(c.element,j,c.suggestions),c.fixPosition(),j.show(),d.autoSelectFirst&&(c.selectedIndex=0,j.scrollTop(0),j.children("."+h).first().addClass(i)),c.visible=!0,void c.findBestHint())},noSuggestions:function(){var b=this,c=b.options.beforeRender,d=a(b.suggestionsContainer),e=a(b.noSuggestionsContainer);this.adjustContainerWidth(),e.detach(),d.empty(),d.append(e),a.isFunction(c)&&c.call(b.element,d,b.suggestions),b.fixPosition(),d.show(),b.visible=!0},adjustContainerWidth:function(){var b,c=this,d=c.options,e=a(c.suggestionsContainer);"auto"===d.width?(b=c.el.outerWidth(),e.css("width",b>0?b:300)):"flex"===d.width&&e.css("width","")},findBestHint:function(){var b=this,c=b.el.val().toLowerCase(),d=null;c&&(a.each(b.suggestions,function(a,b){var e=0===b.value.toLowerCase().indexOf(c);return e&&(d=b),!e}),b.signalHint(d))},signalHint:function(b){var c="",d=this;b&&(c=d.currentValue+b.value.substr(d.currentValue.length)),d.hintValue!==c&&(d.hintValue=c,d.hint=b,(this.options.onHint||a.noop)(c))},verifySuggestionsFormat:function(b){return b.length&&"string"==typeof b[0]?a.map(b,function(a){return{value:a,data:null}}):b},validateOrientation:function(b,c){return b=a.trim(b||"").toLowerCase(),a.inArray(b,["auto","bottom","top"])===-1&&(b=c),b},processResponse:function(a,b,c){var d=this,e=d.options;a.suggestions=d.verifySuggestionsFormat(a.suggestions),e.noCache||(d.cachedResponse[c]=a,e.preventBadQueries&&!a.suggestions.length&&d.badQueries.push(b)),b===d.getQuery(d.currentValue)&&(d.suggestions=a.suggestions,d.suggest())},activate:function(b){var c,d=this,e=d.classes.selected,f=a(d.suggestionsContainer),g=f.find("."+d.classes.suggestion);return f.find("."+e).removeClass(e),d.selectedIndex=b,d.selectedIndex!==-1&&g.length>d.selectedIndex?(c=g.get(d.selectedIndex),a(c).addClass(e),c):null},selectHint:function(){var b=this,c=a.inArray(b.hint,b.suggestions);b.select(c)},select:function(a){var b=this;b.hide(),b.onSelect(a)},moveUp:function(){var b=this;if(b.selectedIndex!==-1)return 0===b.selectedIndex?(a(b.suggestionsContainer).children().first().removeClass(b.classes.selected),b.selectedIndex=-1,b.el.val(b.currentValue),void b.findBestHint()):void b.adjustScroll(b.selectedIndex-1)},moveDown:function(){var a=this;a.selectedIndex!==a.suggestions.length-1&&a.adjustScroll(a.selectedIndex+1)},adjustScroll:function(b){var c=this,d=c.activate(b);if(d){var e,f,g,h=a(d).outerHeight();e=d.offsetTop,f=a(c.suggestionsContainer).scrollTop(),g=f+c.options.maxHeight-h,e<f?a(c.suggestionsContainer).scrollTop(e):e>g&&a(c.suggestionsContainer).scrollTop(e-c.options.maxHeight+h),c.options.preserveInput||c.el.val(c.getValue(c.suggestions[b].value)),c.signalHint(null)}},onSelect:function(b){var c=this,d=c.options.onSelect,e=c.suggestions[b];c.currentValue=c.getValue(e.value),c.currentValue===c.el.val()||c.options.preserveInput||c.el.val(c.currentValue),c.signalHint(null),c.suggestions=[],c.selection=e,a.isFunction(d)&&d.call(c.element,e)},getValue:function(a){var b,c,d=this,e=d.options.delimiter;return e?(b=d.currentValue,c=b.split(e),1===c.length?a:b.substr(0,b.length-c[c.length-1].length)+a):a},dispose:function(){var b=this;b.el.off(".autocomplete").removeData("autocomplete"),a(window).off("resize.autocomplete",b.fixPositionCapture),a(b.suggestionsContainer).remove()}},a.fn.devbridgeAutocomplete=function(c,d){var e="autocomplete";return arguments.length?this.each(function(){var f=a(this),g=f.data(e);"string"==typeof c?g&&"function"==typeof g[c]&&g[c](d):(g&&g.dispose&&g.dispose(),g=new b(this,c),f.data(e,g))}):this.first().data(e)},a.fn.autocomplete||(a.fn.autocomplete=a.fn.devbridgeAutocomplete)});
(function($) { 
	$('.topsearch-entry').each(function(){
				var selector 	 = $( this ).find( '.search' );
				var showimage  = selector.data("show_image");
				var showprice  = selector.data("show_price");
				var character  = selector.data("character");
				var searchtype = selector.data("search_type");
				var height 		 = selector.data("height_image");
				var width 		 = selector.data("width_image");
				var limit 		 = selector.data("limit");
        var append = $(this).find('.search-append');
				 
         var search_categories = $(this).find('.category-selection');
         var serviceUrl = sw_livesearch.ajaxurl + '?action=sw_search_products_callback&limit=' + limit + '&search_type=' + searchtype;
        if (search_categories.length && search_categories.val() !== '') {
            serviceUrl += '&product_cat=' + search_categories.val();
        }

         $(this).find('.autosearch-input').devbridgeAutocomplete({
			minChars        : character,
			appendTo        : append,
			triggerSelectOnValidInput: false,
			serviceUrl      : serviceUrl,
			ajaxSettings		: {
				contentType : 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			onSearchStart   : function () {
				$('.button-search-pro').removeClass('loading');
				$('.button-search-pro').addClass('loading');
			},
			onSelect        : function (suggestion) {
					if (suggestion.id != -1) {
							window.location.href = suggestion.link;
					}
			},
			onSearchComplete: function () {
					$('.button-search-pro').removeClass('loading');
			},
			beforeRender: function (container) {
					$(container).removeAttr('style');
			},
			formatResult: function (suggestion, currentValue) {
				var pattern = '(' + $.Autocomplete.utils.escapeRegExChars(currentValue) + ')';
				var html = '';
				if( suggestion.id != -1 ){
					html += '<a class="media-left" href="'+ suggestion.link +'">';
					if( showimage ){								
						html += '<img width="'+ width +'" height="' + height + '" class="pull-left" src="' + suggestion.img + '">';								
					}
					html += '<div class="media-body">';
					html +=	'<span>'+suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')+'</span>';							
					html += '<div class="search-meta">'
					if( suggestion.sku != '' ){
						html += '<div class="sku"><span>' + sw_livesearch.sku + ': </span>'+suggestion.sku.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')+'</div>';
					}
					if( showprice ){
						html += suggestion.price;
					}
					html += '</div>';
					html += '</div>';
					html += '</a>';
				}else{
					html +=	'<div class="no-result">'+suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')+'</div>';
				}
				return html;
			}
        });

		if( search_categories.length ){
			var searchForm = $(this).find('.autosearch-input').devbridgeAutocomplete();

			search_categories.on( 'change', function( e ){

				if( search_categories.val() != '' ) {
						searchForm.setOptions({
								serviceUrl:  sw_livesearch.ajaxurl + '?action=sw_search_products_callback&limit=' + limit + '&search_type=' + searchtype + '&product_cat=' + search_categories.val()
						});
				} else{
						searchForm.setOptions({
								serviceUrl:  sw_livesearch.ajaxurl + '?action=sw_search_products_callback&limit=' + limit + '&search_type=' + searchtype
						});
				}
				searchForm.hide();
				searchForm.onValueChange();
			});
		}		
	});
	
	var sw_search_wrapper = $( '#search-product ul.products-loop' );
	var post_ids = sw_search_wrapper.data( 'postids' );
	var maxpage = sw_search_wrapper.data( 'maxpage' );
	var attributes = sw_search_wrapper.data( 'attributes' );
	var next = $( '.sw-ajax-pagination > li > a.next' );
	var prev = $( '.sw-ajax-pagination > li > a.prev' );
	var $paged = 1;
	$(document).on( 'click', '.sw-ajax-pagination > li > a', function(e){
		var $this = $(this);
		if( $(this).hasClass( 'disabled' ) || $(this).parent().hasClass( 'current' ) ){
			return false;
		}
		
		if( $(this).hasClass( 'next' ) ){
			$paged = $paged + 1;
		}else if( $(this).hasClass( 'prev' ) ){
			$paged = $paged - 1;
		}else{
			$paged = $(this).data( 'paged' );
			$(this).parent().addClass('current').siblings().removeClass('current');
		}
		sw_search_wrapper.addClass( 'loading' );
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: sw_livesearch.ajaxurl,
			data: { 
				'action': 'sw_search_pagination', //calls wp_ajax_nopriv_ajaxlogin
				'post_ids' : post_ids,
				'paged' : $paged,
				'attributes' : attributes
			},
			success: function(data){
				$this.parent().siblings().removeClass('current');
				sw_search_wrapper.html( data.content );
				$paged = data.currentpage;
				console.log( data.currentpage );
				$( '.sw-ajax-pagination > li' ).eq( data.currentpage ).addClass( 'current' );
				if( data.currentpage > 1 && data.currentpage <= maxpage ){					
					prev.removeClass( 'disabled' );
				}else{
					prev.addClass( 'disabled' );
				}
				
				if( data.currentpage < maxpage ){					
					next.removeClass( 'disabled' );
				}else{
					next.addClass( 'disabled' );
				}
				sw_search_wrapper.removeClass( 'loading' );
			}
		});
		e.preventDefault();
	});
	
	$( 'select.sw-select-pagination' ).on( 'change', function(){
		var paged = $(this).val();
		sw_search_wrapper.addClass( 'loading' );
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: sw_livesearch.ajaxurl,
			data: { 
				'action': 'sw_search_pagination', //calls wp_ajax_nopriv_ajaxlogin
				'post_ids' : post_ids,
				'paged' : paged,
				'attributes' : attributes
			},
			success: function(data){
				sw_search_wrapper.html( data );
				sw_search_wrapper.removeClass( 'loading' );
			}
		});
	});
})(jQuery);