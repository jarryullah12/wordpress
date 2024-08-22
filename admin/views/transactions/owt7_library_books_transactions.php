<div class="owt7-lms">

    <div class="lms-borrow-history">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?>  >> <span class="active"><?php _e("Book(s) Borrow History", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_transactions&mod=books&fn=borrow" class="btn"><?php _e("Borrow a Book", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_transactions&mod=books&fn=return" class="btn"><?php _e("Book(s) Return", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_transactions&mod=books&fn=return-history" class="btn"><?php _e("Book(s) Return History", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("Book(s) Borrow History", "library-management-system"); ?></h2>
            </div>

            <div class="filter-container">

                <label for="owt7_lms_filter"><?php _e("Filter by:", "library-management-system"); ?></label>

                <select data-list="borrow_history" data-table="owt7_lms_tbl_borrow_list" data-option="branch"
                    id="owt7_lms_dd_branch_filter" class="owt7_lms_dd_data_filter">
                    <option value=""><?php _e("-- Select Branch --", "library-management-system"); ?></option>
                    <?php 
                    if(!empty($params['branches']) && is_array($params['branches'])){
                        foreach($params['branches'] as $key => $branch){
                            ?>
                    <option value="<?php echo $branch->id; ?>"><?php echo ucfirst($branch->name); ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <select data-list="borrow_history" data-table="owt7_lms_tbl_borrow_list" data-option="category"
                    id="owt7_lms_dd_category_filter" class="owt7_lms_dd_data_filter">
                    <option value=""><?php _e("-- Select Category --", "library-management-system"); ?></option>
                    <?php 
                    if(!empty($params['categories']) && is_array($params['categories'])){
                        foreach($params['categories'] as $key => $category){
                            ?>
                    <option value="<?php echo $category->id; ?>"><?php echo ucfirst($category->name); ?>
                    </option>
                    <?php
                        }
                    }
                    ?>
                </select>

            </div>

            <table class="owt7-lms-table" id="tbl_books_borrow_history">
                <thead>
                    <tr>
                        <th><?php _e("Borrow ID", "library-management-system"); ?></th>
                        <th><?php _e("User Details", "library-management-system"); ?></th>
                        <th><?php _e("Book Details", "library-management-system"); ?></th>
                        <th><?php _e("Borrow Details (Y-m-d)", "library-management-system"); ?></th>
                        <th><?php _e("Status", "library-management-system"); ?></th>
                        <th><?php _e("Action", "library-management-system"); ?></th>
                    </tr>
                </thead>
                <tbody id="owt7_lms_tbl_borrow_list">
                    <?php
                        ob_start();
                        include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/transactions/templates/owt7_library_borrow_list.php';
                        $template = ob_get_contents();
                        ob_end_clean();
                        echo $template;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
