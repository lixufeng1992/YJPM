<?php
import("@.Model.CommonDao");
class ProjectDao extends CommonDao
{
    
    // find-----------------------------------------------------------------
    public function findAll()
    {
       
        $sql = "select * from tb_project order by id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }
    
    // 按id号查找工程
    // 返回-1表示查找失败
    public function findById($id)
    {
        $sql = "select * from tb_project where id = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array($id));
        $projectRow = $statement->fetch();
        if (is_null($projectRow[0]))return - 1;
        return $projectRow;
    }
    // find===========================================================================
    
    // add------------------------------------------------------------------------------------------
    // 返回-1表示插入失败 成功则返回表中的id号
    public function add(
        $name, 
        $currentstatusid, 
        $clerk_personid, 
        $build_enterpriseid, 
        $design_enterpriseid, 
        $construct_enterpriseid, 
        $mediator_enterpriseid, 
        $mediator_constract, 
        $project_address, 
        $project_type, 
        $constract_counterparty, 
        $a_project_director_personid, 
        $a_technology_director_personid, 
        $constructunit_director_personid, 
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
        $drawback)
    {
       
        $sql = "insert into tb_project (
            name, 
            currentstatusid, 
            clerk_personid, 
            build_enterpriseid, 
            design_enterpriseid, 
            construct_enterpriseid, 
            mediator_enterpriseid, 
            mediator_constract, 
            project_address, 
            project_type, 
            constract_counterparty, 
            a_project_director_personid, 
            a_technology_director_personid, 
            constructunit_director_personid, 
            biddoc_type, 
            getbid_price, 
            use_purpose, 
            covered_area, 
            info_source, 
            scale, 
            project_basic_info, 
            isknown_bid_date, 
            isknown_questionanswer_date, 
            isknown_submitbiddoc_date, 
            isknown_startbid_date, 
            isknown_margin_date, 
            advantage, 
            drawback) 
            values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $name, 
            $currentstatusid, 
            $clerk_personid, 
            $build_enterpriseid, 
            $design_enterpriseid, 
            $construct_enterpriseid, 
            $mediator_enterpriseid, 
            $mediator_constract, 
            $project_address, 
            $project_type, 
            $constract_counterparty, 
            $a_project_director_personid, 
            $a_technology_director_personid, 
            $constructunit_director_personid, 
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
    public function deleteById($id)
    {
       
        $sql = "delete from tb_project where id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $id
        ));
    }
    
    // delete===============================================================================
    
   
    public function updateById(
        $id,
        $name, 
        $currentstatusid, 
        $clerk_personid, 
        $build_enterpriseid, 
        $design_enterpriseid, 
        $construct_enterpriseid, 
        $mediator_enterpriseid, 
        $mediator_constract, 
        $project_address, 
        $project_type, 
        $constract_counterparty, 
        $a_project_director_personid, 
        $a_technology_director_personid, 
        $constructunit_director_personid, 
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
        $drawback)
    {
        $sql = "update tb_project set
            name=?, 
            currentstatusid=?, 
            clerk_personid=?, 
            build_enterpriseid=?, 
            design_enterpriseid=?, 
            construct_enterpriseid=?, 
            mediator_enterpriseid=?, 
            mediator_constract=?, 
            project_address=?, 
            project_type=?, 
            constract_counterparty=?, 
            a_project_director_personid=?, 
            a_technology_director_personid=?, 
            constructunit_director_personid=?, 
            biddoc_type=?, 
            getbid_price=?, 
            use_purpose=?, 
            covered_area=?, 
            info_source=?, 
            scale=?, 
            project_basic_info=?, 
            isknown_bid_date=?, 
            isknown_questionanswer_date=?, 
            isknown_submitbiddoc_date=?, 
            isknown_startbid_date=?, 
            isknown_margin_date=?, 
            advantage=?, 
            drawback=?
            where id=?";

        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $name, 
            $currentstatusid, 
            $clerk_personid, 
            $build_enterpriseid, 
            $design_enterpriseid, 
            $construct_enterpriseid, 
            $mediator_enterpriseid, 
            $mediator_constract, 
            $project_address, 
            $project_type, 
            $constract_counterparty, 
            $a_project_director_personid, 
            $a_technology_director_personid, 
            $constructunit_director_personid, 
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
            $id
        ));
    }
       
    // 项目资源导入
    // public function findALL_0_1_2_3_4_5()
    // {
       
    //     $sql = "select id,name,currentstatusid,clerkname,build_enterpriseid,design_enterpriseid from tb_project order by id asc";
    //     $statement = $this->commonPDO->query($sql);
    //     return $statement->fetchAll();
    // }
}

?>
