/*!
 * Bootstrap v3.0.1 by @fat and @mdo
 * Copyright 2013 Twitter, Inc.
 * Licensed under http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world by @mdo and @fat.
 */

if("undefined"==typeof jQuery)throw new Error("Bootstrap requires jQuery");+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]}}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one(a.support.transition.end,function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b()})}(window.jQuery),+function(a){"use strict";var b='[data-dismiss="alert"]',c=function(c){a(c).on("click",b,this.close)};c.prototype.close=function(b){function c(){f.trigger("closed.bs.alert").remove()}var d=a(this),e=d.attr("data-target");e||(e=d.attr("href"),e=e&&e.replace(/.*(?=#[^\s]*$)/,""));var f=a(e);b&&b.preventDefault(),f.length||(f=d.hasClass("alert")?d:d.parent()),f.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one(a.support.transition.end,c).emulateTransitionEnd(150):c())};var d=a.fn.alert;a.fn.alert=function(b){return this.each(function(){var d=a(this),e=d.data("bs.alert");e||d.data("bs.alert",e=new c(this)),"string"==typeof b&&e[b].call(d)})},a.fn.alert.Constructor=c,a.fn.alert.noConflict=function(){return a.fn.alert=d,this},a(document).on("click.bs.alert.data-api",b,c.prototype.close)}(window.jQuery),+function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.DEFAULTS,d)};b.DEFAULTS={loadingText:"loading..."},b.prototype.setState=function(a){var b="disabled",c=this.$element,d=c.is("input")?"val":"html",e=c.data();a+="Text",e.resetText||c.data("resetText",c[d]()),c[d](e[a]||this.options[a]),setTimeout(function(){"loadingText"==a?c.addClass(b).attr(b,b):c.removeClass(b).removeAttr(b)},0)},b.prototype.toggle=function(){var a=this.$element.closest('[data-toggle="buttons"]');if(a.length){var b=this.$element.find("input").prop("checked",!this.$element.hasClass("active")).trigger("change");"radio"===b.prop("type")&&a.find(".active").removeClass("active")}this.$element.toggleClass("active")};var c=a.fn.button;a.fn.button=function(c){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof c&&c;e||d.data("bs.button",e=new b(this,f)),"toggle"==c?e.toggle():c&&e.setState(c)})},a.fn.button.Constructor=b,a.fn.button.noConflict=function(){return a.fn.button=c,this},a(document).on("click.bs.button.data-api","[data-toggle^=button]",function(b){var c=a(b.target);c.hasClass("btn")||(c=c.closest(".btn")),c.button("toggle"),b.preventDefault()})}(window.jQuery),+function(a){"use strict";var b=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=this.sliding=this.interval=this.$active=this.$items=null,"hover"==this.options.pause&&this.$element.on("mouseenter",a.proxy(this.pause,this)).on("mouseleave",a.proxy(this.cycle,this))};b.DEFAULTS={interval:5e3,pause:"hover",wrap:!0},b.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},b.prototype.getActiveIndex=function(){return this.$active=this.$element.find(".item.active"),this.$items=this.$active.parent().children(),this.$items.index(this.$active)},b.prototype.to=function(b){var c=this,d=this.getActiveIndex();return b>this.$items.length-1||0>b?void 0:this.sliding?this.$element.one("slid",function(){c.to(b)}):d==b?this.pause().cycle():this.slide(b>d?"next":"prev",a(this.$items[b]))},b.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition.end&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},b.prototype.next=function(){return this.sliding?void 0:this.slide("next")},b.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},b.prototype.slide=function(b,c){var d=this.$element.find(".item.active"),e=c||d[b](),f=this.interval,g="next"==b?"left":"right",h="next"==b?"first":"last",i=this;if(!e.length){if(!this.options.wrap)return;e=this.$element.find(".item")[h]()}this.sliding=!0,f&&this.pause();var j=a.Event("slide.bs.carousel",{relatedTarget:e[0],direction:g});if(!e.hasClass("active")){if(this.$indicators.length&&(this.$indicators.find(".active").removeClass("active"),this.$element.one("slid",function(){var b=a(i.$indicators.children()[i.getActiveIndex()]);b&&b.addClass("active")})),a.support.transition&&this.$element.hasClass("slide")){if(this.$element.trigger(j),j.isDefaultPrevented())return;e.addClass(b),e[0].offsetWidth,d.addClass(g),e.addClass(g),d.one(a.support.transition.end,function(){e.removeClass([b,g].join(" ")).addClass("active"),d.removeClass(["active",g].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger("slid")},0)}).emulateTransitionEnd(600)}else{if(this.$element.trigger(j),j.isDefaultPrevented())return;d.removeClass("active"),e.addClass("active"),this.sliding=!1,this.$element.trigger("slid")}return f&&this.cycle(),this}};var c=a.fn.carousel;a.fn.carousel=function(c){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},b.DEFAULTS,d.data(),"object"==typeof c&&c),g="string"==typeof c?c:f.slide;e||d.data("bs.carousel",e=new b(this,f)),"number"==typeof c?e.to(c):g?e[g]():f.interval&&e.pause().cycle()})},a.fn.carousel.Constructor=b,a.fn.carousel.noConflict=function(){return a.fn.carousel=c,this},a(document).on("click.bs.carousel.data-api","[data-slide], [data-slide-to]",function(b){var c,d=a(this),e=a(d.attr("data-target")||(c=d.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"")),f=a.extend({},e.data(),d.data()),g=d.attr("data-slide-to");g&&(f.interval=!1),e.carousel(f),(g=d.attr("data-slide-to"))&&e.data("bs.carousel").to(g),b.preventDefault()}),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var b=a(this);b.carousel(b.data())})})}(window.jQuery),+function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.DEFAULTS,d),this.transitioning=null,this.options.parent&&(this.$parent=a(this.options.parent)),this.options.toggle&&this.toggle()};b.DEFAULTS={toggle:!0},b.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},b.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b=a.Event("show.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.$parent&&this.$parent.find("> .panel > .in");if(c&&c.length){var d=c.data("bs.collapse");if(d&&d.transitioning)return;c.collapse("hide"),d||c.data("bs.collapse",null)}var e=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[e](0),this.transitioning=1;var f=function(){this.$element.removeClass("collapsing").addClass("in")[e]("auto"),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return f.call(this);var g=a.camelCase(["scroll",e].join("-"));this.$element.one(a.support.transition.end,a.proxy(f,this)).emulateTransitionEnd(350)[e](this.$element[0][g])}}},b.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"),this.transitioning=1;var d=function(){this.transitioning=0,this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")};return a.support.transition?(this.$element[c](0).one(a.support.transition.end,a.proxy(d,this)).emulateTransitionEnd(350),void 0):d.call(this)}}},b.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()};var c=a.fn.collapse;a.fn.collapse=function(c){return this.each(function(){var d=a(this),e=d.data("bs.collapse"),f=a.extend({},b.DEFAULTS,d.data(),"object"==typeof c&&c);e||d.data("bs.collapse",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.collapse.Constructor=b,a.fn.collapse.noConflict=function(){return a.fn.collapse=c,this},a(document).on("click.bs.collapse.data-api","[data-toggle=collapse]",function(b){var c,d=a(this),e=d.attr("data-target")||b.preventDefault()||(c=d.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,""),f=a(e),g=f.data("bs.collapse"),h=g?"toggle":d.data(),i=d.attr("data-parent"),j=i&&a(i);g&&g.transitioning||(j&&j.find('[data-toggle=collapse][data-parent="'+i+'"]').not(d).addClass("collapsed"),d[f.hasClass("in")?"addClass":"removeClass"]("collapsed")),f.collapse(h)})}(window.jQuery),+function(a){"use strict";function b(){a(d).remove(),a(e).each(function(b){var d=c(a(this));d.hasClass("open")&&(d.trigger(b=a.Event("hide.bs.dropdown")),b.isDefaultPrevented()||d.removeClass("open").trigger("hidden.bs.dropdown"))})}function c(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}var d=".dropdown-backdrop",e="[data-toggle=dropdown]",f=function(b){a(b).on("click.bs.dropdown",this.toggle)};f.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=c(e),g=f.hasClass("open");if(b(),!g){if("ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click",b),f.trigger(d=a.Event("show.bs.dropdown")),d.isDefaultPrevented())return;f.toggleClass("open").trigger("shown.bs.dropdown"),e.focus()}return!1}},f.prototype.keydown=function(b){if(/(38|40|27)/.test(b.keyCode)){var d=a(this);if(b.preventDefault(),b.stopPropagation(),!d.is(".disabled, :disabled")){var f=c(d),g=f.hasClass("open");if(!g||g&&27==b.keyCode)return 27==b.which&&f.find(e).focus(),d.click();var h=a("[role=menu] li:not(.divider):visible a",f);if(h.length){var i=h.index(h.filter(":focus"));38==b.keyCode&&i>0&&i--,40==b.keyCode&&i<h.length-1&&i++,~i||(i=0),h.eq(i).focus()}}}};var g=a.fn.dropdown;a.fn.dropdown=function(b){return this.each(function(){var c=a(this),d=c.data("dropdown");d||c.data("dropdown",d=new f(this)),"string"==typeof b&&d[b].call(c)})},a.fn.dropdown.Constructor=f,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=g,this},a(document).on("click.bs.dropdown.data-api",b).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",e,f.prototype.toggle).on("keydown.bs.dropdown.data-api",e+", [role=menu]",f.prototype.keydown)}(window.jQuery),+function(a){"use strict";var b=function(b,c){this.options=c,this.$element=a(b),this.$backdrop=this.isShown=null,this.options.remote&&this.$element.load(this.options.remote)};b.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},b.prototype.toggle=function(a){return this[this.isShown?"hide":"show"](a)},b.prototype.show=function(b){var c=this,d=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(d),this.isShown||d.isDefaultPrevented()||(this.isShown=!0,this.escape(),this.$element.on("click.dismiss.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.backdrop(function(){var d=a.support.transition&&c.$element.hasClass("fade");c.$element.parent().length||c.$element.appendTo(document.body),c.$element.show(),d&&c.$element[0].offsetWidth,c.$element.addClass("in").attr("aria-hidden",!1),c.enforceFocus();var e=a.Event("shown.bs.modal",{relatedTarget:b});d?c.$element.find(".modal-dialog").one(a.support.transition.end,function(){c.$element.focus().trigger(e)}).emulateTransitionEnd(300):c.$element.focus().trigger(e)}))},b.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one(a.support.transition.end,a.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal())},b.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.focus()},this))},b.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keyup.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keyup.dismiss.bs.modal")},b.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.removeBackdrop(),a.$element.trigger("hidden.bs.modal")})},b.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},b.prototype.backdrop=function(b){var c=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var d=a.support.transition&&c;if(this.$backdrop=a('<div class="modal-backdrop '+c+'" />').appendTo(document.body),this.$element.on("click.dismiss.modal",a.proxy(function(a){a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus.call(this.$element[0]):this.hide.call(this))},this)),d&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;d?this.$backdrop.one(a.support.transition.end,b).emulateTransitionEnd(150):b()}else!this.isShown&&this.$backdrop?(this.$backdrop.removeClass("in"),a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one(a.support.transition.end,b).emulateTransitionEnd(150):b()):b&&b()};var c=a.fn.modal;a.fn.modal=function(c,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},b.DEFAULTS,e.data(),"object"==typeof c&&c);f||e.data("bs.modal",f=new b(this,g)),"string"==typeof c?f[c](d):g.show&&f.show(d)})},a.fn.modal.Constructor=b,a.fn.modal.noConflict=function(){return a.fn.modal=c,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(b){var c=a(this),d=c.attr("href"),e=a(c.attr("data-target")||d&&d.replace(/.*(?=#[^\s]+$)/,"")),f=e.data("modal")?"toggle":a.extend({remote:!/#/.test(d)&&d},e.data(),c.data());b.preventDefault(),e.modal(f,this).one("hide",function(){c.is(":visible")&&c.focus()})}),a(document).on("show.bs.modal",".modal",function(){a(document.body).addClass("modal-open")}).on("hidden.bs.modal",".modal",function(){a(document.body).removeClass("modal-open")})}(window.jQuery),+function(a){"use strict";var b=function(a,b){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null,this.init("tooltip",a,b)};b.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1},b.prototype.init=function(b,c,d){this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d);for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focus",i="hover"==g?"mouseleave":"blur";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},b.prototype.getDefaults=function(){return b.DEFAULTS},b.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},b.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},b.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type);return clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show),void 0):c.show()},b.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type);return clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide),void 0):c.hide()},b.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){if(this.$element.trigger(b),b.isDefaultPrevented())return;var c=this.tip();this.setContent(),this.options.animation&&c.addClass("fade");var d="function"==typeof this.options.placement?this.options.placement.call(this,c[0],this.$element[0]):this.options.placement,e=/\s?auto?\s?/i,f=e.test(d);f&&(d=d.replace(e,"")||"top"),c.detach().css({top:0,left:0,display:"block"}).addClass(d),this.options.container?c.appendTo(this.options.container):c.insertAfter(this.$element);var g=this.getPosition(),h=c[0].offsetWidth,i=c[0].offsetHeight;if(f){var j=this.$element.parent(),k=d,l=document.documentElement.scrollTop||document.body.scrollTop,m="body"==this.options.container?window.innerWidth:j.outerWidth(),n="body"==this.options.container?window.innerHeight:j.outerHeight(),o="body"==this.options.container?0:j.offset().left;d="bottom"==d&&g.top+g.height+i-l>n?"top":"top"==d&&g.top-l-i<0?"bottom":"right"==d&&g.right+h>m?"left":"left"==d&&g.left-h<o?"right":d,c.removeClass(k).addClass(d)}var p=this.getCalculatedOffset(d,g,h,i);this.applyPlacement(p,d),this.$element.trigger("shown.bs."+this.type)}},b.prototype.applyPlacement=function(a,b){var c,d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),a.top=a.top+g,a.left=a.left+h,d.offset(a).addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;if("top"==b&&j!=f&&(c=!0,a.top=a.top+f-j),/bottom|top/.test(b)){var k=0;a.left<0&&(k=-2*a.left,a.left=0,d.offset(a),i=d[0].offsetWidth,j=d[0].offsetHeight),this.replaceArrow(k-e+i,i,"left")}else this.replaceArrow(j-f,j,"top");c&&d.offset(a)},b.prototype.replaceArrow=function(a,b,c){this.arrow().css(c,a?50*(1-a/b)+"%":"")},b.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},b.prototype.hide=function(){function b(){"in"!=c.hoverState&&d.detach()}var c=this,d=this.tip(),e=a.Event("hide.bs."+this.type);return this.$element.trigger(e),e.isDefaultPrevented()?void 0:(d.removeClass("in"),a.support.transition&&this.$tip.hasClass("fade")?d.one(a.support.transition.end,b).emulateTransitionEnd(150):b(),this.$element.trigger("hidden.bs."+this.type),this)},b.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},b.prototype.hasContent=function(){return this.getTitle()},b.prototype.getPosition=function(){var b=this.$element[0];return a.extend({},"function"==typeof b.getBoundingClientRect?b.getBoundingClientRect():{width:b.offsetWidth,height:b.offsetHeight},this.$element.offset())},b.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},b.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},b.prototype.tip=function(){return this.$tip=this.$tip||a(this.options.template)},b.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},b.prototype.validate=function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},b.prototype.enable=function(){this.enabled=!0},b.prototype.disable=function(){this.enabled=!1},b.prototype.toggleEnabled=function(){this.enabled=!this.enabled},b.prototype.toggle=function(b){var c=b?a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type):this;c.tip().hasClass("in")?c.leave(c):c.enter(c)},b.prototype.destroy=function(){this.hide().$element.off("."+this.type).removeData("bs."+this.type)};var c=a.fn.tooltip;a.fn.tooltip=function(c){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof c&&c;e||d.data("bs.tooltip",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.tooltip.Constructor=b,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=c,this}}(window.jQuery),+function(a){"use strict";var b=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");b.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),b.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),b.prototype.constructor=b,b.prototype.getDefaults=function(){return b.DEFAULTS},b.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content")[this.options.html?"html":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},b.prototype.hasContent=function(){return this.getTitle()||this.getContent()},b.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},b.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")},b.prototype.tip=function(){return this.$tip||(this.$tip=a(this.options.template)),this.$tip};var c=a.fn.popover;a.fn.popover=function(c){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof c&&c;e||d.data("bs.popover",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.popover.Constructor=b,a.fn.popover.noConflict=function(){return a.fn.popover=c,this}}(window.jQuery),+function(a){"use strict";function b(c,d){var e,f=a.proxy(this.process,this);this.$element=a(c).is("body")?a(window):a(c),this.$body=a("body"),this.$scrollElement=this.$element.on("scroll.bs.scroll-spy.data-api",f),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||(e=a(c).attr("href"))&&e.replace(/.*(?=#[^\s]+$)/,"")||"")+" .nav li > a",this.offsets=a([]),this.targets=a([]),this.activeTarget=null,this.refresh(),this.process()}b.DEFAULTS={offset:10},b.prototype.refresh=function(){var b=this.$element[0]==window?"offset":"position";this.offsets=a([]),this.targets=a([]);var c=this;this.$body.find(this.selector).map(function(){var d=a(this),e=d.data("target")||d.attr("href"),f=/^#\w/.test(e)&&a(e);return f&&f.length&&[[f[b]().top+(!a.isWindow(c.$scrollElement.get(0))&&c.$scrollElement.scrollTop()),e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){c.offsets.push(this[0]),c.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.$scrollElement[0].scrollHeight||this.$body[0].scrollHeight,d=c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(b>=d)return g!=(a=f.last()[0])&&this.activate(a);for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(!e[a+1]||b<=e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,a(this.selector).parents(".active").removeClass("active");var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate")};var c=a.fn.scrollspy;a.fn.scrollspy=function(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=c,this},a(window).on("load",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);b.scrollspy(b.data())})})}(window.jQuery),+function(a){"use strict";var b=function(b){this.element=a(b)};b.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a")[0],f=a.Event("show.bs.tab",{relatedTarget:e});if(b.trigger(f),!f.isDefaultPrevented()){var g=a(d);this.activate(b.parent("li"),c),this.activate(g,g.parent(),function(){b.trigger({type:"shown.bs.tab",relatedTarget:e})})}}},b.prototype.activate=function(b,c,d){function e(){f.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),b.addClass("active"),g?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu")&&b.closest("li.dropdown").addClass("active"),d&&d()}var f=c.find("> .active"),g=d&&a.support.transition&&f.hasClass("fade");g?f.one(a.support.transition.end,e).emulateTransitionEnd(150):e(),f.removeClass("in")};var c=a.fn.tab;a.fn.tab=function(c){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new b(this)),"string"==typeof c&&e[c]()})},a.fn.tab.Constructor=b,a.fn.tab.noConflict=function(){return a.fn.tab=c,this},a(document).on("click.bs.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(b){b.preventDefault(),a(this).tab("show")})}(window.jQuery),+function(a){"use strict";var b=function(c,d){this.options=a.extend({},b.DEFAULTS,d),this.$window=a(window).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(c),this.affixed=this.unpin=null,this.checkPosition()};b.RESET="affix affix-top affix-bottom",b.DEFAULTS={offset:0},b.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},b.prototype.checkPosition=function(){if(this.$element.is(":visible")){var c=a(document).height(),d=this.$window.scrollTop(),e=this.$element.offset(),f=this.options.offset,g=f.top,h=f.bottom;"object"!=typeof f&&(h=g=f),"function"==typeof g&&(g=f.top()),"function"==typeof h&&(h=f.bottom());var i=null!=this.unpin&&d+this.unpin<=e.top?!1:null!=h&&e.top+this.$element.height()>=c-h?"bottom":null!=g&&g>=d?"top":!1;this.affixed!==i&&(this.unpin&&this.$element.css("top",""),this.affixed=i,this.unpin="bottom"==i?e.top-d:null,this.$element.removeClass(b.RESET).addClass("affix"+(i?"-"+i:"")),"bottom"==i&&this.$element.offset({top:document.body.offsetHeight-h-this.$element.height()}))}};var c=a.fn.affix;a.fn.affix=function(c){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof c&&c;e||d.data("bs.affix",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.affix.Constructor=b,a.fn.affix.noConflict=function(){return a.fn.affix=c,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var b=a(this),c=b.data();c.offset=c.offset||{},c.offsetBottom&&(c.offset.bottom=c.offsetBottom),c.offsetTop&&(c.offset.top=c.offsetTop),b.affix(c)})})}(window.jQuery);
//     Underscore.js 1.8.3
//     http://underscorejs.org
//     (c) 2009-2015 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
//     Underscore may be freely distributed under the MIT license.
(function(){function n(n){function t(t,r,e,u,i,o){for(;i>=0&&o>i;i+=n){var a=u?u[i]:i;e=r(e,t[a],a,t)}return e}return function(r,e,u,i){e=b(e,i,4);var o=!k(r)&&m.keys(r),a=(o||r).length,c=n>0?0:a-1;return arguments.length<3&&(u=r[o?o[c]:c],c+=n),t(r,e,u,o,c,a)}}function t(n){return function(t,r,e){r=x(r,e);for(var u=O(t),i=n>0?0:u-1;i>=0&&u>i;i+=n)if(r(t[i],i,t))return i;return-1}}function r(n,t,r){return function(e,u,i){var o=0,a=O(e);if("number"==typeof i)n>0?o=i>=0?i:Math.max(i+a,o):a=i>=0?Math.min(i+1,a):i+a+1;else if(r&&i&&a)return i=r(e,u),e[i]===u?i:-1;if(u!==u)return i=t(l.call(e,o,a),m.isNaN),i>=0?i+o:-1;for(i=n>0?o:a-1;i>=0&&a>i;i+=n)if(e[i]===u)return i;return-1}}function e(n,t){var r=I.length,e=n.constructor,u=m.isFunction(e)&&e.prototype||a,i="constructor";for(m.has(n,i)&&!m.contains(t,i)&&t.push(i);r--;)i=I[r],i in n&&n[i]!==u[i]&&!m.contains(t,i)&&t.push(i)}var u=this,i=u._,o=Array.prototype,a=Object.prototype,c=Function.prototype,f=o.push,l=o.slice,s=a.toString,p=a.hasOwnProperty,h=Array.isArray,v=Object.keys,g=c.bind,y=Object.create,d=function(){},m=function(n){return n instanceof m?n:this instanceof m?void(this._wrapped=n):new m(n)};"undefined"!=typeof exports?("undefined"!=typeof module&&module.exports&&(exports=module.exports=m),exports._=m):u._=m,m.VERSION="1.8.3";var b=function(n,t,r){if(t===void 0)return n;switch(null==r?3:r){case 1:return function(r){return n.call(t,r)};case 2:return function(r,e){return n.call(t,r,e)};case 3:return function(r,e,u){return n.call(t,r,e,u)};case 4:return function(r,e,u,i){return n.call(t,r,e,u,i)}}return function(){return n.apply(t,arguments)}},x=function(n,t,r){return null==n?m.identity:m.isFunction(n)?b(n,t,r):m.isObject(n)?m.matcher(n):m.property(n)};m.iteratee=function(n,t){return x(n,t,1/0)};var _=function(n,t){return function(r){var e=arguments.length;if(2>e||null==r)return r;for(var u=1;e>u;u++)for(var i=arguments[u],o=n(i),a=o.length,c=0;a>c;c++){var f=o[c];t&&r[f]!==void 0||(r[f]=i[f])}return r}},j=function(n){if(!m.isObject(n))return{};if(y)return y(n);d.prototype=n;var t=new d;return d.prototype=null,t},w=function(n){return function(t){return null==t?void 0:t[n]}},A=Math.pow(2,53)-1,O=w("length"),k=function(n){var t=O(n);return"number"==typeof t&&t>=0&&A>=t};m.each=m.forEach=function(n,t,r){t=b(t,r);var e,u;if(k(n))for(e=0,u=n.length;u>e;e++)t(n[e],e,n);else{var i=m.keys(n);for(e=0,u=i.length;u>e;e++)t(n[i[e]],i[e],n)}return n},m.map=m.collect=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=Array(u),o=0;u>o;o++){var a=e?e[o]:o;i[o]=t(n[a],a,n)}return i},m.reduce=m.foldl=m.inject=n(1),m.reduceRight=m.foldr=n(-1),m.find=m.detect=function(n,t,r){var e;return e=k(n)?m.findIndex(n,t,r):m.findKey(n,t,r),e!==void 0&&e!==-1?n[e]:void 0},m.filter=m.select=function(n,t,r){var e=[];return t=x(t,r),m.each(n,function(n,r,u){t(n,r,u)&&e.push(n)}),e},m.reject=function(n,t,r){return m.filter(n,m.negate(x(t)),r)},m.every=m.all=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=0;u>i;i++){var o=e?e[i]:i;if(!t(n[o],o,n))return!1}return!0},m.some=m.any=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=0;u>i;i++){var o=e?e[i]:i;if(t(n[o],o,n))return!0}return!1},m.contains=m.includes=m.include=function(n,t,r,e){return k(n)||(n=m.values(n)),("number"!=typeof r||e)&&(r=0),m.indexOf(n,t,r)>=0},m.invoke=function(n,t){var r=l.call(arguments,2),e=m.isFunction(t);return m.map(n,function(n){var u=e?t:n[t];return null==u?u:u.apply(n,r)})},m.pluck=function(n,t){return m.map(n,m.property(t))},m.where=function(n,t){return m.filter(n,m.matcher(t))},m.findWhere=function(n,t){return m.find(n,m.matcher(t))},m.max=function(n,t,r){var e,u,i=-1/0,o=-1/0;if(null==t&&null!=n){n=k(n)?n:m.values(n);for(var a=0,c=n.length;c>a;a++)e=n[a],e>i&&(i=e)}else t=x(t,r),m.each(n,function(n,r,e){u=t(n,r,e),(u>o||u===-1/0&&i===-1/0)&&(i=n,o=u)});return i},m.min=function(n,t,r){var e,u,i=1/0,o=1/0;if(null==t&&null!=n){n=k(n)?n:m.values(n);for(var a=0,c=n.length;c>a;a++)e=n[a],i>e&&(i=e)}else t=x(t,r),m.each(n,function(n,r,e){u=t(n,r,e),(o>u||1/0===u&&1/0===i)&&(i=n,o=u)});return i},m.shuffle=function(n){for(var t,r=k(n)?n:m.values(n),e=r.length,u=Array(e),i=0;e>i;i++)t=m.random(0,i),t!==i&&(u[i]=u[t]),u[t]=r[i];return u},m.sample=function(n,t,r){return null==t||r?(k(n)||(n=m.values(n)),n[m.random(n.length-1)]):m.shuffle(n).slice(0,Math.max(0,t))},m.sortBy=function(n,t,r){return t=x(t,r),m.pluck(m.map(n,function(n,r,e){return{value:n,index:r,criteria:t(n,r,e)}}).sort(function(n,t){var r=n.criteria,e=t.criteria;if(r!==e){if(r>e||r===void 0)return 1;if(e>r||e===void 0)return-1}return n.index-t.index}),"value")};var F=function(n){return function(t,r,e){var u={};return r=x(r,e),m.each(t,function(e,i){var o=r(e,i,t);n(u,e,o)}),u}};m.groupBy=F(function(n,t,r){m.has(n,r)?n[r].push(t):n[r]=[t]}),m.indexBy=F(function(n,t,r){n[r]=t}),m.countBy=F(function(n,t,r){m.has(n,r)?n[r]++:n[r]=1}),m.toArray=function(n){return n?m.isArray(n)?l.call(n):k(n)?m.map(n,m.identity):m.values(n):[]},m.size=function(n){return null==n?0:k(n)?n.length:m.keys(n).length},m.partition=function(n,t,r){t=x(t,r);var e=[],u=[];return m.each(n,function(n,r,i){(t(n,r,i)?e:u).push(n)}),[e,u]},m.first=m.head=m.take=function(n,t,r){return null==n?void 0:null==t||r?n[0]:m.initial(n,n.length-t)},m.initial=function(n,t,r){return l.call(n,0,Math.max(0,n.length-(null==t||r?1:t)))},m.last=function(n,t,r){return null==n?void 0:null==t||r?n[n.length-1]:m.rest(n,Math.max(0,n.length-t))},m.rest=m.tail=m.drop=function(n,t,r){return l.call(n,null==t||r?1:t)},m.compact=function(n){return m.filter(n,m.identity)};var S=function(n,t,r,e){for(var u=[],i=0,o=e||0,a=O(n);a>o;o++){var c=n[o];if(k(c)&&(m.isArray(c)||m.isArguments(c))){t||(c=S(c,t,r));var f=0,l=c.length;for(u.length+=l;l>f;)u[i++]=c[f++]}else r||(u[i++]=c)}return u};m.flatten=function(n,t){return S(n,t,!1)},m.without=function(n){return m.difference(n,l.call(arguments,1))},m.uniq=m.unique=function(n,t,r,e){m.isBoolean(t)||(e=r,r=t,t=!1),null!=r&&(r=x(r,e));for(var u=[],i=[],o=0,a=O(n);a>o;o++){var c=n[o],f=r?r(c,o,n):c;t?(o&&i===f||u.push(c),i=f):r?m.contains(i,f)||(i.push(f),u.push(c)):m.contains(u,c)||u.push(c)}return u},m.union=function(){return m.uniq(S(arguments,!0,!0))},m.intersection=function(n){for(var t=[],r=arguments.length,e=0,u=O(n);u>e;e++){var i=n[e];if(!m.contains(t,i)){for(var o=1;r>o&&m.contains(arguments[o],i);o++);o===r&&t.push(i)}}return t},m.difference=function(n){var t=S(arguments,!0,!0,1);return m.filter(n,function(n){return!m.contains(t,n)})},m.zip=function(){return m.unzip(arguments)},m.unzip=function(n){for(var t=n&&m.max(n,O).length||0,r=Array(t),e=0;t>e;e++)r[e]=m.pluck(n,e);return r},m.object=function(n,t){for(var r={},e=0,u=O(n);u>e;e++)t?r[n[e]]=t[e]:r[n[e][0]]=n[e][1];return r},m.findIndex=t(1),m.findLastIndex=t(-1),m.sortedIndex=function(n,t,r,e){r=x(r,e,1);for(var u=r(t),i=0,o=O(n);o>i;){var a=Math.floor((i+o)/2);r(n[a])<u?i=a+1:o=a}return i},m.indexOf=r(1,m.findIndex,m.sortedIndex),m.lastIndexOf=r(-1,m.findLastIndex),m.range=function(n,t,r){null==t&&(t=n||0,n=0),r=r||1;for(var e=Math.max(Math.ceil((t-n)/r),0),u=Array(e),i=0;e>i;i++,n+=r)u[i]=n;return u};var E=function(n,t,r,e,u){if(!(e instanceof t))return n.apply(r,u);var i=j(n.prototype),o=n.apply(i,u);return m.isObject(o)?o:i};m.bind=function(n,t){if(g&&n.bind===g)return g.apply(n,l.call(arguments,1));if(!m.isFunction(n))throw new TypeError("Bind must be called on a function");var r=l.call(arguments,2),e=function(){return E(n,e,t,this,r.concat(l.call(arguments)))};return e},m.partial=function(n){var t=l.call(arguments,1),r=function(){for(var e=0,u=t.length,i=Array(u),o=0;u>o;o++)i[o]=t[o]===m?arguments[e++]:t[o];for(;e<arguments.length;)i.push(arguments[e++]);return E(n,r,this,this,i)};return r},m.bindAll=function(n){var t,r,e=arguments.length;if(1>=e)throw new Error("bindAll must be passed function names");for(t=1;e>t;t++)r=arguments[t],n[r]=m.bind(n[r],n);return n},m.memoize=function(n,t){var r=function(e){var u=r.cache,i=""+(t?t.apply(this,arguments):e);return m.has(u,i)||(u[i]=n.apply(this,arguments)),u[i]};return r.cache={},r},m.delay=function(n,t){var r=l.call(arguments,2);return setTimeout(function(){return n.apply(null,r)},t)},m.defer=m.partial(m.delay,m,1),m.throttle=function(n,t,r){var e,u,i,o=null,a=0;r||(r={});var c=function(){a=r.leading===!1?0:m.now(),o=null,i=n.apply(e,u),o||(e=u=null)};return function(){var f=m.now();a||r.leading!==!1||(a=f);var l=t-(f-a);return e=this,u=arguments,0>=l||l>t?(o&&(clearTimeout(o),o=null),a=f,i=n.apply(e,u),o||(e=u=null)):o||r.trailing===!1||(o=setTimeout(c,l)),i}},m.debounce=function(n,t,r){var e,u,i,o,a,c=function(){var f=m.now()-o;t>f&&f>=0?e=setTimeout(c,t-f):(e=null,r||(a=n.apply(i,u),e||(i=u=null)))};return function(){i=this,u=arguments,o=m.now();var f=r&&!e;return e||(e=setTimeout(c,t)),f&&(a=n.apply(i,u),i=u=null),a}},m.wrap=function(n,t){return m.partial(t,n)},m.negate=function(n){return function(){return!n.apply(this,arguments)}},m.compose=function(){var n=arguments,t=n.length-1;return function(){for(var r=t,e=n[t].apply(this,arguments);r--;)e=n[r].call(this,e);return e}},m.after=function(n,t){return function(){return--n<1?t.apply(this,arguments):void 0}},m.before=function(n,t){var r;return function(){return--n>0&&(r=t.apply(this,arguments)),1>=n&&(t=null),r}},m.once=m.partial(m.before,2);var M=!{toString:null}.propertyIsEnumerable("toString"),I=["valueOf","isPrototypeOf","toString","propertyIsEnumerable","hasOwnProperty","toLocaleString"];m.keys=function(n){if(!m.isObject(n))return[];if(v)return v(n);var t=[];for(var r in n)m.has(n,r)&&t.push(r);return M&&e(n,t),t},m.allKeys=function(n){if(!m.isObject(n))return[];var t=[];for(var r in n)t.push(r);return M&&e(n,t),t},m.values=function(n){for(var t=m.keys(n),r=t.length,e=Array(r),u=0;r>u;u++)e[u]=n[t[u]];return e},m.mapObject=function(n,t,r){t=x(t,r);for(var e,u=m.keys(n),i=u.length,o={},a=0;i>a;a++)e=u[a],o[e]=t(n[e],e,n);return o},m.pairs=function(n){for(var t=m.keys(n),r=t.length,e=Array(r),u=0;r>u;u++)e[u]=[t[u],n[t[u]]];return e},m.invert=function(n){for(var t={},r=m.keys(n),e=0,u=r.length;u>e;e++)t[n[r[e]]]=r[e];return t},m.functions=m.methods=function(n){var t=[];for(var r in n)m.isFunction(n[r])&&t.push(r);return t.sort()},m.extend=_(m.allKeys),m.extendOwn=m.assign=_(m.keys),m.findKey=function(n,t,r){t=x(t,r);for(var e,u=m.keys(n),i=0,o=u.length;o>i;i++)if(e=u[i],t(n[e],e,n))return e},m.pick=function(n,t,r){var e,u,i={},o=n;if(null==o)return i;m.isFunction(t)?(u=m.allKeys(o),e=b(t,r)):(u=S(arguments,!1,!1,1),e=function(n,t,r){return t in r},o=Object(o));for(var a=0,c=u.length;c>a;a++){var f=u[a],l=o[f];e(l,f,o)&&(i[f]=l)}return i},m.omit=function(n,t,r){if(m.isFunction(t))t=m.negate(t);else{var e=m.map(S(arguments,!1,!1,1),String);t=function(n,t){return!m.contains(e,t)}}return m.pick(n,t,r)},m.defaults=_(m.allKeys,!0),m.create=function(n,t){var r=j(n);return t&&m.extendOwn(r,t),r},m.clone=function(n){return m.isObject(n)?m.isArray(n)?n.slice():m.extend({},n):n},m.tap=function(n,t){return t(n),n},m.isMatch=function(n,t){var r=m.keys(t),e=r.length;if(null==n)return!e;for(var u=Object(n),i=0;e>i;i++){var o=r[i];if(t[o]!==u[o]||!(o in u))return!1}return!0};var N=function(n,t,r,e){if(n===t)return 0!==n||1/n===1/t;if(null==n||null==t)return n===t;n instanceof m&&(n=n._wrapped),t instanceof m&&(t=t._wrapped);var u=s.call(n);if(u!==s.call(t))return!1;switch(u){case"[object RegExp]":case"[object String]":return""+n==""+t;case"[object Number]":return+n!==+n?+t!==+t:0===+n?1/+n===1/t:+n===+t;case"[object Date]":case"[object Boolean]":return+n===+t}var i="[object Array]"===u;if(!i){if("object"!=typeof n||"object"!=typeof t)return!1;var o=n.constructor,a=t.constructor;if(o!==a&&!(m.isFunction(o)&&o instanceof o&&m.isFunction(a)&&a instanceof a)&&"constructor"in n&&"constructor"in t)return!1}r=r||[],e=e||[];for(var c=r.length;c--;)if(r[c]===n)return e[c]===t;if(r.push(n),e.push(t),i){if(c=n.length,c!==t.length)return!1;for(;c--;)if(!N(n[c],t[c],r,e))return!1}else{var f,l=m.keys(n);if(c=l.length,m.keys(t).length!==c)return!1;for(;c--;)if(f=l[c],!m.has(t,f)||!N(n[f],t[f],r,e))return!1}return r.pop(),e.pop(),!0};m.isEqual=function(n,t){return N(n,t)},m.isEmpty=function(n){return null==n?!0:k(n)&&(m.isArray(n)||m.isString(n)||m.isArguments(n))?0===n.length:0===m.keys(n).length},m.isElement=function(n){return!(!n||1!==n.nodeType)},m.isArray=h||function(n){return"[object Array]"===s.call(n)},m.isObject=function(n){var t=typeof n;return"function"===t||"object"===t&&!!n},m.each(["Arguments","Function","String","Number","Date","RegExp","Error"],function(n){m["is"+n]=function(t){return s.call(t)==="[object "+n+"]"}}),m.isArguments(arguments)||(m.isArguments=function(n){return m.has(n,"callee")}),"function"!=typeof/./&&"object"!=typeof Int8Array&&(m.isFunction=function(n){return"function"==typeof n||!1}),m.isFinite=function(n){return isFinite(n)&&!isNaN(parseFloat(n))},m.isNaN=function(n){return m.isNumber(n)&&n!==+n},m.isBoolean=function(n){return n===!0||n===!1||"[object Boolean]"===s.call(n)},m.isNull=function(n){return null===n},m.isUndefined=function(n){return n===void 0},m.has=function(n,t){return null!=n&&p.call(n,t)},m.noConflict=function(){return u._=i,this},m.identity=function(n){return n},m.constant=function(n){return function(){return n}},m.noop=function(){},m.property=w,m.propertyOf=function(n){return null==n?function(){}:function(t){return n[t]}},m.matcher=m.matches=function(n){return n=m.extendOwn({},n),function(t){return m.isMatch(t,n)}},m.times=function(n,t,r){var e=Array(Math.max(0,n));t=b(t,r,1);for(var u=0;n>u;u++)e[u]=t(u);return e},m.random=function(n,t){return null==t&&(t=n,n=0),n+Math.floor(Math.random()*(t-n+1))},m.now=Date.now||function(){return(new Date).getTime()};var B={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},T=m.invert(B),R=function(n){var t=function(t){return n[t]},r="(?:"+m.keys(n).join("|")+")",e=RegExp(r),u=RegExp(r,"g");return function(n){return n=null==n?"":""+n,e.test(n)?n.replace(u,t):n}};m.escape=R(B),m.unescape=R(T),m.result=function(n,t,r){var e=null==n?void 0:n[t];return e===void 0&&(e=r),m.isFunction(e)?e.call(n):e};var q=0;m.uniqueId=function(n){var t=++q+"";return n?n+t:t},m.templateSettings={evaluate:/<%([\s\S]+?)%>/g,interpolate:/<%=([\s\S]+?)%>/g,escape:/<%-([\s\S]+?)%>/g};var K=/(.)^/,z={"'":"'","\\":"\\","\r":"r","\n":"n","\u2028":"u2028","\u2029":"u2029"},D=/\\|'|\r|\n|\u2028|\u2029/g,L=function(n){return"\\"+z[n]};m.template=function(n,t,r){!t&&r&&(t=r),t=m.defaults({},t,m.templateSettings);var e=RegExp([(t.escape||K).source,(t.interpolate||K).source,(t.evaluate||K).source].join("|")+"|$","g"),u=0,i="__p+='";n.replace(e,function(t,r,e,o,a){return i+=n.slice(u,a).replace(D,L),u=a+t.length,r?i+="'+\n((__t=("+r+"))==null?'':_.escape(__t))+\n'":e?i+="'+\n((__t=("+e+"))==null?'':__t)+\n'":o&&(i+="';\n"+o+"\n__p+='"),t}),i+="';\n",t.variable||(i="with(obj||{}){\n"+i+"}\n"),i="var __t,__p='',__j=Array.prototype.join,"+"print=function(){__p+=__j.call(arguments,'');};\n"+i+"return __p;\n";try{var o=new Function(t.variable||"obj","_",i)}catch(a){throw a.source=i,a}var c=function(n){return o.call(this,n,m)},f=t.variable||"obj";return c.source="function("+f+"){\n"+i+"}",c},m.chain=function(n){var t=m(n);return t._chain=!0,t};var P=function(n,t){return n._chain?m(t).chain():t};m.mixin=function(n){m.each(m.functions(n),function(t){var r=m[t]=n[t];m.prototype[t]=function(){var n=[this._wrapped];return f.apply(n,arguments),P(this,r.apply(m,n))}})},m.mixin(m),m.each(["pop","push","reverse","shift","sort","splice","unshift"],function(n){var t=o[n];m.prototype[n]=function(){var r=this._wrapped;return t.apply(r,arguments),"shift"!==n&&"splice"!==n||0!==r.length||delete r[0],P(this,r)}}),m.each(["concat","join","slice"],function(n){var t=o[n];m.prototype[n]=function(){return P(this,t.apply(this._wrapped,arguments))}}),m.prototype.value=function(){return this._wrapped},m.prototype.valueOf=m.prototype.toJSON=m.prototype.value,m.prototype.toString=function(){return""+this._wrapped},"function"==typeof define&&define.amd&&define("underscore",[],function(){return m})}).call(this);
//# sourceMappingURL=underscore-min.map
/**
 * Bootstrap based calendar full view.
 *
 * https://github.com/Serhioromano/bootstrap-calendar
 *
 * User: Sergey Romanov <serg4172@mail.ru>
 */
"use strict";

Date.prototype.getWeek = function(iso8601) {
	if (iso8601) {
		var target = new Date(this.valueOf());
		var dayNr  = (this.getDay() + 6) % 7;
		target.setDate(target.getDate() - dayNr + 3);
		var firstThursday = target.valueOf();
		target.setMonth(0, 1);
		if (target.getDay() != 4) {
			target.setMonth(0, 1 + ((4 - target.getDay()) + 7) % 7);
		}
		return 1 + Math.ceil((firstThursday - target) / 604800000); // 604800000 = 7 * 24 * 3600 * 1000
	} else {
		var onejan = new Date(this.getFullYear(), 0, 1);
		return Math.ceil((((this.getTime() - onejan.getTime()) / 86400000) + onejan.getDay() + 1) / 7);
	}
};
Date.prototype.getMonthFormatted = function() {
	var month = this.getMonth() + 1;
	return month < 10 ? '0' + month : month;
};
Date.prototype.getDateFormatted = function() {
	var date = this.getDate();
	return date < 10 ? '0' + date : date;
};

if(!String.prototype.format) {
	String.prototype.format = function() {
		var args = arguments;
		return this.replace(/{(\d+)}/g, function(match, number) {
			return typeof args[number] != 'undefined' ? args[number] : match;
		});
	};
}
if(!String.prototype.formatNum) {
	String.prototype.formatNum = function(decimal) {
		var r = "" + this;
		while(r.length < decimal)
			r = "0" + r;
		return r;
	};
}

(function($) {

	var defaults = {
        // Container to append the tooltip
        tooltip_container : 'body',
		// Width of the calendar
		width: '100%',
		// Initial view (can be 'month', 'week', 'day')
		view: 'month',
		// Initial date. No matter month, week or day this will be a starting point. Can be 'now' or a date in format 'yyyy-mm-dd'
		day: 'now',
		// Day Start time and end time with time intervals. Time split 10, 15 or 30.
		time_start: '06:00',
		time_end: '22:00',
		time_split: '30',
		// Source of events data. It can be one of the following:
		// - URL to return JSON list of events in special format.
		//   {success:1, result: [....]} or for error {success:0, error:'Something terrible happened'}
		//   events: [...] as described in events property description
		//   The start and end variables will be sent to this url
		// - A function that received the start and end date, and that
		//   returns an array of events (as described in events property description)
		// - An array containing the events
		events_source: '',
		// Static cache of events. If set to true, events will only be loaded once.
		// Useful if response is not constrained by date.
		events_cache: false,
		// Set format12 to true if you want to use 12 Hour format instead of 24 Hour
		format12: false,
		am_suffix: "AM",
		pm_suffix: "PM",
		// Path to templates should end with slash /. It can be as relative
		// /component/bootstrap-calendar/tmpls/
		// or absolute
		// http://localhost/component/bootstrap-calendar/tmpls/
		tmpl_path: 'tmpls/',
		tmpl_cache: true,
		classes: {
			months: {
				inmonth: 'cal-day-inmonth',
				outmonth: 'cal-day-outmonth',
				saturday: 'cal-day-weekend',
				sunday: 'cal-day-weekend',
				holidays: 'cal-day-holiday',
				today: 'cal-day-today'
			},
			week: {
				workday: 'cal-day-workday',
				saturday: 'cal-day-weekend',
				sunday: 'cal-day-weekend',
				holidays: 'cal-day-holiday',
				today: 'cal-day-today'
			}
		},
		// ID of the element of modal window. If set, events URLs will be opened in modal windows.
		modal: null,
		//	modal handling setting, one of "iframe", "ajax" or "template"
		modal_type: "iframe",
		//	function to set modal title, will be passed the event as a parameter
		modal_title: null,
		views: {
			year: {
				slide_events: 1,
				enable: 1
			},
			month: {
				slide_events: 1,
				enable: 1
			},
			week: {
				enable: 1
			},
			day: {
				enable: 1
			}
		},
		merge_holidays: false,
		display_week_numbers: true,
		weekbox: true,
		// ------------------------------------------------------------
		// CALLBACKS. Events triggered by calendar class. You can use
		// those to affect you UI
		// ------------------------------------------------------------
		onAfterEventsLoad: function(events) {
			// Inside this function 'this' is the calendar instance
		},
		onBeforeEventsLoad: function(next) {
			// Inside this function 'this' is the calendar instance
			next();
		},
		onAfterViewLoad: function(view) {
			// Inside this function 'this' is the calendar instance
		},
		onAfterModalShown: function(events) {
			// Inside this function 'this' is the calendar instance
		},
		onAfterModalHidden: function(events) {
			// Inside this function 'this' is the calendar instance
		},
		// -------------------------------------------------------------
		// INTERNAL USE ONLY. DO NOT ASSIGN IT WILL BE OVERRIDDEN ANYWAY
		// -------------------------------------------------------------
		events: [],
		templates: {
			year: '',
			month: '',
			week: '',
			day: ''
		},
		stop_cycling: false
	};

	var defaults_extended = {
		first_day: 2,
		week_numbers_iso_8601: false,
		holidays: {
			// January 1
			'01-01': "New Year's Day",
			// Third (+3*) Monday (1) in January (01)
			'01+3*1': "Birthday of Dr. Martin Luther King, Jr.",
			// Third (+3*) Monday (1) in February (02)
			'02+3*1': "Washington's Birthday",
			// Last (-1*) Monday (1) in May (05)
			'05-1*1': "Memorial Day",
			// July 4
			'04-07': "Independence Day",
			// First (+1*) Monday (1) in September (09)
			'09+1*1': "Labor Day",
			// Second (+2*) Monday (1) in October (10)
			'10+2*1': "Columbus Day",
			// November 11
			'11-11': "Veterans Day",
			// Fourth (+4*) Thursday (4) in November (11)
			'11+4*4': "Thanksgiving Day",
			// December 25
			'25-12': "Christmas"
		}
	};

	var strings = {
		error_noview: 'Calendar: View {0} not found',
		error_dateformat: 'Calendar: Wrong date format {0}. Should be either "now" or "yyyy-mm-dd"',
		error_loadurl: 'Calendar: Event URL is not set',
		error_where: 'Calendar: Wrong navigation direction {0}. Can be only "next" or "prev" or "today"',
		error_timedevide: 'Calendar: Time split parameter should divide 60 without decimals. Something like 10, 15, 30',

		no_events_in_day: 'No events in this day.',

		title_year: '{0}',
		title_month: '{0} {1}',
		title_week: 'week {0} of {1}',
		title_day: '{0} {1} {2}, {3}',

		week: 'Week {0}',
		all_day: 'All day',
		time: 'Time',
		events: 'Events',
		before_time: 'Ends before timeline',
		after_time: 'Starts after timeline',

		m0: 'January',
		m1: 'February',
		m2: 'March',
		m3: 'April',
		m4: 'May',
		m5: 'June',
		m6: 'July',
		m7: 'August',
		m8: 'September',
		m9: 'October',
		m10: 'November',
		m11: 'December',

		ms0: 'Jan',
		ms1: 'Feb',
		ms2: 'Mar',
		ms3: 'Apr',
		ms4: 'May',
		ms5: 'Jun',
		ms6: 'Jul',
		ms7: 'Aug',
		ms8: 'Sep',
		ms9: 'Oct',
		ms10: 'Nov',
		ms11: 'Dec',

		d0: 'Sunday',
		d1: 'Monday',
		d2: 'Tuesday',
		d3: 'Wednesday',
		d4: 'Thursday',
		d5: 'Friday',
		d6: 'Saturday'
	};

	var browser_timezone = '';
	try {
		if($.type(window.jstz) == 'object' && $.type(jstz.determine) == 'function') {
			browser_timezone = jstz.determine().name();
			if($.type(browser_timezone) !== 'string') {
				browser_timezone = '';
			}
		}
	}
	catch(e) {
	}

	function buildEventsUrl(events_url, data) {
		var separator, key, url;
		url = events_url;
		separator = (events_url.indexOf('?') < 0) ? '?' : '&';
		for(key in data) {
			url += separator + key + '=' + encodeURIComponent(data[key]);
			separator = '&';
		}
		return url;
	}

	function getExtentedOption(cal, option_name) {
		var fromOptions = (cal.options[option_name] != null) ? cal.options[option_name] : null;
		var fromLanguage = (cal.locale[option_name] != null) ? cal.locale[option_name] : null;
		if((option_name == 'holidays') && cal.options.merge_holidays) {
			var holidays = {};
			$.extend(true, holidays, fromLanguage ? fromLanguage : defaults_extended.holidays);
			if(fromOptions) {
				$.extend(true, holidays, fromOptions);
			}
			return holidays;
		}
		else {
			if(fromOptions != null) {
				return fromOptions;
			}
			if(fromLanguage != null) {
				return fromLanguage;
			}
			return defaults_extended[option_name];
		}
	}

	function getHolidays(cal, year) {
		var hash = [];
		var holidays_def = getExtentedOption(cal, 'holidays');
		for(var k in holidays_def) {
			hash.push(k + ':' + holidays_def[k]);
		}
		hash.push(year);
		hash = hash.join('|');
		if(hash in getHolidays.cache) {
			return getHolidays.cache[hash];
		}
		var holidays = [];
		$.each(holidays_def, function(key, name) {
			var firstDay = null, lastDay = null, failed = false;
			$.each(key.split('>'), function(i, chunk) {
				var m, date = null;
				if(m = /^(\d\d)-(\d\d)$/.exec(chunk)) {
					date = new Date(year, parseInt(m[2], 10) - 1, parseInt(m[1], 10));
				}
				else if(m = /^(\d\d)-(\d\d)-(\d\d\d\d)$/.exec(chunk)) {
					if(parseInt(m[3], 10) == year) {
						date = new Date(year, parseInt(m[2], 10) - 1, parseInt(m[1], 10));
					}
				}
				else if(m = /^easter(([+\-])(\d+))?$/.exec(chunk)) {
					date = getEasterDate(year, m[1] ? parseInt(m[1], 10) : 0);
				}
				else if(m = /^(\d\d)([+\-])([1-5])\*([0-6])$/.exec(chunk)) {
					var month = parseInt(m[1], 10) - 1;
					var direction = m[2];
					var offset = parseInt(m[3]);
					var weekday = parseInt(m[4]);
					switch(direction) {
						case '+':
							var d = new Date(year, month, 1 - 7);
							while(d.getDay() != weekday) {
								d = new Date(d.getFullYear(), d.getMonth(), d.getDate() + 1);
							}
							date = new Date(d.getFullYear(), d.getMonth(), d.getDate() + 7 * offset);
							break;
						case '-':
							var d = new Date(year, month + 1, 0 + 7);
							while(d.getDay() != weekday) {
								d = new Date(d.getFullYear(), d.getMonth(), d.getDate() - 1);
							}
							date = new Date(d.getFullYear(), d.getMonth(), d.getDate() - 7 * offset);
							break;
					}
				}
				if(!date) {
					warn('Unknown holiday: ' + key);
					failed = true;
					return false;
				}
				switch(i) {
					case 0:
						firstDay = date;
						break;
					case 1:
						if(date.getTime() <= firstDay.getTime()) {
							warn('Unknown holiday: ' + key);
							failed = true;
							return false;
						}
						lastDay = date;
						break;
					default:
						warn('Unknown holiday: ' + key);
						failed = true;
						return false;
				}
			});
			if(!failed) {
				var days = [];
				if(lastDay) {
					for(var date = new Date(firstDay.getTime()); date.getTime() <= lastDay.getTime(); date.setDate(date.getDate() + 1)) {
						days.push(new Date(date.getTime()));
					}
				}
				else {
					days.push(firstDay);
				}
				holidays.push({name: name, days: days});
			}
		});
		getHolidays.cache[hash] = holidays;
		return getHolidays.cache[hash];
	}

	getHolidays.cache = {};

	function warn(message) {
		if($.type(window.console) == 'object' && $.type(window.console.warn) == 'function') {
			window.console.warn('[Bootstrap-Calendar] ' + message);
		}
	}

	function Calendar(params, context) {
		this.options = $.extend(true, {position: {start: new Date(), end: new Date()}}, defaults, params);
		this.setLanguage(this.options.language);
		this.context = context;

		context.css('width', this.options.width).addClass('cal-context');

		this.view();
		return this;
	}

	Calendar.prototype.setOptions = function(object) {
		$.extend(this.options, object);
		if('language' in object) {
			this.setLanguage(object.language);
		}
		if('modal' in object) {
			this._update_modal();
		}
	}

	Calendar.prototype.setLanguage = function(lang) {
		if(window.calendar_languages && (lang in window.calendar_languages)) {
			this.locale = $.extend(true, {}, strings, calendar_languages[lang]);
			this.options.language = lang;
		} else {
			this.locale = strings;
			delete this.options.language;
		}
	}

	Calendar.prototype._render = function() {
		this.context.html('');
		this._loadTemplate(this.options.view);
		this.stop_cycling = false;

		var data = {};
		data.cal = this;
		data.day = 1;

		// Getting list of days in a week in correct order. Works for month and week views
		if(getExtentedOption(this, 'first_day') == 1) {
			data.days_name = [this.locale.d1, this.locale.d2, this.locale.d3, this.locale.d4, this.locale.d5, this.locale.d6, this.locale.d0]
		} else {
			data.days_name = [this.locale.d0, this.locale.d1, this.locale.d2, this.locale.d3, this.locale.d4, this.locale.d5, this.locale.d6]
		}

		// Get all events between start and end
		var start = parseInt(this.options.position.start.getTime());
		var end = parseInt(this.options.position.end.getTime());

		data.events = this.getEventsBetween(start, end);

		switch(this.options.view) {
			case 'month':
				break;
			case 'week':
				this._calculate_hour_minutes(data);
				break;
			case 'day':
				this._calculate_hour_minutes(data);
				break;
		}

		data.start = new Date(this.options.position.start.getTime());
		data.lang = this.locale;

		this.context.append(this.options.templates[this.options.view](data));
		this._update();
	};

	Calendar.prototype._format_hour = function(str_hour) {
		var hour_split = str_hour.split(":");
		var hour = parseInt(hour_split[0]);
		var minutes = parseInt(hour_split[1]);

		var suffix = '';

		if(this.options.format12) {
			if(hour < 12) {
				suffix = this.options.am_suffix;
			}
			else {
				suffix = this.options.pm_suffix;
			}

			hour = hour % 12;
			if(hour == 0) {
				hour = 12;
			}
		}

		return hour.toString().formatNum(2) + ':' + minutes.toString().formatNum(2) + suffix;
	};

	Calendar.prototype._format_time = function(datetime) {
		return this._format_hour(datetime.getHours() + ':' + datetime.getMinutes());
	};

	Calendar.prototype._calculate_hour_minutes = function(data) {
		var $self = this;
		var time_split = parseInt(this.options.time_split);
		var time_split_count = 60 / time_split;
		var time_split_hour = Math.min(time_split_count, 1);

		if(((time_split_count >= 1) && (time_split_count % 1 != 0)) || ((time_split_count < 1) && (1440 / time_split % 1 != 0))) {
			$.error(this.locale.error_timedevide);
		}

		var time_start = this.options.time_start.split(":");
		var time_end = this.options.time_end.split(":");

		data.hours = (parseInt(time_end[0]) - parseInt(time_start[0])) * time_split_hour;
		var lines = data.hours * time_split_count - parseInt(time_start[1]) / time_split;
		var ms_per_line = (60000 * time_split);

		var start = new Date(this.options.position.start.getTime());
		start.setHours(time_start[0]);
		start.setMinutes(time_start[1]);
		var end = new Date(this.options.position.end.getTime());
		end.setHours(time_end[0]);
		end.setMinutes(time_end[1]);

		data.all_day = [];
		data.by_hour = [];
		data.after_time = [];
		data.before_time = [];
		$.each(data.events, function(k, e) {
			var s = new Date(parseInt(e.start));
			var f = new Date(parseInt(e.end));

			e.start_hour = $self._format_time(s);
			e.end_hour = $self._format_time(f);

			if(e.start < start.getTime()) {
				warn(1);
				e.start_hour = s.getDate() + ' ' + $self.locale['ms' + s.getMonth()] + ' ' + e.start_hour;
			}

			if(e.end > end.getTime()) {
				warn(1);
				e.end_hour = f.getDate() + ' ' + $self.locale['ms' + f.getMonth()] + ' ' + e.end_hour;
			}

			if(e.start < start.getTime() && e.end > end.getTime()) {
				data.all_day.push(e);
				return;
			}

			if(e.end < start.getTime()) {
				data.before_time.push(e);
				return;
			}

			if(e.start > end.getTime()) {
				data.after_time.push(e);
				return;
			}

			var event_start = start.getTime() - e.start;

			if(event_start >= 0) {
				e.top = 0;
			} else {
				e.top = Math.abs(event_start) / ms_per_line;
			}

			var lines_left = Math.abs(lines - e.top);
			var lines_in_event = (e.end - e.start) / ms_per_line;
			if(event_start >= 0) {
				lines_in_event = (e.end - start.getTime()) / ms_per_line;
			}

			e.lines = lines_in_event;
			if(lines_in_event > lines_left) {
				e.lines = lines_left;
			}

			data.by_hour.push(e);
		});

		//var d = new Date('2013-03-14 13:20:00');
		//warn(d.getTime());
	};

	Calendar.prototype._hour_min = function(hour) {
		var time_start = this.options.time_start.split(":");
		var time_split = parseInt(this.options.time_split);
		var in_hour = 60 / time_split;
		return (hour == 0) ? (in_hour - (parseInt(time_start[1]) / time_split)) : in_hour;
	};

	Calendar.prototype._hour = function(hour, part) {
		var time_start = this.options.time_start.split(":");
		var time_split = parseInt(this.options.time_split);
		var h = "" + (parseInt(time_start[0]) + hour * Math.max(time_split / 60, 1));
		var m = "" + time_split * part;

		return this._format_hour(h.formatNum(2) + ":" + m.formatNum(2));
	};

	Calendar.prototype._week = function(event) {
		this._loadTemplate('week-days');

		var t = {};
		var start = parseInt(this.options.position.start.getTime());
		var end = parseInt(this.options.position.end.getTime());
		var events = [];
		var self = this;
		var first_day = getExtentedOption(this, 'first_day');

		$.each(this.getEventsBetween(start, end), function(k, event) {
			event.start_day = new Date(parseInt(event.start)).getDay();
			if(first_day == 1) {
				event.start_day = (event.start_day + 6) % 7;
			}
			if((event.end - event.start) <= 86400000) {
				event.days = 1;
			} else {
				event.days = ((event.end - event.start) / 86400000);
			}

			if(event.start < start) {

				event.days = event.days - ((start - event.start) / 86400000);
				event.start_day = 0;
			}

			event.days = Math.ceil(event.days);

			if(event.start_day + event.days > 7) {
				event.days = 7 - (event.start_day);
			}

			events.push(event);
		});
		t.events = events;
		t.cal = this;
		return self.options.templates['week-days'](t);
	}

	Calendar.prototype._month = function(month) {
		this._loadTemplate('year-month');

		var t = {cal: this};
		var newmonth = month + 1;
		t.data_day = this.options.position.start.getFullYear() + '-' + (newmonth < 10 ? '0' + newmonth : newmonth) + '-' + '01';
		t.month_name = this.locale['m' + month];

		var curdate = new Date(this.options.position.start.getFullYear(), month, 1, 0, 0, 0);
		t.start = parseInt(curdate.getTime());
		t.end = parseInt(new Date(this.options.position.start.getFullYear(), month + 1, 1, 0, 0, 0).getTime());
		t.events = this.getEventsBetween(t.start, t.end);
		return this.options.templates['year-month'](t);
	}

	Calendar.prototype._day = function(week, day) {
		this._loadTemplate('month-day');

		var t = {tooltip: '', cal: this};
		var cls = this.options.classes.months.outmonth;

		var firstday = this.options.position.start.getDay();
		if(getExtentedOption(this, 'first_day') == 2) {
			firstday++;
		} else {
			firstday = (firstday == 0 ? 7 : firstday);
		}

		day = (day - firstday) + 1;
		var curdate = new Date(this.options.position.start.getFullYear(), this.options.position.start.getMonth(), day, 0, 0, 0);

		// if day of the current month
		if(day > 0) {
			cls = this.options.classes.months.inmonth;
		}
		// stop cycling table rows;
		var daysinmonth = (new Date(this.options.position.end.getTime() - 1)).getDate();
		if((day + 1) > daysinmonth) {
			this.stop_cycling = true;
		}
		// if day of the next month
		if(day > daysinmonth) {
			day = day - daysinmonth;
			cls = this.options.classes.months.outmonth;
		}

		cls = $.trim(cls + " " + this._getDayClass("months", curdate));

		if(day <= 0) {
			var daysinprevmonth = (new Date(this.options.position.start.getFullYear(), this.options.position.start.getMonth(), 0)).getDate();
			day = daysinprevmonth - Math.abs(day);
			cls += ' cal-month-first-row';
		}

		var holiday = this._getHoliday(curdate);
		if(holiday !== false) {
			t.tooltip = holiday;
		}

		t.data_day = curdate.getFullYear() + '-' + curdate.getMonthFormatted() + '-' + (day < 10 ? '0' + day : day);
		t.cls = cls;
		t.day = day;

		t.start = parseInt(curdate.getTime());
		t.end = parseInt(t.start + 86400000);
		t.events = this.getEventsBetween(t.start, t.end);
		return this.options.templates['month-day'](t);
	}

	Calendar.prototype._getHoliday = function(date) {
		var result = false;
		$.each(getHolidays(this, date.getFullYear()), function() {
			var found = false;
			$.each(this.days, function() {
				if(this.toDateString() == date.toDateString()) {
					found = true;
					return false;
				}
			});
			if(found) {
				result = this.name;
				return false;
			}
		});
		return result;
	};

	Calendar.prototype._getHolidayName = function(date) {
		var holiday = this._getHoliday(date);
		return (holiday === false) ? "" : holiday;
	};

	Calendar.prototype._getDayClass = function(class_group, date) {
		var self = this;
		var addClass = function(which, to) {
			var cls;
			cls = (self.options.classes && (class_group in self.options.classes) && (which in self.options.classes[class_group])) ? self.options.classes[class_group][which] : "";
			if((typeof(cls) == "string") && cls.length) {
				to.push(cls);
			}
		};
		var classes = [];
		if(date.toDateString() == (new Date()).toDateString()) {
			addClass("today", classes);
		}
		var holiday = this._getHoliday(date);
		if(holiday !== false) {
			addClass("holidays", classes);
		}
		switch(date.getDay()) {
			case 0:
				addClass("sunday", classes);
				break;
			case 6:
				addClass("saturday", classes);
				break;
		}

		addClass(date.toDateString(), classes);

		return classes.join(" ");
	};

	Calendar.prototype.view = function(view) {
		if(view) {
			if(!this.options.views[view].enable) {
				return;
			}
			this.options.view = view;
		}

		this._init_position();
		this._loadEvents();
		this._render();

		this.options.onAfterViewLoad.call(this, this.options.view);
	};

	Calendar.prototype.navigate = function(where, next) {
		var to = $.extend({}, this.options.position);
		if(where == 'next') {
			switch(this.options.view) {
				case 'year':
					to.start.setFullYear(this.options.position.start.getFullYear() + 1);
					break;
				case 'month':
					to.start.setMonth(this.options.position.start.getMonth() + 1);
					break;
				case 'week':
					to.start.setDate(this.options.position.start.getDate() + 7);
					break;
				case 'day':
					to.start.setDate(this.options.position.start.getDate() + 1);
					break;
			}
		} else if(where == 'prev') {
			switch(this.options.view) {
				case 'year':
					to.start.setFullYear(this.options.position.start.getFullYear() - 1);
					break;
				case 'month':
					to.start.setMonth(this.options.position.start.getMonth() - 1);
					break;
				case 'week':
					to.start.setDate(this.options.position.start.getDate() - 7);
					break;
				case 'day':
					to.start.setDate(this.options.position.start.getDate() - 1);
					break;
			}
		} else if(where == 'today') {
			to.start.setTime(new Date().getTime());
		}
		else {
			$.error(this.locale.error_where.format(where))
		}
		this.options.day = to.start.getFullYear() + '-' + to.start.getMonthFormatted() + '-' + to.start.getDateFormatted();
		this.view();
		if(_.isFunction(next)) {
			next();
		}
	};

	Calendar.prototype._init_position = function() {
		var year, month, day;

		if(this.options.day == 'now') {
			var date = new Date();
			year = date.getFullYear();
			month = date.getMonth();
			day = date.getDate();
		} else if(this.options.day.match(/^\d{4}-\d{2}-\d{2}$/g)) {
			var list = this.options.day.split('-');
			year = parseInt(list[0], 10);
			month = parseInt(list[1], 10) - 1;
			day = parseInt(list[2], 10);
		}
		else {
			$.error(this.locale.error_dateformat.format(this.options.day));
		}

		switch(this.options.view) {
			case 'year':
				this.options.position.start.setTime(new Date(year, 0, 1).getTime());
				this.options.position.end.setTime(new Date(year + 1, 0, 1).getTime());
				break;
			case 'month':
				this.options.position.start.setTime(new Date(year, month, 1).getTime());
				this.options.position.end.setTime(new Date(year, month + 1, 1).getTime());
				break;
			case 'day':
				this.options.position.start.setTime(new Date(year, month, day).getTime());
				this.options.position.end.setTime(new Date(year, month, day + 1).getTime());
				break;
			case 'week':
				var curr = new Date(year, month, day);
				var first;
				if(getExtentedOption(this, 'first_day') == 1) {
					first = curr.getDate() - ((curr.getDay() + 6) % 7);
				}
				else {
					first = curr.getDate() - curr.getDay();
				}
				this.options.position.start.setTime(new Date(year, month, first).getTime());
				this.options.position.end.setTime(new Date(year, month, first + 7).getTime());
				break;
			default:
				$.error(this.locale.error_noview.format(this.options.view))
		}
		return this;
	};

	Calendar.prototype.getTitle = function() {
		var p = this.options.position.start;
		switch(this.options.view) {
			case 'year':
				return this.locale.title_year.format(p.getFullYear());
				break;
			case 'month':
				return this.locale.title_month.format(this.locale['m' + p.getMonth()], p.getFullYear());
				break;
			case 'week':
				return this.locale.title_week.format(p.getWeek(getExtentedOption(this, 'week_numbers_iso_8601')), p.getFullYear());
				break;
			case 'day':
				return this.locale.title_day.format(this.locale['d' + p.getDay()], p.getDate(), this.locale['m' + p.getMonth()], p.getFullYear());
				break;
		}
		return;
	};
	
	Calendar.prototype.getYear = function() {
		var p = this.options.position.start;
		return p.getFullYear();
	};

	Calendar.prototype.getMonth = function() {
		var p = this.options.position.start;
		return this.locale['m' + p.getMonth()];
	};

	Calendar.prototype.getDay = function() {
		var p = this.options.position.start;
		return this.locale['d' + p.getDay()];
	};

	Calendar.prototype.isToday = function() {
		var now = new Date().getTime();

		return ((now > this.options.position.start) && (now < this.options.position.end));
	}

	Calendar.prototype.getStartDate = function() {
		return this.options.position.start;
	}

	Calendar.prototype.getEndDate = function() {
		return this.options.position.end;
	}

	Calendar.prototype._loadEvents = function() {
		var self = this;
		var source = null;
		if('events_source' in this.options && this.options.events_source !== '') {
			source = this.options.events_source;
		}
		else if('events_url' in this.options) {
			source = this.options.events_url;
			warn('The events_url option is DEPRECATED and it will be REMOVED in near future. Please use events_source instead.');
		}
		var loader;
		switch($.type(source)) {
			case 'function':
				loader = function() {
					return source(self.options.position.start, self.options.position.end, browser_timezone);
				};
				break;
			case 'array':
				loader = function() {
					return [].concat(source);
				};
				break;
			case 'string':
				if(source.length) {
					loader = function() {
						var events = [];
                                                var d_from = self.options.position.start;
                                                var d_to = self.options.position.end;
                                                var params = {from: d_from.getTime(), to: d_to.getTime(), utc_offset_from: d_from.getTimezoneOffset(), utc_offset_to: d_to.getTimezoneOffset()};

						if(browser_timezone.length) {
							params.browser_timezone = browser_timezone;
						}
						$.ajax({
							url: buildEventsUrl(source, params),
							dataType: 'json',
							type: 'GET',
							async: false
						}).done(function(json) {
							if(!json.success) {
								$.error(json.error);
							}
							if(json.result) {
								events = json.result;
							}
						});
						return events;
					};
				}
				break;
		}
		if(!loader) {
			$.error(this.locale.error_loadurl);
		}
		this.options.onBeforeEventsLoad.call(this, function() {
			if (!self.options.events.length || !self.options.events_cache) {
				self.options.events = loader();
				self.options.events.sort(function (a, b) {
					var delta;
					delta = a.start - b.start;
					if (delta == 0) {
						delta = a.end - b.end;
					}
					return delta;
				});
			}
			self.options.onAfterEventsLoad.call(self, self.options.events);
		});
	};

	Calendar.prototype._templatePath = function(name) {
		if(typeof this.options.tmpl_path == 'function') {
			return this.options.tmpl_path(name)
		}
		else {
			return this.options.tmpl_path + name + '.html';
		}
	};

	Calendar.prototype._loadTemplate = function(name) {
		if(this.options.templates[name]) {
			return;
		}
		var self = this;
		$.ajax({
			url: self._templatePath(name),
			dataType: 'html',
			type: 'GET',
			async: false,
			cache: this.options.tmpl_cache
		}).done(function(html) {
			self.options.templates[name] = _.template(html);
		});
	};

	Calendar.prototype._update = function() {
		var self = this;

		$('*[data-toggle="tooltip"]').tooltip({container: this.options.tooltip_container});

		$('*[data-cal-date]').click(function() {
			var view = $(this).data('cal-view');
			self.options.day = $(this).data('cal-date');
			self.view(view);
		});
		$('.cal-cell').dblclick(function() {
			var view = $('[data-cal-date]', this).data('cal-view');
			self.options.day = $('[data-cal-date]', this).data('cal-date');
			self.view(view);
		});

		this['_update_' + this.options.view]();

		this._update_modal();

	};

	Calendar.prototype._update_modal = function() {
		var self = this;

		$('a[data-event-id]', this.context).unbind('click');

		if(!self.options.modal) {
			return;
		}

		var modal = $(self.options.modal);

		if(!modal.length) {
			return;
		}

		var ifrm = null;
		if(self.options.modal_type == "iframe") {
			ifrm = $(document.createElement("iframe"))
				.attr({
					width: "100%",
					frameborder: "0"
				});
		}

		$('a[data-event-id]', this.context).on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();

			var url = $(this).attr('href');
			var id = $(this).data("event-id");
			var event = _.find(self.options.events, function(event) {
				return event.id == id
			});

			if(self.options.modal_type == "iframe") {
				ifrm.attr('src', url);
				$('.modal-body', modal).html(ifrm);
			}

			if(!modal.data('handled.bootstrap-calendar') || (modal.data('handled.bootstrap-calendar') && modal.data('handled.event-id') != event.id)) {
				modal.off('show.bs.modal')
					.off('shown.bs.modal')
					.off('hidden.bs.modal')
					.on('show.bs.modal', function() {
						var modal_body = $(this).find('.modal-body');
						switch(self.options.modal_type) {
							case "iframe" :
								var height = modal_body.height() - parseInt(modal_body.css('padding-top'), 10) - parseInt(modal_body.css('padding-bottom'), 10);
								$(this).find('iframe').height(Math.max(height, 50));
								break;

							case "ajax":
								$.ajax({
									url: url, dataType: "html", async: false, success: function(data) {
										modal_body.html(data);
									}
								});
								break;

							case "template":
								self._loadTemplate("modal");
								//	also serve calendar instance to underscore template to be able to access current language strings
								modal_body.html(self.options.templates["modal"]({"event": event, "calendar": self}))
								break;
						}

						//	set the title of the bootstrap modal
						if(_.isFunction(self.options.modal_title)) {
							modal.find(".modal-title").html(self.options.modal_title(event));
						}
					})
					.on('shown.bs.modal', function() {
						self.options.onAfterModalShown.call(self, self.options.events);
					})
					.on('hidden.bs.modal', function() {
						self.options.onAfterModalHidden.call(self, self.options.events);
					})
					.data('handled.bootstrap-calendar', true).data('handled.event-id', event.id);
			}
			modal.modal('show');
		});
	};

	Calendar.prototype._update_day = function() {
		$('#cal-day-panel').height($('#cal-day-panel-hour').height());
	};

	Calendar.prototype._update_week = function() {
	};

	Calendar.prototype._update_year = function() {
		this._update_month_year();
	};

	Calendar.prototype._update_month = function() {
		this._update_month_year();

		var self = this;

		if(this.options.weekbox == true) {
			var week = $(document.createElement('div')).attr('id', 'cal-week-box');
			var start = this.options.position.start.getFullYear() + '-' + this.options.position.start.getMonthFormatted() + '-';
			self.context.find('.cal-month-box .cal-row-fluid')
				.on('mouseenter', function() {
					var p = new Date(self.options.position.start);
					var child = $('.cal-cell1:first-child .cal-month-day', this);
					var day = (child.hasClass('cal-month-first-row') ? 1 : $('[data-cal-date]', child).text());
					p.setDate(parseInt(day));
					day = (day < 10 ? '0' + day : day);
					week.html(self.locale.week.format(self.options.display_week_numbers == true ? p.getWeek(getExtentedOption(self, 'week_numbers_iso_8601')) : ''));
					week.attr('data-cal-week', start + day).show().appendTo(child);
				})
				.on('mouseleave', function() {
					week.hide();
				});

			week.click(function() {
				self.options.day = $(this).data('cal-week');
				self.view('week');
			});
		}


		self.context.find('a.event').mouseenter(function() {
			$('a[data-event-id="' + $(this).data('event-id') + '"]').closest('.cal-cell1').addClass('day-highlight dh-' + $(this).data('event-class'));
		});
		self.context.find('a.event').mouseleave(function() {
			$('div.cal-cell1').removeClass('day-highlight dh-' + $(this).data('event-class'));
		});
	};

	Calendar.prototype._update_month_year = function() {
		if(!this.options.views[this.options.view].slide_events) {
			return;
		}
		var self = this;
		var activecell = 0;
		var downbox = $(document.createElement('div')).attr('id', 'cal-day-tick').html('<i class="icon-chevron-down glyphicon glyphicon-chevron-down"></i>');

		self.context.find('.cal-month-day, .cal-year-box .span3')
			.on('mouseenter', function() {
				if($('.events-list', this).length == 0) {
					return;
				}
				if($(this).children('[data-cal-date]').text() == self.activecell) {
					return;
				}
				downbox.show().appendTo(this);
			})
			.on('mouseleave', function() {
				downbox.hide();
			})
			.on('click', function(event) {
				if($('.events-list', this).length == 0) {
					return;
				}
				if($(this).children('[data-cal-date]').text() == self.activecell) {
					return;
				}
				showEventsList(event, downbox, slider, self);
			})
		;

		var slider = $(document.createElement('div')).attr('id', 'cal-slide-box');
		slider.hide().click(function(event) {
			event.stopPropagation();
		});

		this._loadTemplate('events-list');

		downbox.click(function(event) {
			showEventsList(event, $(this), slider, self);
		});
	};

	Calendar.prototype.getEventsBetween = function(start, end) {
		var events = [];
		$.each(this.options.events, function() {
			if(this.start == null) {
				return true;
			}
			var event_end = this.end || this.start;
			if((parseInt(this.start) < end) && (parseInt(event_end) >= start)) {
				events.push(this);
			}
		});
		return events;
	};

	function showEventsList(event, that, slider, self) {

		event.stopPropagation();

		var that = $(that);
		var cell = that.closest('.cal-cell');
		var row = cell.closest('.cal-before-eventlist');
		var tick_position = cell.data('cal-row');

		that.fadeOut('fast');

		slider.slideUp('fast', function() {
			var event_list = $('.events-list', cell);
			slider.html(self.options.templates['events-list']({
				cal: self,
				events: self.getEventsBetween(parseInt(event_list.data('cal-start')), parseInt(event_list.data('cal-end')))
			}));
			row.after(slider);
			self.activecell = $('[data-cal-date]', cell).text();
			$('#cal-slide-tick').addClass('tick' + tick_position).show();
			slider.slideDown('fast', function() {
				$('body').one('click', function() {
					slider.slideUp('fast');
					self.activecell = 0;
				});
			});
		});

		// Wait 400ms before updating the modal & attach the mouseenter&mouseleave(400ms is the time for the slider to fade out and slide up)
		setTimeout(function() {
			$('a.event-item').mouseenter(function() {
				$('a[data-event-id="' + $(this).data('event-id') + '"]').closest('.cal-cell1').addClass('day-highlight dh-' + $(this).data('event-class'));
			});
			$('a.event-item').mouseleave(function() {
				$('div.cal-cell1').removeClass('day-highlight dh-' + $(this).data('event-class'));
			});
			self._update_modal();
		}, 400);
	}

	function getEasterDate(year, offsetDays) {
		var a = year % 19;
		var b = Math.floor(year / 100);
		var c = year % 100;
		var d = Math.floor(b / 4);
		var e = b % 4;
		var f = Math.floor((b + 8) / 25);
		var g = Math.floor((b - f + 1) / 3);
		var h = (19 * a + b - d - g + 15) % 30;
		var i = Math.floor(c / 4);
		var k = c % 4;
		var l = (32 + 2 * e + 2 * i - h - k) % 7;
		var m = Math.floor((a + 11 * h + 22 * l) / 451);
		var n0 = (h + l + 7 * m + 114)
		var n = Math.floor(n0 / 31) - 1;
		var p = n0 % 31 + 1;
		return new Date(year, n, p + (offsetDays ? offsetDays : 0), 0, 0, 0);
	}

	$.fn.calendar = function(params) {
		return new Calendar(params, this);
	}
}(jQuery));

(function($) {

	"use strict";

	var options = {
		events_source: 'events.json.php',
		view: 'month',
		tmpl_path: 'tmpls/',
		tmpl_cache: false,
		day: '2013-03-12',
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);

	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#format-12-hours').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({format12: val});
		calendar.view();
	});
	$('#show_wbn').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({display_week_numbers: val});
		calendar.view();
	});
	$('#show_wb').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({weekbox: val});
		calendar.view();
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
}(jQuery));