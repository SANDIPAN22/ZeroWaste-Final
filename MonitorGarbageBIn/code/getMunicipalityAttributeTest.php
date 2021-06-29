<?php
class MonitorGarbageBin{  
      public $con;  
      public function __construct()  
      {  
           $this->con = mysqli_connect("166.62.27.181", "nestio_admin","nestio_admin@22","ZEROwaste");  
           
           if(!$this->con)  
           {  
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
           }  
           else{
            //    echo "Successfully Connected!";
           }
      }  
    //  
      public function getMunicipalityAttribute($table_name,$key,$value)  
      {  
           $array = array();  
           $query = "SELECT municipality_name,auth_name,auth_email FROM ".$table_name." WHERE ".$key." = '".$value."' ";  
        //    echo '<h1>'.$query.'</h1>';
           $result = mysqli_query($this->con, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                //$array[]= $row; 
                array_push($array,$row['municipality_name']);
                array_push($array,$row['auth_name']);
                array_push($array,$row['auth_email']); 
           }  
           return $array;  
           
      }  
 }  
 class getMunicipalityAttributeTest extends \PHPUnit\Framework\TestCase{
    public function test(){
        $dashboard = new MonitorGarbageBin;
        $result = $dashboard->getMunicipalityAttribute('municipality','municipality_id','MY2021S01');
        $temp = array('Kamarhati Municipality','Anirban','kmc@gmail.com');
        $this->assertEquals($temp,$result);
    }
}