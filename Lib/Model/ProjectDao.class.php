<?php

class ProjectDao extends Model
{
    
    // find-----------------------------------------------------------------
    public function findAll()
    {
       
        $sql = "select * from tb_project order by projectid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }
    
    // 按id号查找工程
    // 返回-1表示查找失败
    public function findById($projectid)
    {
        
        $sql = "select count(*) from tb_project where projectid = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $projectid
        ));
        $result = $statement->fetch();
        if ($result[0] == 0)
            return - 1;
        
        $sql = "select * from tb_project where projectid = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $projectid
        ));
        $projectrow = $statement->fetch();
        return $projectrow;
    }
    // find===========================================================================
    
    // add------------------------------------------------------------------------------------------
    // 返回-1表示插入失败 成功则返回表中的id号
    public function add($projectname, $currentstatusid, $clerkname, $build_enterpriseid, $design_enterpriseid, $construct_enterpriseid, $mediator_enterpriseid, $mediator_constract, $project_address, $project_type, $constract_counterparty, $a_project_director_name, $a_project_director_phone, $a_technology_director_name, $a_technology_director_phone, $constructunit_director_name, $constructunit_director_phone, $biddoc_type, $getbid_price, $use_purpose, $covered_area, $info_source, $scale, $project_basic_info, $isknown_bid_date, $isknown_questionanswer_date, $isknown_submitbiddoc_date, $isknown_startbid_date, $isknown_margin_date, $advantage, $drawback)
    {
       
        
        $sql = "insert into tb_project (projectname,currentstatusid,clerkname,build_enterpriseid,design_enterpriseid,
						construct_enterpriseid,mediator_enterpriseid,mediator_constract,project_address,project_type,
						constract_counterparty,a_project_director_name,a_project_director_phone,a_technology_director_name,a_technology_director_phone,
						constructunit_director_name,constructunit_director_phone,biddoc_type,getbid_price,use_purpose,
						covered_area,info_source,scale,project_basic_info,isknown_bid_date,
						isknown_questionanswer_date,isknown_submitbiddoc_date,isknown_startbid_date,isknown_margin_date,advantage,
						drawback) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $projectname,
            $currentstatusid,
            $clerkname,
            $build_enterpriseid,
            $design_enterpriseid,
            $construct_enterpriseid,
            $mediator_enterpriseid,
            $mediator_constract,
            $project_address,
            $project_type,
            $constract_counterparty,
            $a_project_director_name,
            $a_project_director_phone,
            $a_technology_director_name,
            $a_technology_director_phone,
            $constructunit_director_name,
            $constructunit_director_phone,
            $biddoc_type,
            $getbid_price,
            $use_purpose,
            $covered_area,
            $info_source,
            $scale,
            $project_basic_info,
            $isknown_bid_date,
            $isknown_questionanswer_date,
            $isknown_submitbiddoc_date,
            $isknown_startbid_date,
            $isknown_margin_date,
            $advantage,
            $drawback
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }
    // add====================================================================================
    
    // delete---------------------------------------------------------------------------------
    public function deleteById($projectid)
    {
       
        $sql = "delete from tb_project where projectid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $projectid
        ));
    }
    
    // delete===============================================================================
    
   
    public function updateById($projectid, $projectname, $currentstatusid, $clerkname, $build_enterpriseid, $design_enterpriseid, $construct_enterpriseid, $mediator_enterpriseid, $mediator_constract, $project_address, $project_type, $constract_counterparty, $a_project_director_name, $a_project_director_phone, $a_technology_director_name, $a_technology_director_phone, $constructunit_director_name, $constructunit_director_phone, $biddoc_type, $getbid_price, $use_purpose, $covered_area, $info_source, $scale, $project_basic_info, $isknown_bid_date, $isknown_questionanswer_date, $isknown_submitbiddoc_date, $isknown_startbid_date, $isknown_margin_date, $advantage, $drawback)
    {
        
        $sql = "update tb_project set projectname=?,currentstatusid=?,clerkname=?,build_enterpriseid=?,design_enterpriseid=?,
						construct_enterpriseid=?,mediator_enterpriseid=?,mediator_constract=?,project_address=?,project_type=?,
						constract_counterparty=?,a_project_director_name=?,a_project_director_phone=?,a_technology_director_name=?,a_technology_director_phone=?,
						constructunit_director_name=?,constructunit_director_phone=?,biddoc_type=?,getbid_price=?,use_purpose=?,
						covered_area=?,info_source=?,scale=?,project_basic_info=?,isknown_bid_date=?,
						isknown_questionanswer_date=?,isknown_submitbiddoc_date=?,isknown_startbid_date=?,isknown_margin_date=?,advantage=?,
						drawback=? where projectid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $projectname,
            $currentstatusid,
            $clerkname,
            $build_enterpriseid,
            $design_enterpriseid,
            $construct_enterpriseid,
            $mediator_enterpriseid,
            $mediator_constract,
            $project_address,
            $project_type,
            $constract_counterparty,
            $a_project_director_name,
            $a_project_director_phone,
            $a_technology_director_name,
            $a_technology_director_phone,
            $constructunit_director_name,
            $constructunit_director_phone,
            $biddoc_type,
            $getbid_price,
            $use_purpose,
            $covered_area,
            $info_source,
            $scale,
            $project_basic_info,
            $isknown_bid_date,
            $isknown_questionanswer_date,
            $isknown_submitbiddoc_date,
            $isknown_startbid_date,
            $isknown_margin_date,
            $advantage,
            $drawback,
            $projectid
        ));
    }
       
    // 项目资源导入
    public function findALL_0_1_2_3_4_5()
    {
       
        $sql = "select projectid,projectname,currentstatusid,clerkname,build_enterpriseid,design_enterpriseid from tb_project order by projectid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }
}

?>
