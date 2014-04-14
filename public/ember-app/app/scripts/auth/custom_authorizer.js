// the custom authorizer that authorizes requests against the custom server
RoutineManagerEmber.CustomAuthorizer = Ember.SimpleAuth.Authorizers.Base.extend({
    authorize: function(jqXHR, requestOptions) {
        console.log("CustomAuthorizer.authorize...");

        if (this.get('session.isAuthenticated') && !Ember.isEmpty(this.get('session.token'))) {
            console.log("Token: ", this.get('session.token'));
            jqXHR.setRequestHeader('Authorization', 'Token: ' + this.get('session.token'));
        }
    }
});