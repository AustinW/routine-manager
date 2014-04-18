Ember.Handlebars.registerBoundHelper('format-date', function(suppliedDate, suppliedFormat) {
    return moment(suppliedDate).format(suppliedFormat);
});

Ember.Handlebars.helper('math', function(operand1, operator, operand2) {

    var result;

    switch (operator) {
        case '+':
            result = operand1 + operand2;
            break;
        case '-':
            result = operand1 - operand2;
            break;
        case '*':
            result = operand1 * operand2;
            break;
        case '/':
            result = operand1 / operand2;
            break;
    }

    return result;
});