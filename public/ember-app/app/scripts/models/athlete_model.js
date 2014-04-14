/*global Ember*/
RoutineManagerEmber.Athlete = DS.Model.extend({
    user_id: DS.attr('number'),
    synchro_partner_id: DS.attr('number'),
    first_name: DS.attr('string'),
    last_name: DS.attr('string'),
    gender: DS.attr('string'),
    birthday: DS.attr('string'),
    team: DS.attr('string'),
    trampoline_level: DS.attr('string'),
    doublemini_level: DS.attr('string'),
    tumbling_level: DS.attr('string'),
    synchro_level: DS.attr('string'),
    notes: DS.attr('string'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date'),

    fullName: function() {
        return this.get('first_name') + ' ' + this.get('last_name');
    }.property('first_name', 'last_name'),

    genderClass: function() {
        return 'fa-' + this.get('gender');
    }.property('gender'),

    trampolineLevelLabel: function() {
        return this.searchLevelLabel(this.get('trampoline_level'));
    }.property('trampoline_level'),

    synchroLevelLabel: function() {
        return this.searchLevelLabel(this.get('synchro_level'));
    }.property('synchro_level'),

    doubleminiLevelLabel: function() {
        return this.searchLevelLabel(this.get('doublemini_level'));
    }.property('doublemini_level'),

    tumblingLevelLabel: function() {
        return this.searchLevelLabel(this.get('tumbling_level'));
    }.property('tumbling_level'),

    searchLevelLabel: function(level) {
        var levels = this.get('allLevels');

        for (var i = 0, s = levels.length; i < s; ++i) {
            if (levels[i].key === level) {
                return levels[i].value;
            }
        }

        return "";
    },

    allLevels: [{
        key: '0',
        value: 'None'
    }, {
        key: '1',
        value: '1'
    }, {
        key: '2',
        value: '2'
    }, {
        key: '3',
        value: '3'
    }, {
        key: '4',
        value: '4'
    }, {
        key: '5',
        value: '5'
    }, {
        key: '6',
        value: '6'
    }, {
        key: '7',
        value: '7'
    }, {
        key: '8',
        value: '8'
    }, {
        key: '9',
        value: '9'
    }, {
        key: '10',
        value: '10'
    }, {
        key: 'ye',
        value: 'Youth Elite'
    }, {
        key: 'jr',
        value: 'Junior Elite'
    }, {
        key: 'oe',
        value: 'Open Elite'
    }, {
        key: 'sr',
        value: 'Senior Elite'
    }]
});



// probably should be mixed-in...
RoutineManagerEmber.Athlete.reopen({
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

RoutineManagerEmber.Athlete.FIXTURES = [{
    "id": "1",
    "user_id": "1",
    "synchro_partner_id": "2",
    "first_name": "Austin",
    "last_name": "White",
    "gender": "male",
    "birthday": "1988-05-20",
    "team": "World Elite",
    "trampoline_level": "sr",
    "doublemini_level": "sr",
    "tumbling_level": "10",
    "synchro_level": "10",
    "notes": "",
    "created_at": "2014-02-05 03:19:20",
    "updated_at": "2014-02-13 19:08:34"
}, {
    "id": "2",
    "user_id": "1",
    "synchro_partner_id": "1",
    "first_name": "Logan",
    "last_name": "Dooley",
    "gender": "male",
    "birthday": "1987-09-26",
    "team": "World Elite",
    "trampoline_level": "sr",
    "doublemini_level": null,
    "tumbling_level": null,
    "synchro_level": "10",
    "notes": "",
    "created_at": "2014-02-05 19:40:57",
    "updated_at": "2014-02-13 19:08:34"
}];