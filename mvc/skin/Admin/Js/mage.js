var Base = function () {
	
}

Base.prototype = {
	
	alert : function(){
		alert(111);
	},

	url : null,
	param : {},
	method : 'post',

	setUrl : function (url) {
		this.url = url;
		return this;
	},

	getUrl : function () {
		return this.url;
	},

	setMethod : function(method){
		this.method = method;
		return this;
	},

	getMethod : function () {
		return this.method;
	},

	setParams : function (params) {
		this.params = params;
		return this;
	},

	getParams : function(key) {
		if (typeof key == 'undefined') {
			return this.params;
		}

		if (typeof this.params[key] == 'undefined') {
			return null;
		}
		return this.params[key];
	},

	addParam : function (key,value) {
		this.params[key] = value;
		return this;
	},

	removeParams : function (key) {
		if (typeof this.params[key] != 'undefined') {
			delete this.params[key];
		}
	return this;
	},

	resetParam : function(){
		this.params = {};
		return this;
	},

	load : function () {
		 $.ajax({
			method : this.getMethod(),
			url : this.getUrl(),
			data : this.getParams(),
			success : function(response){
				$.each(response.element,function(i,element){
					$(element.selector).html(element.html);
				}) 
				
			}
		}); 
	},

	setForm : function(form) {
		this.setMethod($(form).attr('method'));
		this.setUrl($(form).attr('action'));
		this.setParams($(form).serializeArray());
		return this;
	},

	upload : function () {
		 $.ajax({
			method : this.getMethod(),
			url : this.getUrl(),
			data : this.getParams(),
			processData : false,
			contentType : false,
			success : function(response){
				$.each(response.element,function(i,element){
					$(element.selector).html(element.html);
				}) 
				
			}
		}); 
	}
};


var object = new Base();
object.setParams({
name : 'cybercom'
});
console.log(object);