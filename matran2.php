<?php
 class maTran{
    private $am = [];
    private $duong = [];
    function __construct(){
        $mang = [];
        for($i=0;$i<4;$i++){
            for($j=0;$j<4;$j++){
                $mang[$i][$j] = rand(-100,100);
            }
        }
        $this->kiemTra($mang, 0);
        
        echo "<pre>";
        print_r($mang);
        print_r($this->am);
        echo array_sum($this->am);  
        print_r($this->duong);
        
    }
    function kiemTra($input, $i){
        if(is_array($input)){
            $i++;
            foreach($input as $k=>$v){
               $this->kiemTra($v, $i);
            }
        }else{
            if($input < 0){
                array_push($this->am,$input);
            }else{
                array_push($this->duong,$input);
            }
        }
    }
 }
 new maTran();

?>