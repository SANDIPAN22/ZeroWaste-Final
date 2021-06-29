<?php
class GenerateRoute02{  
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
      public function getBinDetails($table_name,$key,$value)  
      {  
           $array = array();  
           $query = "SELECT * FROM ".$table_name." WHERE ".$key." = '".$value."' ";  
        //    echo '<h1>'.$query.'</h1>';
           $result = mysqli_query($this->con, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[]= $row['bin_id'];  
           }  
           return $array;  
           
      }  
 }
 class getBinDetailsTest extends \PHPUnit\Framework\TestCase{
    public function test(){
        $dashboard = new GenerateRoute02;
        $result = $dashboard->getBinDetails('garbage_bin','municipality_id','MY2021S01');
        $temp = array('BY2021M01S01','BY2021M01S02','BY2021M01S03');
        $this->assertEquals($temp,$result);
    }
}