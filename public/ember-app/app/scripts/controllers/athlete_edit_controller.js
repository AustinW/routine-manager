RoutineManagerEmber.AthleteEditController = Ember.ObjectController.extend({
    needs: 'athlete',

    genders: ['male', 'female'],

    gender_icon: function() {
        return 'fa fa-' + this.get('model.gender');
    }.property('model.gender'),

    actions: {
        save: function() {
            console.log("Controller handling save event");

            var athlete = this.get('model');
            athlete.save();

            // var self = this;

            // this.get('buffer').forEach(function(attr) {
            //     console.log("saving " + attr.key + " to: " + attr.value);
            //     self.get('controllers.athlete.model').set(attr.key, attr.value);
            // });

            // this.transitionToRoute('athlete', this.get('model'));
        },

        cancel: function() {
            this.get('model').rollback();
        }

    }
});