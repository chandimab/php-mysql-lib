<?php
class Entity{
 
    // database connection and table name
    private $conn;
    private $table_name;
    // object properties
    public $fields;
    public $fields_map;
    public $fields_map_update;
    public $num_fields;
    public $field_values;
    // constructor with $db as database connection
    public function __construct($db, $table_name, $fields){
        $this->conn = $db;
        $this->table_name = $table_name;
        $this->fields = json_decode($fields, true);
        $this->num_fields = count($this->fields);
        $this->genFieldMaps();
    }

    function genFieldMaps(){
        $this->gen_fields_map();
        $this->gen_fields_map_update();
    }

    function setFieldValues(array $field_values){
        $this->field_values = $field_values;
    }
    function gen_fields_map(){
        $this->fields_map = '';
        foreach($this->fields as $key=>$value){
            $this->fields_map .= $key .'=:'. $value;
            $this->num_fields --;
            if($this->num_fields  >= 1) $this->fields_map .= ', ';
        }
    }
    function gen_fields_map_update(){

        $this->num_fields = count($this->fields);
        $this->fields_map_update = '';
        foreach($this->fields as $key=>$value){
            if($this->num_fields == count($this->fields)) { //skip primary key
                $this->num_fields --;
                continue;
            }
            $this->fields_map_update .= $key.'=:'.$value;
            $this->num_fields --;
            if($this->num_fields  >= 1) $this->$fields_map_update .= ', ';
        }
    }

    function insert(){

        // query to insert record
        $query = "INSERT IGNORE INTO
                    " . $this->table_name . "
                SET ". $this->fields_map;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        for($i=0; $i<count($this->field_values) ; $i++){
            $this->field_values[$i]=htmlspecialchars(strip_tags($this->field_values[$i]));
        }
        
        // bind values
        $i =0;
        foreach($this->fields as $key=>$value){
            $stmt->bindParam(":".$value, $this->field_values[$i]);
            $i++;
        }
    
        print_r($stmt);

        // execute query
        if($stmt->execute()){
            //$this->user_id = $this->conn->lastInsertId();
            return true;
        }

        print_r($stmt->errorinfo());

        return false;        
    }

}