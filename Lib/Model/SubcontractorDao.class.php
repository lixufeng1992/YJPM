<?php
	class SubcontractorDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_subcontractor order by subcontractor_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

                public function findById($subcontractor_id){
                        $dsn = C('DB_DSN1');
                        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
                        $myPDO->query('set names utf8');
                        $sql="select * from tb_pr_subcontractor where subcontractor_id=?";
                        $statement = $myPDO->prepare($sql);
                        $statement->execute(array($subcontractor_id));
                        return $statement->fetch();
                }

		
		public function getByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_subcontractor where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetchAll();
		}
		
		public function add($resource_id,$enterprise_id,$subcontractor_name){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_pr_subcontractor(resource_id,enterprise_id,subcontractor_name) values(?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id,$enterprise_id,$subcontractor_name));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function deleteById($subcontractor_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_subcontractor where subcontractor_id=?";			
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($subcontractor_id));			
		}

		public function deleteByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_subcontractor where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>
