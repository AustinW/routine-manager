RoutineManagerEmber.ApplicationRoute = Ember.Route.extend(Ember.SimpleAuth.ApplicationRouteMixin, {
    actions: {
        showEditAthlete: function() {
            this.transitionTo('athlete.edit');
        }
    }

});