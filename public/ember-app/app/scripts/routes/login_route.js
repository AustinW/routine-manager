RoutineManagerEmber.LoginRoute = Ember.Route.extend({
    // clear a potentially stale error message from previous login attempts
    setupController: function(controller, model) {
        controller.set('errorMessage', null);
    },
    actions: {
        // display an error when authentication fails
        sessionAuthenticationFailed: function(message) {
            console.log("ERROR: ", message);
            this.controller.set('errorMessage', "Invalid email/password. Please try again...");
        }
    }
});