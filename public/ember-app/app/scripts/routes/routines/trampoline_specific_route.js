App.RoutinesTrampolineSpecificRoute = Ember.Route.extend({
    model: function(params) {
        return this.get('store').find('trampolineRoutine', params.routine_id);
    }
});