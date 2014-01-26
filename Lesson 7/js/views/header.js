window.HeaderView = Backbone.View.extend({

	initialize: function() {
		this.template = _.template( $("#header-template").html() );
	},

	render: function() {
		console.log("A");
		$(this.$el).html(this.template());
		return this.el;
	},

	events : {
		"click new" : "newWine"
	},

	newWine: function() {
		app.navigate("Wines/new", true);

		return false;
	}
});