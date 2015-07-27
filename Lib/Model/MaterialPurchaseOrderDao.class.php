<?php
import("@.Model.CommonDao");
class MaterialPurchaseOrderDao extends CommonDao{

  public function findAll(){
  
    $sql="select * from tb_material_purchase_order order by order_id asc";
    $statement = $this->commonPDO->query($sql);
    return $statement->fetchAll();
  }

  public function findById($order_id){
   
    $sql="select * from tb_material_purchase_order where order_id=?";
    $statement = $this->commonPDO->prepare($sql);
    $statement->execute(array($order_id));
    return $statement->fetch();
  }

  public function getAll(){
  
    $sql="select order_id,project.resource_id as project_id,resource_name as project_name,enterprise.`name` as enterprise_name,document,happen_date,transactor,in_method,warehouse.warehouse_name as default_warehouse,administrator.warehouse_worker_name as default_administrator,price,`order`.remark,creater.username as creater_name,create_date,checked,checker.username as checker_name,check_date from tb_material_purchase_order as `order` left join tb_projectresource as project on `order`.project_id = project.resource_id left join tb_enterprise as enterprise on `order`.enterprise_id = enterprise.enterpriseid left join tb_pr_warehouse as warehouse on `order`.default_warehouse_id = warehouse.warehouse_id left join tb_pr_warehouseworker as administrator on `order`.default_administrator_id =  administrator.warehouse_worker_id left join tb_user as creater on `order`.create_user_id = creater.userid left join tb_user as checker on `order`.check_user_id = checker.userid";
    $statement = $this->commonPDO->query($sql);
    return $statement->fetchAll();
  }

  public function getById($order_id){
   
    $sql="SELECT `order`.order_id, `order`.plan_id, `order`.contract_id, `order`.project_id, `order`.enterprise_id, `order`.document, `order`.happen_date, `order`.transactor, `order`.in_method, `order`.default_warehouse_id, `order`.default_administrator_id, `order`.price, `order`.remark, plan.plan_name, project.resource_name AS project_name, enterprise.`name` AS enterprise_name FROM tb_material_purchase_order AS `order` LEFT JOIN tb_material_purchase_plan_order AS plan ON `order`.plan_id = plan.plan_id LEFT JOIN tb_projectresource AS project ON `order`.project_id = project.resource_id LEFT JOIN tb_enterprise AS enterprise ON `order`.enterprise_id = enterprise.enterpriseid WHERE `order`.order_id = ?";
    $statement = $this->commonPDO->prepare($sql);
    $statement->execute(array($order_id));
    return $statement->fetch();
  }

  public function add($plan_id,$contract_id,$project_id,$enterprise_id,$document,$happen_date,$transactor,$in_method,$default_warehouse_id,$default_administrator_id,$price,$remark,$create_user_id,$create_date){
   
    $sql="insert into tb_material_purchase_order(plan_id,contract_id,project_id,enterprise_id,document,happen_date,transactor,in_method,default_warehouse_id,default_administrator_id,price,remark,create_user_id,create_date) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $statement = $this->commonPDO->prepare($sql);
    $result = $statement->execute(array($plan_id,$contract_id,$project_id,$enterprise_id,$document,$happen_date,$transactor,$in_method,$default_warehouse_id,$default_administrator_id,$price,$remark,$create_user_id,$create_date));
    if($result == false)return -1;
    else return $this->commonPDO->lastInsertId();
  }

  public function updateCheckById($order_id,$state,$user_id,$date){
   
    $sql="update tb_material_purchase_order set checked=?,check_user_id=?,check_date=? where order_id=?";
    $statement = $this->commonPDO->prepare($sql);
    $result = $statement->execute(array($state,$user_id,$date,$order_id));
  }

  public function deleteById($order_id){
  
    $sql="delete from tb_material_purchase_order where order_id=?";
    $statement = $this->commonPDO->prepare($sql);
    return $statement->execute(array($order_id));		
  }

  public function updateById($plan_id,$contract_id,$enterprise_id,$document,$happen_date,$transactor,$in_method,$default_warehouse_id,$default_administrator_id,$price,$remark,$order_id){
    
    $sql="update tb_material_purchase_order set plan_id=?,contract_id=?,enterprise_id=?,document=?,happen_date=?,transactor=?,in_method=?,default_warehouse_id=?,default_administrator_id=?,price=?,remark=? where order_id=?";
    $statement = $this->commonPDO->prepare($sql);
    return $statement->execute(array($plan_id,$contract_id,$enterprise_id,$document,$happen_date,$transactor,$in_method,$default_warehouse_id,$default_administrator_id,$price,$remark,$order_id));
  }

}




?>
