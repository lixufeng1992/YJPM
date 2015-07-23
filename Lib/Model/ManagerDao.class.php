<?php
	class ManagerDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_manager order by managerid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}
		//���Խ�ɫ���Ƿ��Ѵ���
		public function is_managername_exist($managername){
			
			$sql="select count(*) from tb_manager where managername=?";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($managername));
			$row = $statement->fetch();
			if($row[0]>0)return true;
			else return false;
		}
		public function findByManagername($managername){
			
			$sql="select * from tb_manager where managername=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($managername));
			return $statement->fetch();
		}
		public function update($managerid,$managername,$comments){
			
			$sql="update tb_manager set managername=?,comments=? where managerid = ?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($managername,$comments,$managerid));
		}
		public function findById($id){
			
			$sql="select * from tb_manager where managerid = ?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			$row = $statement->fetch();
			return $row;

		}
		public function deleteById($managerid){
			
			$sql="delete from tb_manager where managerid = ?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($managerid));

		}



		//�����ɫ����
		//����-1��ʾ����ʧ�� ����-2��ʾ������ͬ��ɫ�� �ɹ��򷵻ر��е�id��
		public function add($managername,$enum,$comments){
			

		

			$sql="insert into tb_manager (managername,employer_number,comments) values (?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($managername,$enum,$comments));
			if($result == false)return -1;

			$sql = "select managerid from tb_manager where managername=?";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($managername));
			$userrow = $statement->fetch(PDO::FETCH_ASSOC);
			return $userrow['managerid'];
		}



	}


?>