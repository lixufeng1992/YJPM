<?php
	class ProcessPeriodworkDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_process_periodwork order by id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_process_periodwork where id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function findByProcessid($project_process_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_process_periodwork where project_process_id=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($project_process_id));
			return $statement->fetchAll();
		}

		public function deleteById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_process_periodwork where id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($id));
		}

		public function add($project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_process_periodwork(project_process_id,create_date,create_userid,confirm_date,period_count,remark) values(?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($id,$project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_process_periodwork set project_process_id=?,create_date=?,create_userid=?,confirm_date=?,period_count=?,remark=? where id=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($project_process_id,$create_date,$create_userid,$confirm_date,$period_count,$remark,$id));		
		}


	}

		
		



?>