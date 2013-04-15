// JavaScript Document
ContentView = Backbone.View.extend({
	defaults: {
		isUnsubscribe: false
	},
	
	initialize: function(){
		this.options = _.extend(this.defaults, this.options);
		this.render();
	},
	render: function(){
		var template;
		console.log(this.options.isUnsubscribe);
		if (this.options.isUnsubscribe) {
			template = _.template( $("#unsubscribe_content").html(), {} );
		} else {
			template = _.template( $("#subscribe_content").html(), {} );			
		}
		$(this.el).html( template );
	}
});
	
FormView = Backbone.View.extend({
	defaults: {
		isUnsubscribe: false
	},
	
	initialize: function(){
		this.options = _.extend(this.defaults, this.options);
		this.render();
	},
	render: function(){
		var template;
		console.log(this.options.isUnsubscribe);
		if (this.options.isUnsubscribe) {
			template = _.template( $("#unsubscribe_template").html(), {} );
		} else {
			template = _.template( $("#subscribe_template").html(), {} );			
		}
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
		if (this.options.isUnsubscribe) {
			console.log("submitting data to php/unsubscribe.php");
			$.post("php/unsubscribe.php", {email: $("#email_input").val()}, function(data) {
				//submission success callback. display confirmation, etc.
				console.log(data);
				$("#form_container input").hide();
				$("#form_container").append('You\'ve been successfully unsubscribed.');	
			});		
		} else {
			console.log("submitting data to php/subscribe.php");
			$.post("php/subscribe.php", {name: $("#name_input").val(), email: $("#email_input").val()}, function(data) {
				//submission success callback. display confirmation, etc.
				//data[exists] == false if email did not already exist in system (and was therefore added), some integer if did exist
				console.log(data);
				$("#form_container input").hide();	
				$("#form_container").append('Thanks for signing up! You will receive a confirmation email shortly.');
			});
		}
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
	}
});