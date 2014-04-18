App.AthleteEditRoute = Ember.Route.extend({
    model: function() {
        return this.modelFor('athlete');
    }
});