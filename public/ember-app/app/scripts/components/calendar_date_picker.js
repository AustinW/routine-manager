RoutineManagerEmber.CalendarDatePickerComponent = Ember.Component.extend({
    tagName: 'div',

    classNames: ['input-group'],

    didInsertElement: function() {

        this.$('input').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        }).on('changeDate', (function(_this) {
            return function() {
                return _this.$().trigger('change');
            };
        })(this)).children('input');

        this.$('input').datepicker('setDate', this.value);

    }
});