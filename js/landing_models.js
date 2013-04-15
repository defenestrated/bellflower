// JavaScript Document
SubscribeView = Backbone.View.extend({
	initialize: function(){
		this.render();
	},
	render: function(){
		var template = _.template( $("#subscribe_template").html(), {} );
		$(this.el).hide();
		$(this.el).html( template );
	},
	events: {
		"keypress input[type=text]": "keyPressed"
	},
	keyPressed: function(e, event) {
		//if key pressed is enter (keyCode == 13)
		if (e.keyCode == 13) {
			//alert(event.currentTarget);
			this.validateInput();
		}
	},
	submitInput: function(){
		console.log("submitting Input");
		pjs = Processing.getInstanceById('dText');
		pjs.startDissolving();
		$(this.el).hide();
		console.log(this.unsubscribe);
		$.post("php/subscribe.php", {name: $("#name_input").val(), email: $("#email_input").val()}, function(data) {
			console.log(data);
		});
	},
	validateInput: function() {
		var nameId = "#name_input";
		var emailId = "#email_input";
		var name = $(nameId).val();
		var email = $(emailId).val();
		
		var hasError = false;
		var errorInputs = new Array();
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(email == '' || !emailReg.test(email)) {
			hasError = true;
			errorInputs.push(emailId);
		} 
		if(name == '') {
			hasError = true;
			errorInputs.push(nameId);
		}
		if (hasError) {
			this.showErrors(errorInputs);
		} else {
			this.submitInput();
		} 
	},
	showErrors: function(errorInputs) {
		for (var i = 0; i < errorInputs.length; i++) {
			$(errorInputs[i]).css({backgroundColor: '#FF0000'});
			$(errorInputs[i]).animate({backgroundColor: ''}, 750);
		}
	},
	setLocation: function(x, y) {
		$(this.el).show();
		y += $(this.el).height()/2;
		x -= $(this.el).width()/2;
		$(this.el).css({left: x, top: y});
	}
});


//=================================


UnsubscribeView = Backbone.View.extend({
	initialize: function(){
		this.render();
	},
	render: function(){
		var template = _.template( $("#unsubscribe_template").html(), {} );
		$(this.el).hide();
		$(this.el).html( template );
	},
	events: {
		"keypress input[type=text]": "keyPressed"
	},
	keyPressed: function(e, event) {
		//if key pressed is enter (keyCode == 13)
		if (e.keyCode == 13) {
			//alert(event.currentTarget);
			this.validateInput();
		}
	},
	submitInput: function(){
		console.log("submitting Input");
		pjs = Processing.getInstanceById('dText');
		pjs.startDissolving();
		$(this.el).hide();
		$.post("php/unsubscribe.php", {email: $("#email_input").val()}, function(data) {
			console.log(data);
		});
	},
	validateInput: function() {
		var emailId = "#email_input";
		var email = $(emailId).val();
		
		var hasError = false;
		var errorInputs = new Array();
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(email == '' || !emailReg.test(email)) {
			hasError = true;
			errorInputs.push(emailId);
		} 
		if (hasError) {
			this.showErrors(errorInputs);
		} else {
			this.submitInput();
		} 
	},
	showErrors: function(errorInputs) {
		for (var i = 0; i < errorInputs.length; i++) {
			$(errorInputs[i]).css({backgroundColor: '#FF0000'});
			$(errorInputs[i]).animate({backgroundColor: ''}, 750);
		}
	},
	setLocation: function(x, y) {
		$(this.el).show();
		y += $(this.el).height()/2;
		x -= $(this.el).width()/2;
		$(this.el).css({left: x, top: y});
	}
});