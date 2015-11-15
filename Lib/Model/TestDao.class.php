<?php
import("@.Model.CommonDao");
	class TestDao extends CommonDao{
		public function add($isit){
			
			$sql="insert into tb_test(isit) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($isit));
		}

		public function updateById(
			$id,
			$name,
			$isit,
			$text
			){
			$sql="update tb_test set
					name=?,
					isit=?,
					text=?
					where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,
											$isit,
											$text,
											$id));
		}

	}




?>