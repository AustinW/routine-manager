Ember.Application.initializer({
    name: 'authentication',
    initialize: function(container, application) {
        container.register('authenticator:custom', RoutineManagerEmber.CustomAuthenticator);
        container.register('authorizer:custom', RoutineManagerEmber.CustomAuthorizer)

        Ember.SimpleAuth.setup(container, application, {
            authorizerFactory: 'authorizer:custom'
        });
    }
});

var RoutineManagerEmber = window.RoutineManagerEmber = Ember.Application.create({
    LOG_TRANSITIONS: true,
    LOG_BINDINGS: true
});

Ember.onerror = function(error) {
    console.log(error.stack);
};

/* Order and include as you please. */
require('scripts/auth/*');
require('scripts/adapters/*');
require('scripts/serializers/*');
require('scripts/controllers/*');
require('scripts/controllers/trampoline/*')
require('scripts/client');
require('scripts/models/*');
require('scripts/routes/*');
require('scripts/routes/routines/*');
require('scripts/views/*');
require('scripts/views/trampoline/*');
require('scripts/router');
require('scripts/helpers');
require('scripts/components/*');