CREATE TABLE {$NAMESPACE}_fact.fact_objectdimension (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  objectPHID VARBINARY(64) NOT NULL,
  UNIQUE KEY `key_object` (objectPHID)
) ENGINE=InnoDB, COLLATE {$COLLATE_TEXT};
