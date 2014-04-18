App.TrampolineCreateRoute = Ember.Route.extend({
    model: function() {
        return Em.Object.create({});
    },

    actions: {
        willTransition: function(transition) {
            var dirty = this.get('controller.content.isDirty');

            if (dirty && !confirm('Are you sure you wish to discard your changes?')) {
                transition.abort();
            } else {
                return true;
            }
        }
    }
});