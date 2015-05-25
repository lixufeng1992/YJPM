<?php
    class MaterialPurchasePlanOrderDetailsDao extends Model{
        public function findAll(){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_mpp_order_details order by detail_id asc";
            $statement = $myPDO->query($sql);
            return $statement->fetchAll();
        }

        public function findById($detail_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_mpp_order_details where detail_id = ?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($detail_id));
            return $statement->fetch();   
        }

        public function add($plan_id,$material_id,$enquiry_id,$enquiry_offer,$count,$remark){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="insert into tb_mpp_order_details(plan_id,material_id,enquiry_id,enquiry_offer,count,remark) values(?,?,?,?,?,?)";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($plan_id,$material_id,$enquiry_id,$enquiry_offer,$count,$remark));
            if($result == false) return -1;
            else return $myPDO->lastInsertId();
        }

        public function findByPlanId($plan_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_mpp_order_details where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($plan_id));
            return $statement->fetchAll();
        }

        public function deleteByPlanId($plan_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="delete from tb_mpp_order_details where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($plan_id));
        }
    }
    
?>
