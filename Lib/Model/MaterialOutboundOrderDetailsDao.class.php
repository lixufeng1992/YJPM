<?php
class MaterialOutboundOrderDetailsDao extends Model{
        public function findAll(){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_outbound_order_details order by detail_id asc";
            $statement = $myPDO->query($sql);
            return $statement->fetchAll();
        }

        public function add($material_id,$count,$remark,$outbound_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="insert into tb_material_outbound_order_details(material_id,count,remark,outbound_id) values(?,?,?,?)";
            $statement = $myPDO->prepare($sql);
            $result=$statement->execute(array($material_id,$count,$remark,$outbound_id));    
            if($result == false) return -1;
            else return $myPDO->lastInsertId();
        }

        public function findById($detail_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_outbound_order_details where detail_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($detail_id));
            return $statement->fetch();
        }

        public function findByOutboundOrderId($outbound_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_outbound_order_details where outbound_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($outbound_id));
            return $statement->fetchAll();
        }

        public function deleteByOutboundId($outbound_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="delete from tb_material_outbound_order_details where outbound_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($outbound_id));
        }

}
?>


