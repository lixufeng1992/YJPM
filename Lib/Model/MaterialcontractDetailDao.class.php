<?php
    class MaterialContractDetailDao extends Model{
        public function findAll(){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_materialcontract_detail order by detail_id asc";
            $statement = $myPDO->query($sql);
            return $statement->fetchAll();
        }

        public function add($contractid,$material_id,$enquiry_id,$enquiry_offer,$count,$remark,$plan_id,$warehouseid,$warehouseworkerid){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="insert into tb_materialcontract_detail(contractid,material_id,enquiry_id,enquiry_offer,count,remark,plan_id,warehouseid,warehouseworkerid) values(?,?,?,?,?,?,?,?)";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($contractid,$material_id,$enquiry_id,$enquiry_offer,$count,$remark,$plan_id,$warehouseid,$warehouseworkerid));
            if($result == false) return -1;
            else return $myPDO->lastInsertId();
        }

        public function findByPlanId($plan_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_materialcontract_detail where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($plan_id));
            return $statement->fetchAll();
        }

        public function findByContractid($contractid){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_materialcontract_detail where contractid=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($contractid));
            return $statement->fetchAll();
        }

        public function deleteByPlanId($plan_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="delete from tb_materialcontract_detail where plan_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($plan_id));
        }
    }
    
?>
