App.DoubleMiniPass = RL.Model.extend({
    user_id: RL.attr('number'),
    type: RL.attr('string'),
    name: RL.attr('string'),
    description: RL.attr('string'),
    locked: RL.attr('number'),
    deleted_at: RL.attr('date'),
    created_at: RL.attr('date'),
    updated_at: RL.attr('date'),

    athletes: RL.hasMany('Athlete'),
    skills: RL.hasMany('skill')
});

// probably should be mixed-in...
App.DoubleMiniPass.reopen({
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