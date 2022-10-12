SELECT bfe.label_name,bdfa.feild_id,bdfa.access FROM `bdcrm_feilds` as bfe
LEFT JOIN bdcrm_default_feilds_access as bdfa on bfe.id = bdfa.feild_id
WHERE bdfa.task_type_id=2;