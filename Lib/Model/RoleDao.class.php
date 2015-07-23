<?php
	class RoleDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_role order by roleid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}
		//测试角色名是否已存在
		public function is_rolename_exist($rolename){
			
			$sql="select count(*) from tb_role where rolename=?";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($rolename));
			$row = $statement->fetch();
			if($row[0]>0)return true;
			else return false;
		}
		public function findByRolename($rolename){
			
			$sql="select * from tb_role where rolename=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($rolename));
			return $statement->fetch();
		}
		public function update($roleid,$rolename){
			
			$sql="update tb_role set rolename=? where roleid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($rolename,$roleid));
		}
		public function findById($id){
			
			$sql="select * from tb_role where roleid = ?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			$row = $statement->fetch();
			return $row;

		}
		public function deleteById($roleid){
			
			$sql="delete from tb_role where roleid = ?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($roleid));

		}



		//插入角色数据
		//返回-1表示插入失败 返回-2表示存在相同角色名 成功则返回表中的id号
		public function add($rolename){
			
			$sql = "select count(*) from tb_role where rolename=?";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($rolername));
			$row = $statement->fetch();
			if($row[0]>0)return -2;

			$sql="insert into tb_role (rolename) values (?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($rolename));
			if($result == false)return -1;

			$sql = "select roleid from tb_role where rolename=?";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($rolename));
			$userrow = $statement->fetch(PDO::FETCH_ASSOC);
			return $userrow['roleid'];
		}



	}


?>