window.RoutineManager = Ember.Application.create({
	
	// Log url changes for dev purposes
	LOG_TRANSITIONS: true,

	LOG_VIEW_LOOKUPS: true,

	rootUrl: '/'

	// athleteLevels: [
	// 	{key: 0, label: 'None'},
	// 	{key: 8, label: 'Level 8'},
	// 	{key: 9, label: 'Level 9'},
	// 	{key: 10, label: 'Level 10'},
	// 	{key: 'jr', label: 'Junior Elite'},
	// 	{key: 'sr', label: 'Senior Elite'}
	// ]

});

RoutineManager.ApplicationAdapter = DS.FixtureAdapter.extend();