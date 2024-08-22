<div class="owt7-lms">

    <div class="owt7_lms_settings">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e('Library System', 'library-management-system'); ?> >> <span
                    class="active"><?php _e('Late Fine', 'library-management-system'); ?></span> </div>
            <div class="page-actions">
                <?php if(!empty(get_option( 'owt7_lms_late_fine_currency' ))){ ?>
                <a href="javascript:void(0)" id="owt7_lms_fine_modal" class="btn"><span
                        class="dashicons dashicons-plus-alt"></span>
                    <?php _e('Update Late Fine', 'library-management-system'); ?></a>
                <?php } else { ?>
                <a href="javascript:void(0)" id="owt7_lms_fine_modal" class="btn"><span
                        class="dashicons dashicons-plus-alt"></span>
                    <?php _e('Set Late Fine', 'library-management-system'); ?></a>
                <?php } ?>

                <a href="admin.php?page=owt7_library_settings" class="btn"><span
                        class="dashicons dashicons-admin-generic"></span>
                    <?php _e('All Settings', 'library-management-system'); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e('Late Fine', 'library-management-system'); ?></h2>
            </div>

            <table class="owt7-lms-table">
                <thead>
                    <tr>
                        <th><?php _e('Fine Amount', 'library-management-system'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        <span class="owt7_lms_settings_values">
                            <?php 
                                $late_fine = get_option( 'owt7_lms_late_fine_currency' );
                                echo $late_fine; 
                            ?>
                            <strong>
                                <?php 
                                $currency = get_option( 'owt7_lms_currency' );
                                if(!empty($currency)){
                                    echo $currency;
                                }else{
                                    echo !empty($late_fine) ? _e("(Currency Unknown)", 'library-management-system') : "--"; 
                                }
                                ?>
                            </strong>
                        </span>
                    </td>
                </tbody>
            </table>
        </div>
    </div>

</div>


<div class="owt7_lms_modal_section">
    <?php
    ob_start();
    $fileName = "owt7_mdl_late_fine_settings";
    include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . "admin/views/settings/modals/{$fileName}.php";
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
    ?>
</div>