<div class="owt7-lms">
    <div class="page-header">
        <div class="breadcrumb">
            <?php _e('Library System', 'library-management-system'); ?> >>
            <span class="active">
                <?php _e('Settings', 'library-management-system'); ?>
            </span>
        </div>
        <div class="page-actions">
            <?php
            $alreadyAvailable = get_option( 'owt7_lms_test_data' );
            if(!empty($alreadyAvailable)){
                ?>
                <a href="javascript:void(0)" id="owt7_lms_run_data_importer" class="btn input-mask-opacity">
                    <span class="dashicons dashicons-backup"></span>
                    <?php _e("Run Test Data Importer", "library-management-system"); ?>
                </a>
                <a href="javascript:void(0)" id="owt7_lms_refresh_test_data"><?php _e("Refresh it?", "library-management-system"); ?></a>
                <a href="javascript:void(0)" id="owt7_lms_remove_test_data"><?php _e("Remove Test Data?", "library-management-system"); ?></a>
                <?php
            }else{
                ?>
                <a href="javascript:void(0)" id="owt7_lms_run_data_importer" class="btn">
                    <span class="dashicons dashicons-backup"></span>
                    <?php _e("Run Test Data Importer", "library-management-system"); ?>
                </a>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="page-container lms-settings">

        <div class="lms-dashboard card-container">
            <!-- Card 1 -->
            <div class="card">
                <span class="dashicons dashicons-admin-site"></span>
                <h2><?php _e('Set Country & Currency', 'library-management-system'); ?></h2>
                <a href="admin.php?page=owt7_library_settings&mod=country"
                    class="owt7-lms-anc-settings"><?php _e('Configure Settings', 'library-management-system'); ?></a>
            </div>
            <!-- Card 2 -->
            <div class="card">
                <span class="dashicons dashicons-tag"></span>
                <h2><?php _e('Set Late Fine', 'library-management-system'); ?></h2>
                <a href="admin.php?page=owt7_library_settings&mod=late_fine"
                    class="owt7-lms-anc-settings"><?php _e('View Settings', 'library-management-system'); ?></a>
            </div>
        </div>
    </div>
</div>