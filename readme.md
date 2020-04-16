### Minimal PHP Library to Manipulate MySQL database

#### Just write the config file and good to go


```PHP
//database connection
$database = new Database();
$db = $database->getConnection();

//entity fields definition
$fields = '{
"Config_Key":"config_key",
"Config_Value":"config_value"
}';

//create entity object
$entity = new Entity(
    $db, //database connection
    'Config', //table name in mysql database
    $fields //fields in the table
);

//set values of the object
$values = array("key_1","value_2");
$entity->setFieldValues(\$values);

//perform operation
$entity->add();
```
