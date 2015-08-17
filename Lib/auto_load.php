<?php 
    function import_classes($classname){
        $dir='';
        $flag = substr($classname,-3,3);
        if($flag==='Dao')$dir='Model';
        else if($flag==='ion'&& substr($classname,-6,6)==='Action'){
            $dir='Action';
        }
        else if($flag==='ior'&&substr($classname,-8,8)==='Behavior')$dir='Behavior';
        $parentDir = dirname(__FILE__);
        require_once ($parentDir."/$dir/$classname.class.php");
    }
    spl_autoload_register('import_classes');
    
?>