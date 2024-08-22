<?php 

if(!empty($params['sections']) && is_array($params['sections'])){
    
    foreach($params['sections'] as $section){
        ?>
        <tr>
            <td><?php echo ucwords($section->bookcase_name); ?></td>
            <td><?php echo ucwords($section->name) ?></td>
            <td>
                <?php if($section->status){ ?>
                <a href="javascript:void(0);" class="action-btn view-btn">
                    <?php _e("Active", "library-management-system"); ?>
                </a>
                <?php }else{ ?>
                <a href="javascript:void(0);" class="action-btn delete-btn">
                    <?php _e("Inactive", "library-management-system"); ?>
                </a>
                <?php } ?>
            </td>
            <td><?php echo $section->created_at; ?></td>
            <td>
                <a href="admin.php?page=owt7_library_bookcases&mod=section&fn=add&opt=view&id=<?php echo base64_encode($section->id); ?>"
                    title="<?php _e('View', 'library-management-system'); ?>" class="action-btn view-btn">
                    <span class="dashicons dashicons-visibility"></span>
                </a>
                <a href="admin.php?page=owt7_library_bookcases&mod=section&fn=add&opt=edit&id=<?php echo base64_encode($section->id); ?>"
                    title="<?php _e('Edit', 'library-management-system'); ?>" class="action-btn edit-btn">
                    <span class="dashicons dashicons-edit"></span>
                </a>
                <a href="javascript:void(0);" title="<?php _e('Delete', 'library-management-system'); ?>" class="action-btn delete-btn action-btn-delete"
                    data-id="<?php echo base64_encode($section->id) ?>"
                    data-module="<?php echo base64_encode('section'); ?>">
                    <span class="dashicons dashicons-trash"></span>
                </a>
            </td>
        </tr>
    <?php
    }
}
?>
