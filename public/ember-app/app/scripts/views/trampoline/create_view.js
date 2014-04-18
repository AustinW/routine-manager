App.TrampolineCreateView = Ember.View.extend({

    didInsertElement: function() {
        this.$('#trampoline-create-modal').modal('show');

        this.$('#trampoline-create-modal').on('hidden.bs.modal', $.proxy(this._viewDidHide, this));
    },

    _viewDidHide: function() {
        this.get('controller').transitionToRoute('/');
    },

    actions: {
        save: function() {
            console.log(this.controller);
            this.controller.send('save');

            this.$('.close').click();
        },

        cancel: function() {
            // this.controller.send('cancel');

            this.$('.close').click();
        }
    }
});