<?php 
    if(!empty($params['returns']) && is_array($params['returns'])){
        foreach($params['returns'] as $return){
            ?>
    <tr>
        <td><?php echo $return->id; ?></td>
        <td>
            <strong><?php _e('Branch', 'library-management-system'); ?>:</strong> <?php echo $return->branch_name; ?><br>
            <strong><?php _e('Name', 'library-management-system'); ?>:</strong> <?php echo $return->user_name; ?><br>
        </td>
        <td>
            <strong><?php _e('Category', 'library-management-system'); ?>:</strong> <?php echo $return->category_name; ?><br>
            <strong><?php _e('Name', 'library-management-system'); ?>:</strong> <?php echo $return->book_name; ?><br>
        </td>
        <td>
            <strong><?php _e('Borrow ID', 'library-management-system'); ?>:</strong> <?php echo $return->borrow_id; ?><br>
            <strong><?php _e('Total Days', 'library-management-system'); ?>:</strong> <?php echo $return->total_days; ?> <?php _e('Days', 'library-management-system'); ?><br>
            <strong><?php _e('Issued', 'library-management-system'); ?>:</strong> <?php echo date("Y-m-d", strtotime($return->issued_on)); ?><br>
            <strong><?php _e('Returned', 'library-management-system'); ?>:</strong> <?php echo date("Y-m-d", strtotime($return->created_at)); ?><br>
        </td>
        <td>
            <?php 
            if($return->status && $return->has_paid == 1){ 
            ?>
            <span class="owt7_late_fine_text"><?php _e("User has to <u>Pay Fine</u>", "library-management-system") ?></span>
            <span class="owt7_late_fine_text"><?php _e("Total Extra", "library-management-system") ?>: <u><?php echo $return->extra_days . " " . __("days", 'library-management-system'); ?></u></span>
            <span class="owt7_late_fine_text"><?php _e("Total Fine", "library-management-system") ?>: <u><?php echo $return->fine_amount ." ". get_option( 'owt7_lms_currency' ); ?></u></span>
            <?php }else{ ?>
                <span class="action-btn view-btn owt7_label_text">
                    <?php _e('No fine', 'library-management-system'); ?>
                </span>
            <?php } ?>
        </td>
        <td>
            <?php if($return->status && $return->has_paid == 1){ ?> 
                <a href="javascript:void(0);" title='<?php _e("Pay Fine", "library-management-system"); ?>'
                    class="action-btn delete-btn owt7_pay_late_fine" data-id="<?php echo base64_encode($return->id) ?>">
                    <span class="dashicons dashicons-info"></span> Pay Fine
                </a>
            <?php }else{ ?>
                <a href="javascript:void(0);" title='<?php _e("Delete", "library-management-system"); ?>'
                    class="action-btn delete-btn action-btn-delete" data-id="<?php echo base64_encode($return->id) ?>"
                    data-module="<?php echo base64_encode('book_return'); ?>">
                    <span class="dashicons dashicons-trash"></span>
                </a>
            <?php } ?>
        </td>
    </tr>
    <?php
        }
    } 
?>
