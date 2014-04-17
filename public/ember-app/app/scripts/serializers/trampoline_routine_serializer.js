// App.TrampolineRoutineSerializer = DS.RESTSerializer.extend({
//     serializePolymorphicType: function(record, json, relationship) {
//         console.log("ASSDFDS");
//         var key = relationship.key,
//             belongsTo = get(record, key);
//         key = this.keyForAttribute ? this.keyForAttribute(key) : key;
//         json[key + "_type"] = belongsTo.constructor.typeKey;
//     }
// });