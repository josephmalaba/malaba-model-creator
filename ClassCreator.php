<?php
//A class to craete database modeled classes
//Joseph Malaba
// 1st October 2014

include_once('./DynamicConection.php');

class ClassCreator {
    //properties
    private $foldername;
    private $classes;
    private $properties;
    private $methods;
    private $con;
    
    //constructor
    function _construct(){
        //$this->con = new DynamicConnection();
    }
    
    //conmection function
    public function startConnection($host,$user,$pwd,$db){
        $this->con = new DynamicConnection($host,$user,$pwd,$db);
    }
    
    //table content analyzing functions
    
    
    //file creating functions
    public function createFile($fileName,$content){
        $phpfile = fopen($fileName.".php", "w") ;
        fwrite($phpfile, $content);
        fclose($phpfile);
    }
    //file writing functions (the above funtion also does the same thing)
    
    //file reading functions
    
    //folder (diroctory creating functions)
    public function createDirectory($directory){
        if(@mkdir($directory)){
            return true;
        }else{
            return false;
        }
    }
    
    //funtion to add properties
    public function addProperty($tableName){
        $sql_key = "SHOW KEYS FROM $tableName WHERE Key_name='PRIMARY'";
		$this->con->execute_query($sql_key);
		$keyresult = $this->con->get_result();
		$key = '';
		foreach($keyresult as $row){
            $key = $row['Column_name'];
        }
		
		$sql = "DESCRIBE $tableName";
        $this->con->execute_query($sql);
        $tableresult = $this->con->get_result();

        $property = "\t//Database table constants\n";
		$property.="\tconst DB_TABLE = '".$tableName."';\n\tconst DB_TABLE_PK = '".$key."';\n\n";
        $property .="\t//Properties\n";
        foreach($tableresult as $row){
            $property.= "\tprivate $".lcfirst($row['Field']).";\n";
        }
        return $property."";
    }
    
    //a function to call all other functions and create all classes from db...
    public function createClases(){
        $sql = "SHOW TABLES";
        $this->con->execute_query($sql);
        $tableresult = $this->con->get_result();
        foreach($tableresult as $row){
            $properties = $this->addProperty($row[0]);
            
            $filecontent = "<?php\n/*\n*Created By Malaba model builder tool for codeigniter\n* ".Date('d-M-Y')."\n* Joseph Malaba\n*/\n\n// a class reflecting table ".$row[0]."\n";
            $filecontent.="class ".ucfirst(str_replace('_','',str_replace('tbl','',strtolower($row[0]))))." extends MY_Model";
            $filecontent.="{\n".$properties."}\n?>";
            
            $directory = "./ClassCreator";
            $this->createDirectory($directory);
            $fileName = $directory."/".lcfirst(str_replace('_','',str_replace('tbl','',strtolower($row[0]))))."";
            $this->createFile($fileName,$filecontent);
        }
    }
}
?>