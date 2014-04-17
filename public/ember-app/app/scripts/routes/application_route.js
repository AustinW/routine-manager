RoutineManagerEmber.ApplicationRoute = Ember.Route.extend(Ember.SimpleAuth.ApplicationRouteMixin, {
    actions: {
        showEditAthlete: function() {
            this.transitionTo('athlete.edit');
        },

        showCreateTrampolineRoutine: function() {
            this.transitionTo('trampoline.create');
        },

        showCreateSynchroRoutine: function() {
            this.transitionTo('synchro.create');
        },

        showCreateDoubleMiniRoutine: function() {
            this.transitionTo('doublemini.create');
        },

        showCreateTumblingRoutine: function() {
            this.transitionTo('tumbling.create');
        }
    }

});