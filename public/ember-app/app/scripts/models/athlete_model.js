App.Athlete = RL.Model.extend({
    userId: RL.attr('number'),
    synchroPartnerId: RL.attr('number'),
    firstName: RL.attr('string'),
    lastName: RL.attr('string'),
    gender: RL.attr('string'),
    birthday: RL.attr('string'),
    team: RL.attr('string'),
    trampolineLevel: RL.attr('string'),
    doubleminiLevel: RL.attr('string'),
    tumblingLevel: RL.attr('string'),
    synchroLevel: RL.attr('string'),
    notes: RL.attr('string'),
    created_at: RL.attr('date'),
    updated_at: RL.attr('date'),

    traPrelimCompulsory: RL.belongsTo('trampolineRoutine'),
    traPrelimOptional: RL.belongsTo('trampolineRoutine'),
    traSemiFinalOptional: RL.belongsTo('trampolineRoutine'),
    traFinalOptional: RL.belongsTo('trampolineRoutine'),

    syncFinalOptional: RL.belongsTo('trampolineRoutine'),
    syncFinalOptional: RL.belongsTo('trampolineRoutine'),
    syncFinalOptional: RL.belongsTo('trampolineRoutine'),

    dmtPass1: RL.belongsTo('doubleMiniPass'),
    dmtPass2: RL.belongsTo('doubleMiniPass'),
    dmtPass3: RL.belongsTo('doubleMiniPass'),
    dmtPass4: RL.belongsTo('doubleMiniPass'),

    tumPass1: RL.belongsTo('tumblingPass'),
    tumPass2: RL.belongsTo('tumblingPass'),
    tumPass3: RL.belongsTo('tumblingPass'),
    tumPass4: RL.belongsTo('tumblingPass'),

    didLoad: function() {
        // console.log("Compulsory:", this.get('traPrelimCompulsory'));
        // console.log("Athlete: ");
        // console.log(Ember.keys(Ember.meta(App.Athlete.proto()).descs));

        // console.log('Athlete loaded...');
    },

    fullName: function() {
        return this.get('firstName') + ' ' + this.get('lastName');
    }.property('firstName', 'lastName'),

    genderClass: function() {
        return 'fa-' + this.get('gender');
    }.property('gender'),

    trampolineLevelLabel: function() {
        return this.searchLevelLabel(this.get('trampolineLevel'));
    }.property('trampolineLevel'),

    synchroLevelLabel: function() {
        return this.searchLevelLabel(this.get('synchroLevel'));
    }.property('synchroLevel'),

    doubleminiLevelLabel: function() {
        return this.searchLevelLabel(this.get('doubleminiLevel'));
    }.property('doubleminiLevel'),

    tumblingLevelLabel: function() {
        return this.searchLevelLabel(this.get('tumblingLevel'));
    }.property('tumblingLevel'),

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
App.Athlete.reopen({
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

App.Athlete.FIXTURES = [{
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