<?php

if (!empty($params['books']) && is_array($params['books'])) {
    foreach ($params['books'] as $book) {
        ?>
        <tr>
            <td><?php echo $book->book_id ?></td>
            <td>
                <strong><?php _e("Category", "library-management-system"); ?>:</strong> <span><?php echo $book->category_name; ?></span><br>
                <strong><?php _e("Bookcase", "library-management-system"); ?>:</strong> <span><?php echo $book->bookcase_name; ?></span><br>
                <strong><?php _e("Section", "library-management-system"); ?>:</strong> <span><?php echo $book->section_name; ?></span>
            </td>
            <td><?php echo ucwords($book->name) ?></td>
            <td><?php echo intval($book->stock_quantity) ?></td>
            <td>
                <?php if ($book->status) { ?>
                    <a href="javascript:void(0);" class="action-btn view-btn">
                        <?php _e("Active", "library-management-system"); ?>
                    </a>
                <?php } else { ?>
                    <a href="javascript:void(0);" class="action-btn delete-btn">
                        <?php _e("Inactive", "library-management-system"); ?>
                    </a>
                <?php } ?>
            </td>
            <td>
                <a href="admin.php?page=owt7_library_books&mod=book&fn=add&opt=view&id=<?php echo base64_encode($book->id); ?>"
                   title='<?php _e("View", "library-management-system"); ?>' class="action-btn view-btn">
                    <span class="dashicons dashicons-visibility"></span>
                </a>
                <a href="admin.php?page=owt7_library_books&mod=book&fn=add&opt=edit&id=<?php echo base64_encode($book->id); ?>"
                   title='<?php _e("Edit", "library-management-system"); ?>' class="action-btn edit-btn">
                    <span class="dashicons dashicons-edit"></span>
                </a>
                <a href="javascript:void(0);" title='<?php _e("Delete", "library-management-system"); ?>'
                   class="action-btn delete-btn action-btn-delete" data-id="<?php echo base64_encode($book->id) ?>"
                   data-module="<?php echo base64_encode('book'); ?>">
                    <span class="dashicons dashicons-trash"></span>
                </a>
            </td>
        </tr>
        <?php
    }
}
?>
