//Go to next tab func

function goToNext(div) {
    $(div).parent().parent().parent().parent().removeClass("in");
    $(div).parent().parent().parent().parent().parent().next().find(".panel-collapse").addClass("in");
    $(div).parent().parent().parent().parent().parent().next().find(".panel-collapse").removeAttr("style");
}

//focus services

function focusServices() {
    $('html, body').animate({
        scrollTop: $("#pricing").offset().top
    }, 2000);
}

//Getting Started Section

	function goToSignUp(){
	    $('#login').modal();
	    $("#btnSigUp-modal")[0].onclick();
        $("#sign-up-driver, #sign-up-doctor, #sign-up-storefront").hide();
	}

jQuery(document).ready(function () {
	"use strict";
	

    //buy now button for payhment card

	$("#checkout-payment-creditcard").on("click", function () {
	    $("#paypalOrCreditCard").slideUp();
	    $(".addCreditCard").show();
	});

	
    //Add new card for payment

	$(document).on('click', '.select-icon', function () {
	    var selectId = $(this).siblings('.options');
	    open(selectId);
	});

	


	function open(elem) {
	    if (document.createEvent) {
	        var e = document.createEvent("MouseEvents");
	        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
	        elem[0].dispatchEvent(e);
	    } else if (element.fireEvent) {
	        elem[0].fireEvent("onmousedown");
	    }
	}

    /* next view button */
	$('.next').on('click', function () {

	    $('#flip-toggle').addClass('hover');
	    $(this).attr('disabled', true);
	    $('.prev').removeAttr('disabled');

	});


    /* prev view button */
	$('.prev').on('click', function () {

	    $('#flip-toggle').removeClass('hover');
	    $(this).attr('disabled', true);
	    $('.next').removeAttr('disabled');

	});




    //payment method steps

	$("#checkout-payment-buy-PayPal").on("click", function () {
	    $(".payPal-paySection").slideUp();
	    $("#paypalOrCreditCard").show();
	});



    //adminn access to portfolio
	if ($("#admin-access input").val() == "") {
	    $(".portfolio-adminAccess > div").hide();
	}
	$("#btn-enter-admin").on("click", function () {
	    if ($("#admin-access input").val() != "") {
	        $(".portfolio-adminAccess > div").show();
	    } else {
	        alert("Please Enter User Name and Password");
	    }
	});

    //Upload
	!function (e) { var t = function (t, n) { this.$element = e(t), this.type = this.$element.data("uploadtype") || (this.$element.find(".thumbnail").length > 0 ? "image" : "file"), this.$input = this.$element.find(":file"); if (this.$input.length === 0) return; this.name = this.$input.attr("name") || n.name, this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]'), this.$hidden.length === 0 && (this.$hidden = e('<input type="hidden" />'), this.$element.prepend(this.$hidden)), this.$preview = this.$element.find(".fileupload-preview"); var r = this.$preview.css("height"); this.$preview.css("display") != "inline" && r != "0px" && r != "none" && this.$preview.css("line-height", r), this.original = { exists: this.$element.hasClass("fileupload-exists"), preview: this.$preview.html(), hiddenVal: this.$hidden.val() }, this.$remove = this.$element.find('[data-dismiss="fileupload"]'), this.$element.find('[data-trigger="fileupload"]').on("click.fileupload", e.proxy(this.trigger, this)), this.listen() }; t.prototype = { listen: function () { this.$input.on("change.fileupload", e.proxy(this.change, this)), e(this.$input[0].form).on("reset.fileupload", e.proxy(this.reset, this)), this.$remove && this.$remove.on("click.fileupload", e.proxy(this.clear, this)) }, change: function (e, t) { if (t === "clear") return; var n = e.target.files !== undefined ? e.target.files[0] : e.target.value ? { name: e.target.value.replace(/^.+\\/, "") } : null; if (!n) { this.clear(); return } this.$hidden.val(""), this.$hidden.attr("name", ""), this.$input.attr("name", this.name); if (this.type === "image" && this.$preview.length > 0 && (typeof n.type != "undefined" ? n.type.match("image.*") : n.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader != "undefined") { var r = new FileReader, i = this.$preview, s = this.$element; r.onload = function (e) { i.html('<img src="' + e.target.result + '" ' + (i.css("max-height") != "none" ? 'style="max-height: ' + i.css("max-height") + ';"' : "") + " />"), s.addClass("fileupload-exists").removeClass("fileupload-new") }, r.readAsDataURL(n) } else this.$preview.text(n.name), this.$element.addClass("fileupload-exists").removeClass("fileupload-new") }, clear: function (e) { this.$hidden.val(""), this.$hidden.attr("name", this.name), this.$input.attr("name", ""); if (navigator.userAgent.match(/msie/i)) { var t = this.$input.clone(!0); this.$input.after(t), this.$input.remove(), this.$input = t } else this.$input.val(""); this.$preview.html(""), this.$element.addClass("fileupload-new").removeClass("fileupload-exists"), e && (this.$input.trigger("change", ["clear"]), e.preventDefault()) }, reset: function (e) { this.clear(), this.$hidden.val(this.original.hiddenVal), this.$preview.html(this.original.preview), this.original.exists ? this.$element.addClass("fileupload-exists").removeClass("fileupload-new") : this.$element.addClass("fileupload-new").removeClass("fileupload-exists") }, trigger: function (e) { this.$input.trigger("click"), e.preventDefault() } }, e.fn.fileupload = function (n) { return this.each(function () { var r = e(this), i = r.data("fileupload"); i || r.data("fileupload", i = new t(this, n)), typeof n == "string" && i[n]() }) }, e.fn.fileupload.Constructor = t, e(document).on("click.fileupload.data-api", '[data-provides="fileupload"]', function (t) { var n = e(this); if (n.data("fileupload")) return; n.fileupload(n.data()); var r = e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]'); r.length > 0 && (r.trigger("click.fileupload"), t.preventDefault()) }) }(window.jQuery)

    //Getting started popover
	$('.services-description').popover({ trigger: "hover" });


    //Read more Reaad less
    // Configure/customize these variables.
	var showChar = 400;  // How many characters are shown by default
	var ellipsestext = "...";
	var moretext = "Read more";
	var lesstext = "Read less";


	$('.read-more').each(function () {
	    var content = $(this).html();

	    if (content.length > showChar) {

	        var c = content.substr(0, showChar);
	        var h = content.substr(showChar, content.length - showChar);

	        var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

	        $(this).html(html);
	    }

	});

	$(".morelink").click(function () {
	    if ($(this).hasClass("less")) {
	        $(this).removeClass("less");
	        $(this).html(moretext);
	    } else {
	        $(this).addClass("less");
	        $(this).html(lesstext);
	    }
	    $(this).parent().prev().toggle();
	    $(this).prev().toggle();
	    return false;
	});


