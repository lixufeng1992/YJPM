<?php
import("@.Model.DeviceCategoryDao");
import("@.Model.DeviceDao");
import("@.Model.DeviceStorageDao");
header('Content-Type:text/html;charset=utf-8');

class OperDeviceManagerAction extends LoginAfterAction{
	private $deviceCategoryDao; //设备工种类别表

	private $deviceDao; //固定设备表

	private $deviceStorageDao; //设备库存表

	public function _initialize(){
		parent::_initialize();
		$this->deviceCategoryDao = new DeviceCategoryDao();
		$this->deviceDao = new DeviceDao();
		$this->deviceStorageDao = new DeviceStorageDao();
	}


	//权限检查
		public function permissionCheck($operationId){
			$params = array();
			$params['result'] = false;
			$params['operationid'] = $operationId;
			tag('behavior_authoritycheck',$params);
			return $params['result'] == false ? false : true;
	}

	//设备工种类型
		public function deviceClassMaintain(){
			$isPermit = $this->permissionCheck(DEVICE_CLASS_MAINTAIN);
			if($isPermit == false){
			   $this->redirect('Staticpage/wrongalert',array(),3,"您无法操作权限");
			   return;
			}

			//获得设备工种类型,用于前台展示
			$deviceCategory = $this->deviceCategoryDao->findAll();

			//在前端显示的信息
			$this->assign('deviceCategory',$deviceCategory);
			$this->display('OperDeviceManage/deviceClassMaintain');
		}


	//添加设备工种类别
		public function addDeviceCategory(){
			$categoryName = $_POST['name'];
			$returnData = array();
			if($categoryName != null){
			$this->deviceCategoryDao->insertDeviceCategory($categoryName);
    		$this->redirect('OperDeviceManager/deviceClassMaintain',array(),2,"添加成功...");
			}
		}


	//修改设备工种类别
		public function modifyDeviceCategory(){
			$id = $_POST['id'];
			$deviceCategoryName=  $_POST['name'];
			$result = $this->deviceCategoryDao->updateDeviceCategory($id,$deviceCategoryName);
			if($result != true){
				$this->display('Staticpage/wrongalert');
			    return;
			}else{
				$this->redirect('OperDeviceManager/deviceClassMaintain',array(),2,"修改成功...");
			}
		}

	//删除设备工种类别
		public function deleteDeviceCategory(){
			$id = $_GET['id'];
			$this->deviceCategoryDao->deleteDeviceCategoryById($id);
			$this->redirect('OperDeviceManager/deviceClassMaintain',array(),2,"删除成功...");
		}
	

	//设备维护
		public function deviceMaintain(){
			$isPermit = $this->permissionCheck(DEVICE_MAINTAIN);
			if($isPermit == false){
			   $this->redirect('Staticpage/wrongalert',array(),3,"您无法操作权限");
			   return;
			}

			//获得设备工种类型,用于前台展示
			$devicesInfo = $this->deviceDao->findAll();
			foreach($devicesInfo as $key => $value){
				//添加设备工种类别
				$resultSet = $this->deviceCategoryDao->findById($value['category_id']);
				$devicesInfo[$key]['categoryName'] = $resultSet[0]['category_name'];

				//添加设备库存信息
				$resultSet2  = $this->deviceStorageDao->findById($value['device_storage_id']);
				$devicesInfo[$key]['deviceName'] = $resultSet2[0]['device_name'];
				$devicesInfo[$key]['deviceNumber'] = $resultSet2[0]['device_number'];
				$devicesInfo[$key]['ownProject'] = $resultSet2[0]['own_project'];
				$devicesInfo[$key]['deviceUnit'] = $resultSet2[0]['device_unit'];
			}
			
			//在前端显示的信息
			$this->assign('devicesInfo',$devicesInfo);
			$this->display('OperDeviceManage/deviceMaintain');
		}

	//修改设备维护信息
		public function modifyDeviceInfo(){
			$returnData = array();
			$device_name = $_POST['name'];
			$own_project = $_POST['own_project'];
			$category_name = $_POST['code'];
			$purchase_date = $_POST['buydate'];
			$login_date = $_POST['recorddate'];
			$break_date = $_POST['crashdate'];
			$factory = $_POST['producer'];
			$device_id = $_POST['productid'];//出厂编号
			$device_status = $_POST['state'];
			$device_unit = $_POST['unit'];
			$device_number = $_POST['amount'];
			$calculate_method = $_POST['priceway'];
			$manager_section = $_POST['admingroup'];
			$manager_type = $_POST['admintype'];
			$manager = $_POST['admin'];
			$device_initial_price = $_POST['originalprice'];
			$sum_depreciation = $_POST['depriciation'];
			$device_net_value = $_POST['price'];
			$project_cost_method = $_POST['includeway'];
			$deviceId = $_POST['id'];

			$deviceInfo = array('device_name'=>$device_name,'own_project'=>$own_project,'category_name'=>$category_name,'purchase_date'=>$purchase_date,
				'login_date'=>$login_date,'break_date'=>$break_date,'factory'=>$factory,'device_id'=>$device_id,'device_status'=>$device_status,
				'device_unit'=>$device_unit,'device_number'=>$device_number,'calculate_method'=>$calculate_method,'manager_section'=>$manager_section,
				'manager_type'=>$manager_type,'manager'=>$manager,'device_initial_price'=>$device_initial_price,'sum_depreciation'=>$sum_depreciation,
				'device_net_value'=>$device_net_value,'project_cost_method'=>$project_cost_method,'deviceId'=>$deviceId);
			$returnData['result'] = $this->deviceDao->update($deviceInfo);
			echo json_encode($returnData);

		}

		public function deleteDeviceInfo(){
			$returnData = array();
			$deviceId = $_POST['device_id'];
			$resultSet = $this->deviceDao->findDeviceById($deviceId);
			$device_storage_id = $resultSet['device_storage_id'];

			//先删除设备库存信息，再删除设备信息表信息
			$this->deviceStorageDao->deleteDeviceStorageById($device_storage_id);
		    $result = $this->deviceDao->deleteDevieById($deviceId);
			$returnData['result'] = $result;
			echo json_encode($returnData);
			
		}




















}

?>