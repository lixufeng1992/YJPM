<?php
import("@.Model.CommonDao");
	class MaterialDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_material order by materialid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($materialid){
			
			$sql="select * from tb_material where materialid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($materialid));
			return $statement->fetch();
		}

		public function findByCategoryid($categoryid){
			
			$sql="select * from tb_material where categoryid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($categoryid));
			return $statement->fetchAll();
		}

		public function add($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand){
			
			$sql="insert into tb_material(name,categoryid,worktype,unit,price_in,parameter,specification,brand) values(?,?,?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($materialid,$name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand){
			
			$sql="update tb_material set name=?,categoryid=?,worktype=?,unit=?,price_in=?,parameter=?,specification=?,brand=? where materialid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand,$materialid));		
		}

		public function deleteById($materialid){
			
			$sql="delete from tb_material where materialid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($materialid));		
		}

	}




?>