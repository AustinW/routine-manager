RoutineManager.Athlete = DS.Model.extend({
    id:                  DS.attr('string'),
    birthday:            DS.attr('date'),
    created_at:          DS.attr('date'),
    doublemini_level:    DS.attr('string'),
    first_name:          DS.attr('string'),
    last_name:           DS.attr('string'),
    gender:              DS.attr('string'),
    team:                DS.attr('string'),
    notes:               DS.attr('string'),
    tra_prelim_optional: DS.attr('string'),
    trampoline_level:    DS.attr('string'),
    updated_at:          DS.attr('date'),
    usag_id:             DS.attr('number'),
    user_id:             DS.attr('string')
});

RoutineManager.Athlete.FIXTURES = [{
    "id":                  "525b46c94c84a35459000000",
    "birthday":            "1988-05-20",
    "created_at":          "2013-06-10 15:37:17",
    "doublemini_level":    "sr",
    "first_name":          "Austin",
    "gender":              "male",
    "last_name":           "White",
    "team":                "World Elite",
    "notes":               "",
    "tra_prelim_optional": "526596a84c84a3f505000000",
    "trampoline_level":    "sr",
    "updated_at":          "2013-10-21 21:07:55",
    "usag_id":             "071720",
    "user_id":             "525102034c84a38302000000"
}];