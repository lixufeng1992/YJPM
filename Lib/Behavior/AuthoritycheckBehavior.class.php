<?php
import("@.Model.RoleDao");
import("@.Model.RoleOperationDao");
import("@.Model.OperationDao");
import("@.Model.UserDao");

class AuthoritycheckBehavior extends Behavior {
    private $userDao;
    private $roleDao;
    private $roleOperationDao;
    private $operationDao;
    // 行为参数定义
    protected $options   =  array(
        
    );
    public function __construct(){
        parent::__construct();
        $this->roleDao=new RoleDao();
        $this->roleOperationDao=new RoleOperationDao();
        $this->operationDao=new OperationDao();
        $this->userDao=new UserDao();
    }
    // 行为扩展的执行入口必须是run
    public function run(&$params){
        $params['result'] = false;
        if(isset($_SESSION['my_username']) == false){
            //$params['result'] = false;
            return;
        }

        $operationid = $params['operationid'];
        $my_username = $_SESSION['my_username'];
        $userRow = $this->userDao->findByUsername($my_username);
        $roleid = $userRow['roleid'];
        //查找role对应的功能
        $roleOperationArray = $this->roleOperationDao->findByRoleid($roleid);

        foreach($roleOperationArray as $value){
            if($operationid == $value['operationid']){
                $params['result'] = true;
                return;
            }
        }
       
    }
}
?>