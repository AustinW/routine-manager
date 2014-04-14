RoutineManagerEmber.CustomAuthenticator = Ember.SimpleAuth.Authenticators.OAuth2.extend({
    tokenEndpoint: 'api/auth',

    authenticate: function(credentials) {

        console.log("ASDasdfdsfasaewhrtyyjuj6565rF");

        var self = this;

        return new Ember.RSVP.Promise(function(resolve, reject) {
            // make the request to authenticate the user at endoint /v3/token
            Ember.$.ajax({
                url: self.tokenEndpoint,
                type: 'POST',
                data: {
                    username: credentials.identification,
                    password: credentials.password
                }
            }).then(function(response) {
                Ember.run(function() {
                    console.log("response: ", response);
                    // resolve (including the account id) as the AJAX request was successful; all properties this promise resolves
                    // with will be available through the session
                    resolve({
                        access_token: response.token,
                        user_id: response.user.id,
                        email: response.user.email,
                        name: response.user.first_name + ' ' + response.user.last_name
                    });
                });
            }, function(xhr, status, error) {
                console.log(xhr.responseJSON);
                Ember.run(function() {
                    reject(xhr.responseJSON);
                });
            });
        });
    }
});