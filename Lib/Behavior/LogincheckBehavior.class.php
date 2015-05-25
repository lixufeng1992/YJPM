<?php
class LogincheckBehavior extends Behavior {
    // 行为参数定义
    protected $options   =  array(
        
    );
    // 行为扩展的执行入口必须是run
    public function run(&$params){
        $params = false;
        if(isset($_SESSION['my_username']) == true){
            $params = true;
        }
        return;
    }
}
?>