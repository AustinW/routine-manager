RoutineManagerEmber.Router.map(function() {
    this.resource('athletes', function() {
        this.resource('athlete', {
            path: '/:athlete_id'
        }, function() {
            this.route('edit');
        });
        this.route('create');
    });

    this.route('login');

});