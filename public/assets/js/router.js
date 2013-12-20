RoutineManager.Router.map(function() {
    // put your routes here

    this.route('about', { path: '/about' });
    this.resource('athletes', function() {
        this.route('view', { path: '/:athlete_id' });
    });
});

RoutineManager.IndexRoute = Ember.Route.extend({
    model: function() {
        return ['red', 'yellow', 'blue'];
    }
});

RoutineManager.AthletesIndexRoute = Ember.Route.extend({
    model: function() {
        return this.modelFor('athletes');
    },

    renderTemplate: function(controller) {
        this.render('athletes/index', {controller: controller});
    }
});

RoutineManager.AthletesViewRoute = Ember.Route.extend({
    model: function() {
        return this.store.find('athlete');
    },

    renderTemplate: function(controller) {
        this.render('athletes/view', {controller: controller});
    }
});