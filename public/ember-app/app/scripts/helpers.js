Ember.Handlebars.registerBoundHelper('format-date', function(suppliedDate, suppliedFormat) {
  return moment(suppliedDate).format(suppliedFormat);
});