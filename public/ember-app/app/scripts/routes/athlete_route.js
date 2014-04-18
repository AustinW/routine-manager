App.AthleteRoute = Ember.Route.extend({
    model: function(params) {
        return this.get('store').find('athlete', params.athlete_id);
    },

    actions: {
        showEditAthlete: function(athlete_id) {
            this.transitionTo('athlete.edit', athlete_id);
        }
    }
});