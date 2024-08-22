<?php 
if(!empty($params['borrows']) && is_array($params['borrows'])){
    foreach($params['borrows'] as $borrow){
        ?>
        <tr>
            <td><?php echo $borrow->borrow_id; ?></td>
            <td>
                <strong><?php _e('Branch', 'library-management-system'); ?>:</strong> <?php echo $borrow->branch_name; ?><br>
                <strong><?php _e('Name', 'library-management-system'); ?>:</strong> <?php echo $borrow->user_name; ?><br>
            </td>
            <td>
                <strong><?php _e('Category', 'library-management-system'); ?>:</strong>
                <?php echo $borrow->category_name; ?><br>
                <strong><?php _e('Name', 'library-management-system'); ?>:</strong> <?php echo $borrow->book_name; ?><br>
            </td>
            <td>
                <strong><?php _e('Days', 'library-management-system'); ?>:</strong> <?php echo $borrow->borrows_days; ?>
                <?php _e('days', 'library-management-system'); ?><br>
                <strong><?php _e('Issued on', 'library-management-system'); ?>:</strong>
                <?php echo date("Y-m-d", strtotime($borrow->created_at)); ?><br>
                <strong><?php _e('Return by', 'library-management-system'); ?>:</strong> <?php echo $borrow->return_date; ?><br>
            </td>
            <td>
                <?php if($borrow->status){ ?>
                <span class="action-btn delete-btn owt7_label_text">
                    <?php _e('Return Pending', 'library-management-system'); ?>
                </span>
                <?php }else{ ?>
                <span class="action-btn view-btn owt7_label_text">
                    <?php _e('Returned', 'library-management-system'); ?>
                </span>
                <?php } ?>
            </td>
            <td>
                <?php if($borrow->status){ ?>
                    <form action="javascript:void(0)" method="post" id="owt7_lms_return_book_<?php echo $borrow->id; ?>">
                        <?php wp_nonce_field( 'owt7_library_actions', 'owt7_lms_nonce' ); ?>
                        <input type="hidden" name="owt7_borrow_books_id[]" value="<?php echo $borrow->id; ?>">
                    </form>
                    <a href="javascript:void(0)" data-id="<?php echo $borrow->id; ?>"
                        class="action-btn edit-btn owt7_lms_btn_return <?php if(!$borrow->status){ echo 'input-mask-opacity'; } ?>">
                        <span class="dashicons dashicons-book"></span>
                        <?php _e('Return', 'library-management-system'); ?>
                    </a>
                <?php }else{ ?>
                    <a href="javascript:void(0);" title='<?php _e("Delete", "library-management-system"); ?>'
                        class="action-btn delete-btn action-btn-delete" data-id="<?php echo base64_encode($borrow->id) ?>"
                        data-module="<?php echo base64_encode('book_borrow'); ?>">
                        <span class="dashicons dashicons-trash"></span>
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php
        }
    } 
?>