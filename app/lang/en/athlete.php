<?php

return array(

	'confirm_delete'       => 'Are you sure you wish to delete this athlete?',
	'not_found'            => 'Athlete with id :id not found. Either the athlete does not exist or you do not have permission to view',
	'created'              => 'Athlete created',
	'created_error'        => 'Problem creating the athlete',
	'updated'              => ':name has been updated',
	'deleted'              => ':name has been deleted',
	'delete_failed'        => ':name could not be deleted',
	
	// Synchro messages
	'no_synchro_partner'            => ':name does not have an associated synchro partner',
	'invalid_access'                => 'Unable to assign synchro partners',
	'invalid_level'                 => ':name does not have a valid level for :event',
	'synchro_mismatch'              => 'The synchro pair cannot be linked because of their levels. :partner1 is :level1 and :partner2 is :level2',
	'synchro_age_mismatch'          => ':partner1 is in the :agegroup1 age group and :partner2 is in the :agegroup2 age group',
	'synchro_error'                 => 'There was a problem on the server associating :partner1 and :partner2 as synchro partners',
	'synchro_associated'            => ':partner1 and :partner2 have been associated as synchro partners',
	'synchro_disassociated'         => ':partner1 and :partner2 are no longer synchro partners',
	'synchro_disassociation_failed' => 'There was a problem on the server disassociating :partner1 and :partner2 as synchro partners',
);