App.RoutinesTrampolineIndexRoute = Ember.Route.extend({
    model: function() {
        return this.get('store').find('trampolineRoutine', {
            type: 'trampoline'
        });
    }
});