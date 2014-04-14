RoutineManagerEmber.AthleteRoute = Ember.Route.extend({
  model: function(params) {
    return this.get('store').find('athlete', params.athlete_id);
  }
});

