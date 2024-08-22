<div class="owt7-lms">

    <div class="lms-list-branch">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span class="active"><?php _e("List Branch", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_users&mod=branch&fn=add" class="btn"><?php _e("Add User Branch", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_users&mod=user&fn=add" class="btn"><?php _e("Add New User", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_users" class="btn"><?php _e("List User", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("Branch List", "library-management-system"); ?></h2>
            </div>

            <table class="owt7-lms-table" id="tbl_branches_list">
                <thead>
                    <tr>
                        <th><?php _e("S No", "library-management-system"); ?></th>
                        <th><?php _e("Name", "library-management-system"); ?></th>
                        <th><?php _e("Total User(s)", "library-management-system"); ?></th>
                        <th><?php _e("Status", "library-management-system"); ?></th>
                        <th><?php _e("Created at", "library-management-system"); ?></th>
                        <th><?php _e("Action", "library-management-system"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($params['branches']) && is_array($params['branches'])){
                            foreach($params['branches'] as $branch){
                                ?>
                    <tr>
                        <td><?php echo $branch->id; ?></td>
                        <td><?php echo ucwords($branch->name); ?></td>
                        <td><?php echo $branch->total_users; ?></td>
                        <td>
                            <?php if($branch->status){ ?>
                            <a href="javascript:void(0);" class="action-btn view-btn">
                                <?php _e("Active", "library-management-system"); ?>
                            </a>
                            <?php }else{ ?>
                            <a href="javascript:void(0);" class="action-btn delete-btn">
                                <?php _e("Inactive", "library-management-system"); ?>
                            </a>
                            <?php } ?>
                        </td>
                        <td><?php echo $branch->created_at; ?></td>
                        <td>
                            <a href="admin.php?page=owt7_library_users&mod=branch&fn=add&opt=view&id=<?php echo base64_encode($branch->id); ?>"
                                title="<?php _e("View", "library-management-system"); ?>" class="action-btn view-btn">
                                <span class="dashicons dashicons-visibility"></span>
                            </a>
                            <a href="admin.php?page=owt7_library_users&mod=branch&fn=add&opt=edit&id=<?php echo base64_encode($branch->id); ?>"
                                title="<?php _e("Edit", "library-management-system"); ?>" class="action-btn edit-btn">
                                <span class="dashicons dashicons-edit"></span>
                            </a>
                            <a href="javascript:void(0);" title="<?php _e("Delete", "library-management-system"); ?>" class="action-btn delete-btn action-btn-delete"
                                data-id="<?php echo base64_encode($branch->id) ?>"
                                data-module="<?php echo base64_encode('branch'); ?>">
                                <span class="dashicons dashicons-trash"></span>
                            </a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
