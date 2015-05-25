$().ready(function(){
    $("#addSubcontract").validate({
        rules:{
           name:{
                required:true
            },
            contract_number:{
                required:true,
                minlength:6
            },
            contract_type:{
                required:true
            },
            a_part_enterprise_name:{
                required:true
            },
            b_part_enterprise_name:{
                required:true
            },
            a_part_enterpriseid:{
                required:true
            },
            b_part_enterpriseid:{
                required:true
            }

            // total_quantities:{
            //     number:true
            // },
            // a_part_enterpriseid:{
            //     required:true
            // },
            // b_part_enterpriseid:{
            //     required:true
            // },
            // main_content:{
            //     required:true
            // },
            // accept_amount_start:{
            //     number:true
            // },
            // budget_amount:{
            //     number:true
            // },
            // budget_confirm_amount:{
            //     number:true
            // },
            // finalcost_amount:{
            //     number:true
            // },
            // finalcost_confirm_amount:{
            //     number:true
            // },
            // audit_amount:{
            //     number:true
            // },
            // audit_confirm_amount:{
            //     number:true
            // },
            // audit_qualityassurance_amount:{
            //     number:true
            // },
            // contract_amount_money:{
            //     number:true
            // }
        },
        ignore:"",
        errorElement:"div",
        errorPlacement:function(error,element){
            if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
                element.parent().append(error);
            }else{
                error.insertAfter(element);
            }
        }
    });
});