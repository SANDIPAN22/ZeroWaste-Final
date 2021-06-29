<?php
class MonitorGarbageBin02{  
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
      public function fetchBinAlarm_status($table_name,$key,$value)  
      {  
           $array = array();  
           $query = "SELECT alarm_status FROM ".$table_name." WHERE ".$key." = '".$value."' ";  
        //    echo '<h1>'.$query.'</h1>';
           $result = mysqli_query($this->con, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                //$array[]= $row; 
                array_push($array,$row['alarm_status']);
           }  
           return $array;  
           
      }
      
      public static function sendMail($arr){
          $result= array_map(function($item){return $item==1;},$arr);
          return $result;
      } 
      
 }  
 class fetchBinAlarm_statusTest extends \PHPUnit\Framework\TestCase{
    public function test(){
        $dashboard = new MonitorGarbageBin02;
        $result = $dashboard->fetchBinAlarm_status('garbage_bin','municipality_id','MY2021S01');
        $result2 = MonitorGarbageBin02::sendMail($result);
        $temp = array('0','0','1');
        $temp2 = array(false,false,true);
        $this->assertEquals($temp,$result);
        $this->assertEquals($temp2,$result2);
    }
}