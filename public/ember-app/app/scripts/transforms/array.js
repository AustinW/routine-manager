App.RESTAdapter.registerTransform('array', {
    deserialize: function(serialized) {
        console.log('deserialize: ', serialized);
    },
    serialize: function(deserialized) {
        return deserialized;
    }
});