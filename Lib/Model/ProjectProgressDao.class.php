<?php
	class ProjectProgressDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_project_progress order by progressid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_project_progress where projectid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetchAll();
		}

		public function findById($progressid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_project_progress where progressid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($progressid));
			return $statement->fetch();
		}

		public function add($projectid,$createdate,$content){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_project_progress(projectid,createdate,content) values(?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$createdate,$content));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($progressid,$projectid,$createdate,$content){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_project_progress set projectid = ?,createdate=?,content=? where progressid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($projectid,$createdate,$content,$progressid));		
		}

		public function deleteById($progressid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_project_progress where progressid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($progressid));		
		}

	}




?>