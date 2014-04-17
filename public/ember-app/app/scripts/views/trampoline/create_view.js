RoutineManagerEmber.TrampolineCreateView = Ember.View.extend({

    didInsertElement: function() {
        this.$('#trampoline-create-modal').modal('show');

        this.$('#trampoline-create-modal').on('hidden.bs.modal', $.proxy(this._viewDidHide, this));
    },

    _viewDidHide: function() {
        this.controller.send('cancel');
        this.get('controller').transitionToRoute('athlete', this.get('controller').get('model'));
    },

    actions: {
        save: function() {
            this.controller.send('save');

            this.$('.close').click();
        },

        cancel: function() {
            this.controller.send('cancel');

            this.$('.close').click();
        }
    }
});