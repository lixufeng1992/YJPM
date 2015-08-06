<?php
	class DeviceDao extends Model{
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

		public function findAll(){
			$myPDO = $this->connectDatabase();
			$myPDO->query('set names utf8;');
			$sql = "select * from tb_device";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function update($devicesInfo){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_device where id = ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($devicesInfo['deviceId']));
			$resultSet =  $statement->fetch();
			$categoryId = $resultSet['category_id'];
			$device_storage_id = $resultSet['device_storage_id'];

			//更新固定设备类别表
			$updateCategorySql = "update tb_deviceCategory set category_name = ? where id = ?";
			$statementForCategory = $myPDO->prepare($updateCategorySql);
			$statementForCategory->execute(array($devicesInfo['category_name'],$categoryId));

			//更新设备库存表
			$updateStorageSql = "update tb_device_storage set device_name = ?,device_number = ?,device_unit = ?,own_project = ?,device_unit = ? where id = ?";
			$statementForStorage = $myPDO->prepare($updateStorageSql);
			$statementForStorage->execute(array($devicesInfo['device_name'],$devicesInfo['device_number'],$devicesInfo['device_unit'],$devicesInfo['own_project'],$devicesInfo['device_unit'],$device_storage_id));

			//更新设备信息表
			 $updateDeviceSql = "update tb_device set purchase_date = ?,login_date = ?,break_date = ?,factory = ?,device_id = ?,device_status=?,calculate_method = ?,
			 manager_section = ?,manager_type = ?,manager = ?,device_initial_price = ?,sum_depreciation = ?,device_net_value = ?,project_cost_method = ? where id = ?";
			 $statementForDevice = $myPDO->prepare($updateDeviceSql);
			 return $statementForDevice->execute(array($devicesInfo['purchase_date'],$devicesInfo['login_date'],$devicesInfo['break_date'],$devicesInfo['factory'],$devicesInfo['device_id'],$devicesInfo['device_status'],$devicesInfo['calculate_method'],
			 	$devicesInfo['manager_section'],$devicesInfo['manager_type'],$devicesInfo['manager'],$devicesInfo['device_initial_price'],$devicesInfo['sum_depreciation'],$devicesInfo['device_net_value'],$devicesInfo['project_cost_method'],$devicesInfo['deviceId']));

		}

		public function findDeviceById($deviceId){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_device where id = ?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($deviceId));
			return $statement->fetch();
		}

		public function deleteDevieById($deviceId){
			$myPDO = $this->connectDatabase();
			$sql = "delete from tb_device where id = ?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($deviceId));
		}

	}