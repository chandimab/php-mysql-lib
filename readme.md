### Minimal PHP Library to Manipulate MySQL database

The MySQL table used in this example
```MySQL
CREATE TABLE `Config` (
  `Config_Key` varchar(255) NOT NULL,
  `Config_Value` varchar(255) NOT NULL
)
```

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
$entity->insert();
```
