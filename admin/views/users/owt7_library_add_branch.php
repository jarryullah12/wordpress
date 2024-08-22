<div class="owt7-lms">

    <div class="lms-add-branch">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span class="active"><?php _e("Add New Branch", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_users&mod=branch&fn=list" class="btn"><?php _e("List Branch", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_users&mod=user&fn=add" class="btn"><?php _e("Add New User", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_users" class="btn"><?php _e("List User", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <?php if(isset($params['action'])){ ?> <h2><?php echo ucfirst($params['action']) ?> <?php _e("Branch", "library-management-system"); ?></h2> <?php }else{ ?> <h2><?php _e("Add Branch", "library-management-system"); ?></h2> <?php } ?> 
            </div>

            <form class="owt7_lms_branch_form" id="owt7_lms_branch_form" action="javascript:void(0);" method="post">

                <?php wp_nonce_field( 'owt7_library_actions', 'owt7_lms_nonce' ); ?>
                <input type="hidden" name="action_type" value="<?php echo isset($params['action']) && !empty($params['action']) ? $params['action'] : 'add'; ?>">
                <?php 
                if(isset($params['action']) && $params['action'] == 'edit'){ 
                    ?>
                    <div class="form-row buttons-group">
                    <input type="hidden" name="edit_id" value="<?php echo isset($params['branch']['id']) ? $params['branch']['id'] : ''; ?>">
                    </div>
                    <?php
                } 
                ?>

                <div class="form-row">
                    <!-- Branch name -->
                    <div class="form-group">
                        <label for="owt7_txt_branch_name"><?php _e("Branch Name", "library-management-system"); ?> <span class="required">*</span></label>
                        <input value="<?php echo isset($params['branch']['name']) ? $params['branch']['name'] : ''; ?>" <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> type="text" id="owt7_txt_branch_name" required name="owt7_txt_branch_name"
                        placeholder="...">
                    </div>
                    <!-- Status -->
                    <div class="form-group">
                        <label for="owt7_dd_branch_status"><?php _e("Status", "library-management-system"); ?> <span class="required">*</span></label>
                        <select <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> required id="owt7_dd_branch_status" name="owt7_dd_branch_status" required>
                            <option value="">-- <?php _e("Select Status", "library-management-system"); ?> --</option>
                            <?php 
                            if(!empty($params['statuses']) && is_array($params['statuses'])){
                                foreach($params['statuses'] as $key => $status){
                                    $selected = "";
                                    if(isset($params['branch']['status']) && $params['branch']['status'] == $key){
                                        $selected = "selected";
                                    }
                                    ?>
                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo ucfirst($status); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <?php if(isset($params['action']) && $params['action'] == 'view'){ }else{ ?>                
                    <div class="form-row buttons-group">
                        <button class="btn submit-save-btn" type="submit"><?php _e("Submit & Save", "library-management-system"); ?></button>
                    </div>
                <?php } ?>

            </form>

        </div>
    </div>

</div>
