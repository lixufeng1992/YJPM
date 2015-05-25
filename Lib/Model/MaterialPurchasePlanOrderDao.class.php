<?php
    class MaterialPurchasePlanOrderDao extends Model{
        public function findAll(){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_purchase_plan_order order by plan_id asc";
            $statement = $myPDO->query($sql);
            return $statement->fetchAll();
        }
        
        public function findById($plan_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_purchase_plan_order where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($plan_id));
            return $statement->fetch();
        }

        public function findByResourceId($resource_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_purchase_plan_order where resource_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($resource_id));
            return $statement->fetchAll();
        }

        public function add($resource_id,$plan_name,$plan_number,$plan_type,$plan_proposer,$declare_date,$plan_date,$tech_explanation,$plan_remark,$amount,$user_id,$has_in_contractid = 0){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="insert into tb_material_purchase_plan_order(resource_id,plan_name,plan_number,plan_type,plan_proposer,declare_date,plan_date,tech_explanation,plan_remark,amount,user_id,has_in_contractid) values(?,?,?,?,?,?,?,?,?,?,?,?)";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($resource_id,$plan_name,$plan_number,$plan_type,$plan_proposer,$declare_date,$plan_date,$tech_explanation,$plan_remark,$amount,$user_id,$has_in_contractid));
            if($result == false) return -1;
            else return $myPDO->lastInsertId();
        }

        public function updateById($plan_id,$resource_id,$plan_name,$plan_number,$plan_type,$plan_proposer,$declare_date,$plan_date,$tech_explanation,$plan_remark,$amount,$user_id,$verify_user,$verify,$finish,$has_in_contractid = 0){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="update tb_material_purchase_plan_order set resource_id=?,plan_name=?,plan_number=?,plan_type=?,plan_proposer=?,declare_date=?,plan_date=?,tech_explanation=?,plan_remark=?,amount=?,user_id=?,verify_user=?,verify=?,finish=?,has_in_contractid=? where plan_id=?";
            $statement = $myPDO->prepare($sql);
            return $statement->execute(array($resource_id,$plan_name,$plan_number,$plan_type,$plan_proposer,$declare_date,$plan_date,$tech_explanation,$plan_remark,$amount,$user_id,$verify_user,$verify,$finish,$has_in_contractid,$plan_id));
        
        }
        
        public function updateVerifyById($plan_id,$state,$user_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="update tb_material_purchase_plan_order set verify=?,verify_user=? where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($state,$user_id,$plan_id));
        }

        public function updateFinishById($plan_id,$state){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="update tb_material_purchase_plan_order set finish=? where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($state,$plan_id));
        }

        public function deleteById($plan_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="delete from tb_material_purchase_plan_order where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($plan_id));
        }
    }
?>
