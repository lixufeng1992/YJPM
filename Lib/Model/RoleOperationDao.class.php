<?php
	class RoleOperationDao extends Model{
		public function findByRoleid($roleid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_role_operation where roleid= ? order by operationid asc";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($roleid));
			return $statement->fetchAll();
		}

		public function add($roleid,$operationid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_role_operation(roleid,operationid) values(?,?)";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($roleid,$operationid));
			return $myPDO->lastInsertId();
		}

		public function deleteByRoleid($roleid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_role_operation where roleid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($roleid));
		}

		public function is_roleidOperationid_exist($roleid,$operationid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select count(*) from tb_role_operation where roleid=? and operationid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($roleid,$operationid));
			$row = $statement->fetch();
			if($row[0] == 0)return false;
			else return true;
		}

		public function deleteByRoleidOperationid($roleid,$operationid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_role_operation where roleid=? and operationid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($roleid,$operationid));
		}





	}

?>