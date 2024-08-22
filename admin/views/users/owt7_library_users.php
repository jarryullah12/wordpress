<div class="owt7-lms">

    <div class="lms-list-user">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span class="active"><?php _e("List User", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_users&mod=branch&fn=add" class="btn"><?php _e("Add User Branch", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_users&mod=branch&fn=list" class="btn"><?php _e("List Branch", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_users&mod=user&fn=add" class="btn"><?php _e("Add New User", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("User(s) List", "library-management-system"); ?></h2>
            </div>

            <div class="filter-container">
                <label for="owt7_lms_branch_filter"><?php _e("Filter by:", "library-management-system"); ?></label>
                <select data-module="users" data-filter-by="branch" id="owt7_lms_data_filter" class="owt7_lms_data_filter">
                    <option value=""><?php _e("-- Select Branch --", "library-management-system"); ?></option>
                    <option value="all"><?php _e("All", "library-management-system"); ?></option>
                    <?php 
                    if(!empty($params['branches']) && is_array($params['branches'])){
                        foreach($params['branches'] as $branch){
                            ?>
                            <option value="<?php echo $branch->id; ?>"><?php echo ucfirst($branch->name); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <table class="owt7-lms-table" id="tbl_users_list">
                <thead>
                    <tr>
                        <th><?php _e("User ID", "library-management-system"); ?></th>
                        <th><?php _e("Name", "library-management-system"); ?></th>
                        <th><?php _e("Email", "library-management-system"); ?></th>
                        <th><?php _e("Branch", "library-management-system"); ?></th>
                        <th><?php _e("Status", "library-management-system"); ?></th>
                        <th><?php _e("Created at", "library-management-system"); ?></th>
                        <th><?php _e("Action", "library-management-system"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        ob_start();
                        include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/users/templates/owt7_library_users_list.php';
                        $template = ob_get_contents();
                        ob_end_clean();
                        echo $template;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
