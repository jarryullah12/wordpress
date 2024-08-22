<div class="owt7-lms">

    <div class="owt7_library_list_sections">

        <div class="page-header">
            <div class="breadcrumb">
                <?php _e("Library System", "library-management-system"); ?> >>
                <span class="active"><?php _e("List Section", "library-management-system"); ?></span>
            </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_bookcases&mod=bookcase&fn=add" class="btn"><?php _e("Add New Bookcase", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_bookcases" class="btn"><?php _e("List Bookcase", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_bookcases&mod=section&fn=add" class="btn"><?php _e("Add New Section", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("List Section", "library-management-system"); ?></h2>
            </div>

            <div class="filter-container">
                <label for="owt7_lms_data_filter"><?php _e("Filter by:", "library-management-system"); ?></label>
                <select data-module="sections" data-filter-by="bookcase" id="owt7_lms_data_filter" class="owt7_lms_data_filter">
                    <option value=""><?php _e("-- Select Bookcase --", "library-management-system"); ?></option>
                    <option value="all"><?php _e("All", "library-management-system"); ?></option>
                    <?php 
                    if(!empty($params['bookcases']) && is_array($params['bookcases'])){
                        foreach($params['bookcases'] as $bookcase){
                            ?>
                            <option value="<?php echo $bookcase->id; ?>"><?php echo ucfirst($bookcase->name); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <table class="owt7-lms-table" id="tbl_sections_list">
                <thead>
                    <tr>
                        <th><?php _e("Bookcase", "library-management-system"); ?></th>
                        <th><?php _e("Name", "library-management-system"); ?></th>
                        <th><?php _e("Status", "library-management-system"); ?></th>
                        <th><?php _e("Created at", "library-management-system"); ?></th>
                        <th><?php _e("Action", "library-management-system"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        ob_start();
                        include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/bookcases/templates/owt7_library_sections_list.php';
                        $template = ob_get_contents();
                        ob_end_clean();
                        echo $template;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
