<?php

include_once './config/Entity.php';
include_once './config/database.php';

echo '<h1>test-database-entity</h1>';

//database
$database = new Database();
$db = $database->getConnection();

//entity fields definition
$fields = '{
  "Config_Key":"config_key",
  "Config_Value":"config_value"
}';

//create entity object
$entity = new Entity($db, 'Config', $fields);

//set values of the object
$values = array("key_1","value_2");
$entity->setFieldValues($values);

//perform operation
$entity->add();

?>