/* Navigation */	
jQuery('.main-nav a:not(.dropdown-toggle)').bind('click', function(event) {
		var $anchor = $(this);
		var data=$($anchor.attr('href'));
		if(data.length){
		jQuery('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500, 'easeInOutExpo');
		event.preventDefault();
	}
	});

/* Count */	
jQuery('.st-ff-count').appear();
	jQuery(document.body).on('appear', '.st-ff-count', function(e, $affected) {
		$affected.each(function(i) {
			if (parseInt($(this).data('runit'))) {
				$(this).countTo({
					speed: 3000,
					refreshInterval: 50
				});
				$(this).data('runit', "0");
			};

		});
	});

    //Getting Started Section
	$("#send-get-started").on('click', function () {
	    $(".getting-started-wrapper").show(1000);
	    
	});

    //Terms and Conditions

	$("#agreeForTerms").on("click", function () {
	    if ($(".checkbox-wrapper label input").is(':checked')) {
	        $('#termsAndConditions').modal('toggle');
	        $(".checkbox-wrapper label").removeClass("termsError");
	        $(".get-start-subCategories").show(500);
	        $(".user-button").hide();
	    } else {
	        $(".checkbox-wrapper label").addClass("termsError");
	        
	    }
	});
        
    //Services dropdown menu
	$('.dropdown').hover(function () {
	    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function () {
	    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});


/* tooltip */	
jQuery('[data-toggle="tooltip"]').tooltip();


/* Testimonials */
jQuery(".testimonials-carousel ul").owlCarousel({
        items: 1,
        navigation: false,
        pagination: true,
        singleItem:true,
        autoPlay: true,
        navigationText: ['<i class="ct-etp etp-arrow-left7"></i>', '<i class="ct-etp etp-arrow-right8"></i>'],
        transitionStyle: "backSlide"
    });

/* Clients */
jQuery('.clients-carousel').owlCarousel({
    	items: 5,
    	autoPlay: true,
    	pagination: false
    });
	
/* Subscribe */	
jQuery(".subscribe-form").ajaxChimp({
        callback: mcCallback,
        //url: "http://cantothemes.us8.list-manage2.com/subscribe/post?u=37a0cb83e98c8633253ad0acd&id=03d8ef0996" // Replace your mailchimp post url inside double quote "".  
        url: "" // Replace your mailchimp post url inside double quote "".  
    });	
 
    function mcCallback (res) {
		if(res.result === 'success') {
			$('.subscribe-result').html('<i class="pe-7s-check"></i>' + res.msg).delay(500).slideDown(1000).delay(10000).slideUp(1000);
		}else if(res.result === 'error'){
			$('.subscribe-result').html('<i class="pe-7s-close-circle"></i>' + res.msg).delay(500).slideDown(1000).delay(10000).slideUp(1000);
		}
	}
	
   function checkEmpty(selector) {
        if (selector.val()=="" || selector.val()==selector.prop("placeholder")) {
          selector.addClass('formFieldError',500);
          return false;
        } else {
          selector.removeClass('formFieldError',500); 
          return true;
        }
    }
    function validateEmail(email) {
        var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
        if (!regex.test(email.val())) {
          email.addClass('formFieldError',500); 
          return false;
        } else {
          email.removeClass('formFieldError',500); 
          return true;
        }
    }

/* Contact Form */	
jQuery('.contact-form').submit(function () {
      var $this = $(this),
          result = true;

      if(!checkEmpty($this.find('#fname'))){
        result=false;
      }
      if(!validateEmail($this.find('#email'))) {
        result=false;
      }
      if(!checkEmpty($this.find('#mssg'))) {
        result=false;
      }
      
      if(result==false) {
        return false;
      }

      var $btn = $("#send").button('loading');

      var data = $this.serialize();

      $.ajax({
          url: "sender.php", 
          type: "POST",        
          data: data,     
          cache: false,
          success: function (html) {
          	console.log(html);
              if (html==1) {
                  $('#result-message').addClass('alert alert-success').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> Message Send. We will contact with you soon.').delay(500).slideDown(500).delay(10000).slideUp('slow');

                  $btn.button('reset');
                  
              } else {
                  $('#result-message').addClass('alert alert-danger').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Message Sending Error! Please try again').delay(500).slideDown(500).delay(10000).slideUp('slow');
                  $btn.button('reset');
              }
          },
          error: function (a, b) {
            if (b == 'error') {
              $('#result-message').addClass('alert alert-danger').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Message Sending Error! Please try again').delay(500).slideDown(500).delay(10000).slideUp('slow');
            };
            $btn.button('reset');
          }
      });

      return false;
    });


});

