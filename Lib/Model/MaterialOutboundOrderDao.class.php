<?php
class MaterialOutboundOrderDao extends Model{
        public function findAll(){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_outbound_order order by outbound_id asc";
            $statement = $myPDO->query($sql);
            return $statement->fetchAll();
        }

        public function add($resource_id,$user_id,$outbound_number,$outbound_man,$outbound_date,$warehouse,$warehouse_worker,$subcontractor,$subcontractor_worker,$outbound_remark,$verify,$verify_user){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="insert into tb_material_outbound_order(resource_id,user_id,outbound_number,outbound_man,outbound_date,warehouse_id,warehouse_worker_id,subcontractor_id,subcontractor_worker_id,outbound_remark,verify,verify_user) values(?,?,?,?,?,?,?,?,?,?,?,?)";
            $statement = $myPDO->prepare($sql);
            $result=$statement->execute(array($resource_id,$user_id,$outbound_number,$outbound_man,$outbound_date,$warehouse,$warehouse_worker,$subcontractor,$subcontractor_worker,$outbound_remark,$verify,$verify_user));    
            if($result == false) return -1;
            else return $myPDO->lastInsertId();
        }

        public function findById($outbound_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_outbound_order where outbound_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($outbound_id));
            return $statement->fetch();
        }

        public function findByResourceId($resource_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_outbound_order where resource_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($resource_id));
            return $statement->fetchAll();
        }

        public function updateVerifyById($outbound_id,$state,$user_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="update tb_material_outbound_order set verify=?,verify_user=? where outbound_id=?";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($state,$user_id,$outbound_id));
        }

        public function deleteById($outbound_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="delete from tb_material_outbound_order where outbound_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($outbound_id));
        }

        public function updateById($outbound_man,$outbound_date,$warehouse,$warehouse_worker,$subcontractor,$subcontractor_worker,$outbound_remark,$outbound_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="update tb_material_outbound_order set outbound_man=?,outbound_date=?,warehouse_id=?,warehouse_worker_id=?,subcontractor_id=?,subcontractor_worker_id=?,outbound_remark=? where outbound_id=?";
            $statement = $myPDO->prepare($sql);
            $result = $statement->execute(array($outbound_man,$outbound_date,$warehouse,$warehouse_worker,$subcontractor,$subcontractor_worker,$outbound_remark,$outbound_id));
        }
}
?>
