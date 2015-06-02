<?php
	class ManagerDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_manager order by managerid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}
		//���Խ�ɫ���Ƿ��Ѵ���
		public function is_managername_exist($managername){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select count(*) from tb_manager where managername=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($managername));
			$row = $statement->fetch();
			if($row[0]>0)return true;
			else return false;
		}
		public function findByManagername($managername){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_manager where managername=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($managername));
			return $statement->fetch();
		}
		public function update($managerid,$managername,$comments){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="update tb_manager set managername=?,comments=? where managerid = ?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($managername,$comments,$managerid));
		}
		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_manager where managerid = ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			$row = $statement->fetch();
			return $row;

		}
		public function deleteById($managerid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="delete from tb_manager where managerid = ?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($managerid));

		}



		//�����ɫ����
		//����-1��ʾ����ʧ�� ����-2��ʾ������ͬ��ɫ�� �ɹ��򷵻ر��е�id��
		public function add($managername,$enum,$comments){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');

			/*$sql = "select count(*) from tb_manager where managername=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($managername));
			$row = $statement->fetch();
			if($row[0]>0)return -2;*/

			$sql="insert into tb_manager (managername,employer_number,comments) values (?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($managername,$enum,$comments));
			if($result == false)return -1;

			$sql = "select managerid from tb_manager where managername=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($managername));
			$userrow = $statement->fetch(PDO::FETCH_ASSOC);
			return $userrow['managerid'];
		}



	}


?>