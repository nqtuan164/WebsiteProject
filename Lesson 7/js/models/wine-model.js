window.Wine = Backbone.Model.extend({
	defaults: {
		"id" : null,
		"name" : "",
		"grapes" : "",
		"country" : "Vietnam",
		"region" : "Ho Chi Minh City",
		"year" : "",
		"description" : "",
		"picture" : ""
	},

	urlRoot: "wines/"
});

window.WineCollection = Backbone.Collection.extend({
	model : Wine,
	url : "wines/"
});

