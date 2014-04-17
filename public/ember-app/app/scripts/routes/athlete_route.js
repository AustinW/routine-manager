RoutineManagerEmber.AthleteRoute = Ember.Route.extend({
    model: function(params) {
        var athlete = this.get('store').find('athlete', params.athlete_id);
        console.log(athlete.get('tra_prelim_compulsory'));
        return athlete;
    }
});