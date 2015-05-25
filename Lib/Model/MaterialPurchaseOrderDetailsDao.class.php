<?php
	class MaterialPurchaseOrderDetailsDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_purchase_order_details order by detail_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}
		
		public function add($material_id,$specification,$unit_price,$count,$price,$remark,$warehouse_id,$administrator_id,$order_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_material_purchase_order_details(material_id,specification,unit_price,count,price,remark,warehouse_id,administrator_id,order_id) values(?,?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($material_id,$specification,$unit_price,$count,$price,$remark,$warehouse_id,$administrator_id,$order_id));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function getByOrderId($order_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="SELECT details.material_id, details.specification, details.unit_price, details.count, details.price, details.remark, details.warehouse_id, details.administrator_id, details.order_id, material.worktype, material.`name`, material.unit from tb_material_purchase_order_details as details left join tb_material as material on details.material_id = material.materialid where order_id = ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($order_id));
			return $statement->fetchAll();
		}
		

                public function findById($order_id){
		    $dsn = C('DB_DSN1');
		    $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		    $myPDO->query('set names utf8;'); 
		    $sql="select * from tb_material_purchase_order_details where order_id=?";
		    $statement = $myPDO->prepare($sql);
		    $statement->execute(array($order_id));
		    return $statement->fetchAll();
                }
                public function deleteByOrderId($order_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_material_purchase_order_details where order_id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($order_id));		
		}
		
	}




?>
