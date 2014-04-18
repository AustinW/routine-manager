App.TrampolineCreateController = Ember.ObjectController.extend({
    actions: {
        save: function() {
            var model = this.get('model');

            var newModelData = {
                type: 'trampoline',
                name: model.get('name'),
                description: model.get('description'),
                skills: []
            };

            for (var i = 1; i <= 10; ++i) {
                newModelData.skills.push(model.get('skill' + i));
            }

            console.log('newModelData: ', newModelData);

            var routine = App.TrampolineRoutine.create(newModelData);
            routine.saveRecord();
        }
    }
});