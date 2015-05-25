<?php
	class WarehouseWorkerDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_pr_warehouseworker order by warehouse_worker_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
                }

                public function findById($warehouse_worker_id){
                        $dsn = C('DB_DSN1');
                        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
                        $myPDO->query('set names utf8');
                        $sql="select * from tb_pr_warehouseworker where warehouse_worker_id=?";
                        $statement = $myPDO->prepare($sql);
                        $statement->execute(array($warehouse_worker_id));
                        return $statement->fetch();
                }

		public function getByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_warehouseworker where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetchAll();
		}
		
		public function add($warehouse_worker_name,$resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_pr_warehouseworker(warehouse_worker_name,resource_id) values(?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($warehouse_worker_name,$resource_id));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function updateById($warehouse_worker_name,$warehouse_worker_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_pr_warehouseworker set warehouse_worker_name=? where warehouse_worker_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($warehouse_worker_name,$warehouse_worker_id));
		}
		
		public function deleteById($warehouse_worker_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_warehouseworker where warehouse_worker_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($warehouse_worker_id));
		}
		
		public function deleteByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_warehouseworker where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>
