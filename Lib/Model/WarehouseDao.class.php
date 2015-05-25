<?php
	class WarehouseDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_pr_warehouse order by warehouse_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
                }


                public function findById($warehouse_id){
                        $dsn = C('DB_DSN1');
                        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
                        $myPDO->query('set names utf8');
                        $sql="select * from tb_pr_warehouse where warehouse_id=?";
                        $statement = $myPDO->prepare($sql);
                        $statement->execute(array($warehouse_id));
                        return $statement->fetch();
                }

		public function getByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_warehouse where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetchAll();
		}
		
		public function add($warehouse_name,$resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_pr_warehouse(warehouse_name,resource_id) values(?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($warehouse_name,$resource_id));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function updateById($warehouse_name,$warehouse_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_pr_warehouse set warehouse_name=? where warehouse_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($warehouse_name,$warehouse_id));
		}
		
		public function deleteById($warehouse_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_warehouse where warehouse_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($warehouse_id));
		}
		
		public function deleteByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_warehouse where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>
