<?php
header('Content-Type:text/html;charset=utf-8');
import("@.Model.CommonDao");
	class PersonDao extends CommonDao{
		public function findAll(){
			$sql="select * from tb_person order by id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			$sql="select * from tb_person where id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function findByNamePhoneEnterpriseid($name,$phone,$enterpriseid){
			$sql="select * from tb_person where name=? and phone=? and enterpriseid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($name,$phone,$enterpriseid));
			return $statement->fetch();
		}

		public function add($name,$phone,$enterpriseid){
			$sql="insert into tb_person(name,phone,enterpriseid) values(?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name,$phone,$enterpriseid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($id,$name,$phone,$enterpriseid){
			$sql="update tb_person set name=?,phone=?,enterpriseid=? where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$phone,$enterpriseid,$id));		
		}

		public function deleteById($id){
			$sql="delete from tb_person where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}
	}

?>