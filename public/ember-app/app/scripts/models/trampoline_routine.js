App.TrampolineRoutine = RL.Model.extend({
    user_id: RL.attr('number'),
    type: RL.attr('string', {
        defaultValue: 'trampoline'
    }),
    name: RL.attr('string'),
    skills: RL.attr('array'),
    description: RL.attr('string'),
    locked: RL.attr('number'),
    deleted_at: RL.attr('date'),
    created_at: RL.attr('date'),
    updated_at: RL.attr('date')
});

App.TrampolineRoutine.reopenClass({
    resourceName: 'routine'
});

// probably should be mixed-in...
App.TrampolineRoutine.reopen({
    attributes: function() {
        var model = this;
        return Ember.keys(this.get('data')).map(function(key) {
            return Em.Object.create({
                model: model,
                key: key,
                valueBinding: 'model.' + key
            });
        });
    }.property()
});