App.ApplicationRoute = Ember.Route.extend(Ember.SimpleAuth.ApplicationRouteMixin, {
    actions: {
        showCreateTrampolineRoutine: function() {
            this.transitionTo('routines.trampoline.create');
        },

        showCreateSynchroRoutine: function() {
            this.transitionTo('routines.synchro.create');
        },

        showCreateDoubleMiniRoutine: function() {
            this.transitionTo('routines.doublemini.create');
        },

        showCreateTumblingRoutine: function() {
            this.transitionTo('routines.tumbling.create');
        },

        showTrampolineRoutines: function() {
            this.transitionTo('routines.trampoline');
        },

        showSynchroRoutines: function() {
            this.transitionTo('routines.synchro');
        },

        showDoubleMiniRoutines: function() {
            this.transitionTo('routines.doublemini');
        },

        showTumblingRoutines: function() {
            this.transitionTo('routines.tumbling');
        }
    }

});