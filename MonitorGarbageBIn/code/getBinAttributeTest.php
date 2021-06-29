<?php
class MonitorGarbageBin03{  
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
      public function getBinAttribute($table_name,$key,$value)  
      {  
           $array = array();  
           $query = "SELECT bin_id FROM ".$table_name." WHERE ".$key." = '".$value."' ";  
        //    echo '<h1>'.$query.'</h1>';
           $result = mysqli_query($this->con, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[]= $row['bin_id'];  
           }  
           return $array;  
           
      }  
 }
 class getBinAttributeTest extends \PHPUnit\Framework\TestCase{
    public function test(){
        $dashboard = new MonitorGarbageBin03;
        $result = $dashboard->getBinAttribute('garbage_bin','municipality_id','MY2021S01');
        $temp = array('BY2021M01S01','BY2021M01S02','BY2021M01S03');
        $this->assertEquals($temp,$result);
    }
}