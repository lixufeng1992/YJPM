<?php
	class DeviceStorageDao extends Model{
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

		public function findById($device_storage_id){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_device_storage where id = ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($device_storage_id));
			return $statement->fetchAll();
		}


		public function deleteDeviceStorageById($device_storage_id){
			$myPDO = $this->connectDatabase();
			$sql = "delete from tb_device_storage where id = ?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($device_storage_id));
		}
	}