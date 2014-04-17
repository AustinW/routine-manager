RoutineManagerEmber.Router.map(function() {

    // /athletes
    this.resource('athletes', function() {

        // /athletes/:athlete_id
        this.resource('athlete', {
            path: '/:athlete_id'
        }, function() {
            // /athletes/:athlete_id/edit
            this.route('edit');
        });
        this.route('create');
    });

    // /routines
    this.resource('routines', function() {

        // /routines/trampoline
        this.resource('trampoline', function() {

            // /routines/trampoline/create
            this.route('create');
        });

        this.resource('synchro');
        this.resource('doublemini');
        this.resource('tumbling');
    });

    this.route('login');

});