App.Router.map(function() {

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
        this.resource('routines.trampoline', {
            path: '/trampoline'
        }, function() {

            // /routines/trampoline/:routine_id
            this.resource('routines.trampoline.specific', {
                path: '/:routine_id'
            });

            // /routines/trampoline/create
            this.route('create');
        });

    });

    this.route('login');

});