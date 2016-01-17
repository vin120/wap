<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminService
 *
 * @author Rock.Lei
 */
class AdminService
{
    public static function addAdmin($vcosAdmin){
        $vcosAdminModel = new VcosAdmin();
        $vcosAdminModel->admin_name = $vcosAdmin->admin_name;
        $vcosAdminModel->admin_password = $vcosAdmin->admin_password;
        $vcosAdminModel->role_id = $vcosAdmin->role_id;
        $vcosAdminModel->real_name = $vcosAdmin->real_name;
        $vcosAdminModel->admin_email = $vcosAdmin->admin_email;
        $vcosAdminModel->admin_post = $vcosAdmin->admin_post;
        $vcosAdminModel->admin_state = $vcosAdmin->admin_state;
        $vcosAdminModel->save();
    }
    public static function editAdmin(VcosAdmin $vcosAdmin){
        $vcosAdminModel = VcosAdmin::model()->findByPk($vcosAdmin->admin_id);
        $vcosAdminModel->admin_name = $vcosAdmin->admin_name;
        $vcosAdminModel->role_id = $vcosAdmin->role_id;
        $vcosAdminModel->real_name = $vcosAdmin->real_name;
        $vcosAdminModel->admin_email = $vcosAdmin->admin_email;
        $vcosAdminModel->admin_post = $vcosAdmin->admin_post;
        $vcosAdminModel->admin_state = $vcosAdmin->admin_state;
        
        $vcosAdminModel->update();
    }
    public static function delAdmin(VcosAdmin $vcosAdmin){
        $vcosAdminModel=VcosAdmin::model()->findByPk($vcosAdmin->admin_id);
        $vcosAdminModel->delete();
    }
}
?>
