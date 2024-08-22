<div class="owt7-lms">

    <div class="owt7_library_list_books">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span
                    class="active"><?php _e("List Book", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_books&mod=category&fn=add"
                    class="btn"><?php _e("Add New Category", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_books&mod=category&fn=list"
                    class="btn"><?php _e("List Category", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_books&mod=book&fn=add"
                    class="btn"><?php _e("Add New Book", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("Book List", "library-management-system"); ?></h2>
            </div>

            <div class="filter-container">
                <label for="owt7_lms_category_filter"><?php _e("Filter by:", "library-management-system"); ?></label>
                <select data-module="books" data-filter-by="category" id="owt7_lms_data_filter" class="owt7_lms_data_filter">
                    <option value=""><?php _e("-- Select Category --", "library-management-system"); ?></option>
                    <option value="all"><?php _e("-- All --", "library-management-system"); ?></option>
                    <?php 
                    if(!empty($params['categories']) && is_array($params['categories'])){
                        foreach($params['categories'] as $category){
                            ?>
                            <option value="<?php echo $category->id; ?>"><?php echo ucfirst($category->name); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <table class="owt7-lms-table" id="tbl_books_list">
                <thead>
                    <tr>
                        <th><?php _e("Book ID", "library-management-system"); ?></th>
                        <th><?php _e("Basic Details", "library-management-system"); ?></th>
                        <th><?php _e("Name", "library-management-system"); ?></th>
                        <th><?php _e("Stock Quantity", "library-management-system"); ?></th>
                        <th><?php _e("Status", "library-management-system"); ?></th>
                        <th><?php _e("Action", "library-management-system"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        ob_start();
                        include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/books/templates/owt7_library_books_list.php';
                        $template = ob_get_contents();
                        ob_end_clean();
                        echo $template;
                    ?>
                </tbody>
            </table>

        </div>
    </div>