<?php 
if(!empty($params['users']) && is_array($params['users'])){
    foreach($params['users'] as $user){
        ?>
        <tr> 
            <td><?php echo $user->u_id; ?></td>
            <td><?php echo ucwords($user->name); ?></td>
            <td><?php echo !empty($user->email) ? $user->email : _e("<i>N/A</i>", "library-management-system"); ?></td>
            <td><?php echo !empty($user->branch_name) ? $user->branch_name : _e("<i>N/A</i>", "library-management-system"); ?></td>
            <td>
                <?php if($user->status){ ?>
                <a href="javascript:void(0);" class="action-btn view-btn">
                    <?php _e("Active", "library-management-system"); ?>
                </a>
                <?php }else{ ?>
                <a href="javascript:void(0);" class="action-btn delete-btn">
                    <?php _e("Inactive", "library-management-system"); ?>
                </a>
                <?php } ?>
            </td>
            <td><?php echo $user->created_at; ?></td>
            <td>
                <a href="admin.php?page=owt7_library_users&mod=user&fn=add&opt=view&id=<?php echo base64_encode($user->id); ?>" title="<?php _e("View", "library-management-system"); ?>" class="action-btn view-btn">
                    <span class="dashicons dashicons-visibility"></span>
                </a>
                <a href="admin.php?page=owt7_library_users&mod=user&fn=add&opt=edit&id=<?php echo base64_encode($user->id); ?>" title="<?php _e("Edit", "library-management-system"); ?>" class="action-btn edit-btn">
                    <span class="dashicons dashicons-edit"></span>
                </a>
                <a href="javascript:void(0);" title="<?php _e("Delete", "library-management-system"); ?>" class="action-btn delete-btn action-btn-delete" data-id="<?php echo base64_encode($user->id) ?>" data-module="<?php echo base64_encode('user'); ?>">
                    <span class="dashicons dashicons-trash"></span>
                </a>
            </td>
        </tr>
        <?php
    }
}
?>
