<?php
	class DeviceCategoryDao extends Model{
		/**
		 * [connectDatabase description] :创建数据库的连接
		 * @return [type] [description] :返回连接对象
		 */
		public function connectDatabase(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO ->query('set names utf8');//设置编码方式
			return $myPDO;
		}

		
		public function findById($device_category_id){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_deviceCategory where id=".$device_category_id;
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		/**
		 * [findAll description] :从数据库中查找所有的设备类型
		 * @return [type] [description] ：返回array
		 */
		public function findAll(){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_deviceCategory";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll(); 
		}

		public function insertDeviceCategory($categoryName){
			$myPDO = $this->connectDatabase();
			$sql = "insert into tb_deviceCategory(category_name) values (?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($categoryName));

		}

		public function updateDeviceCategory($id,$deviceCategoryName){
			$myPDO = $this->connectDatabase();
			$sql = "update tb_deviceCategory set category_name = ? where id = ? ";
			$statement = $myPDO->prepare($sql);
			return $result = $statement->execute(array($deviceCategoryName,$id));

		}

		public function deleteDeviceCategoryById($id){
			$myPDO = $this->connectDatabase();
			$sql = "delete from tb_deviceCategory where id = ? ";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
		}
















	}