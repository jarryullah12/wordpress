<div class="owt7-lms">

    <div class="owt7_library_list_bookcases">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span class="active"><?php _e("List Bookcase", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_bookcases&mod=bookcase&fn=add" class="btn"><?php _e("Add New Bookcase", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_bookcases&mod=section&fn=list" class="btn"><?php _e("List Section", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_bookcases&mod=section&fn=add" class="btn"><?php _e("Add New Section", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("List Bookcase", "library-management-system"); ?></h2>
            </div>

            <table class="owt7-lms-table" id="tbl_bookcases_list">
                <thead>
                    <tr>
                        <th><?php _e("Name", "library-management-system"); ?></th>
                        <th><?php _e("Total Section(s)", "library-management-system"); ?></th>
                        <th><?php _e("Status", "library-management-system"); ?></th>
                        <th><?php _e("Created at", "library-management-system"); ?></th>
                        <th><?php _e("Action", "library-management-system"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($params['bookcases']) && is_array($params['bookcases'])){
                            foreach($params['bookcases'] as $bookcase){
                                ?>
                                <tr>
                                    <td><?php echo ucwords($bookcase->name); ?></td>
                                    <td><?php echo $bookcase->total_sections; ?></td>
                                    <td>
                                        <?php if($bookcase->status){ ?>
                                        <a href="javascript:void(0);" class="action-btn view-btn">
                                            <?php _e("Active", "library-management-system"); ?>
                                        </a>
                                        <?php }else{ ?>
                                        <a href="javascript:void(0);" class="action-btn delete-btn">
                                            <?php _e("Inactive", "library-management-system"); ?>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $bookcase->created_at; ?></td>
                                    <td>
                                        <a href="admin.php?page=owt7_library_bookcases&mod=bookcase&fn=add&opt=view&id=<?php echo base64_encode($bookcase->id); ?>"
                                            title='<?php _e("View", "library-management-system"); ?>' class="action-btn view-btn">
                                            <span class="dashicons dashicons-visibility"></span>
                                        </a>
                                        <a href="admin.php?page=owt7_library_bookcases&mod=bookcase&fn=add&opt=edit&id=<?php echo base64_encode($bookcase->id); ?>"
                                            title='<?php _e("Edit", "library-management-system"); ?>' class="action-btn edit-btn">
                                            <span class="dashicons dashicons-edit"></span>
                                        </a>
                                        <a href="javascript:void(0);" title='<?php _e("Delete", "library-management-system"); ?>' class="action-btn delete-btn action-btn-delete"
                                            data-id="<?php echo base64_encode($bookcase->id) ?>"
                                            data-module="<?php echo base64_encode('bookcase'); ?>">
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