/* Portfolio */	
//jQuery(window).load(function () {
jQuery(window).on('load', function() { 
	var $grid = $('.grid'),
		$sizer = $grid.find('.shuffle__sizer'),
		$filterType = $('#filter input[name="filter"]');

	$grid.shuffle({
		itemSelector: '.portfolio-item',
		sizer: $sizer
	});

	$filterType.change(function(e) {
		var group = $('#filter input[name="filter"]:checked').val();

		$grid.shuffle('shuffle', group);

		$('label.btn-main').removeClass('btn-main');
		$('input[name="filter"]:checked').parent().addClass('btn-main');
	});
	
	
   function home_height () {
		var element = $('.st-home-unit'),
			elemHeight = element.height(),
			winHeight = $(window).height()
			padding = (winHeight - elemHeight - 200) /2;

		if (padding < 1 ) {
			padding = 0;
		};
		element.css('padding', padding+'px 0');
	}
	home_height ();

jQuery(window).resize(function () {
		home_height ();
	});


	var fadeStart=$(window).height()/3 // 100px scroll or less will equiv to 1 opacity
    ,fadeUntil=$(window).height() // 200px scroll or more will equiv to 0 opacity
    ,fading = $('.st-home-unit')
    ,fading2 = $('.hero-overlayer')
	;
	
/* Nav Scroll */	
jQuery(window).bind('scroll', function(){
	    var offset = $(document).scrollTop()
	        ,opacity=0
	        ,opacity2=1
	    ;
	    if( offset<=fadeStart ){
	        opacity=1;
	        opacity2=0;
	    }else if( offset<=fadeUntil ){
	        opacity=1-offset/fadeUntil;
	        opacity2=offset/fadeUntil;
	    }
	    fading.css({'opacity': opacity});

	    //if (offset >= 120) {
	    //	$('.st-navbar').addClass("st-navbar-mini");
	    //} else if (offset <= 119) {
	    //	$('.st-navbar').removeClass("st-navbar-mini");
	    //}
});

});	
