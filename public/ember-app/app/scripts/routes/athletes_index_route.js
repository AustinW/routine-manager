App.AthletesIndexRoute = Ember.Route.extend({
    model: function() {
        return this.get('store').find('athlete');
    }
});