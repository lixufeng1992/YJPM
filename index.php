<?php
define('APP_DEBUG',TRUE);
define('NO_CACHE_RUNTIME',TRUE);
define('APP_NAME','./Yjpm');
//定义系统所需常量
define('ROOT_ROLEID',1);
define('ROOT_USERID',1);

define('PROJECT_EXPLORE',101);
define('PROJECT_MAINTAIN',102);
define('PROJECT_CONTRACT',103);
define('PROJECT_SCHEDULE_INPUT',104);
define('PROJECT_SCHEDULE_SHOW',105);
//define('MISSION_PLAN',106);

define('MATERIAL_MAINTAIN',201);
define('MATERIAL_ENQUIRY',202);
define('PURCHASE_PLAN_ORDER',203);
define('MATERIAL_CONTRACT',204);
define('MATERIAL_PURCHASE_ORDER',205);
define('MATERIAL_OUTBOUND_ORDER',206);
define('MATERIAL_INVENTORY',207);

define('SUBCONTRACT_MAINTAIN',301);

define('EMPLOYER_MAINTAIN',701);
define('DEPARTMENT_MAINTAIN',702);
define('POSITION_MAINTAIN',703);


define('ROLE_MAINTAIN',1001);
define('USER_MAINTAIN',1002);
define('ENTERPRISE_MAINTAIN',1003);
define('COMPANY_MAINTAIN',1004);
define('MANAGER_MAINTAIN',1005);
define('PROCESS_MAINTAIN',1006);
define('SUBCONTRACT_JOB_MAINTAIN',1007);
define('FINE_TYPE_MAINTAIN',1008);
define('COST_TYPE_MAINTAIN',1009);
define('PAY_METHOD_MAINTAIN',1010);
define('PAYER_BUYER_MAINTAIN',1011);
define('BANK_ACCOUNT_MAINTAIN',1012);
//define('SYSTEM_SETTING',1020);


require_once "ThinkPHP/ThinkPHP.php";
?>
