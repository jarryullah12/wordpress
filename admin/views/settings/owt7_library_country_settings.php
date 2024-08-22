<div class="owt7-lms">

    <div class="owt7_lms_settings">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e('Library System', 'library-management-system'); ?> >> <span class="active"><?php _e('Country & Currency', 'library-management-system'); ?></span> </div>
            <div class="page-actions">
                <?php
                if(get_option( 'owt7_lms_country' )){
                    ?>
                    <a href="javascript:void(0)" id="owt7_lms_country_modal" class="btn"><span class="dashicons dashicons-admin-site"></span> <?php _e('Update Data', 'library-management-system'); ?></a>
                    <?php
                }else{
                    ?>
                    <a href="javascript:void(0)" id="owt7_lms_country_modal" class="btn"><span class="dashicons dashicons-admin-site"></span> <?php _e('Add Data', 'library-management-system'); ?></a>
                    <?php
                }
                ?>
                <a href="admin.php?page=owt7_library_settings" class="btn"><span class="dashicons dashicons-admin-generic"></span> <?php _e('All Settings', 'library-management-system'); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e('Country & Currency', 'library-management-system'); ?></h2>
            </div>

            <table class="owt7-lms-table">
                <thead>
                    <tr>
                        <th><?php _e('Country', 'library-management-system'); ?></th>
                        <th><?php _e('Currency', 'library-management-system'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        <span class="owt7_lms_settings_values">
                            <?php 
                                $country = get_option( 'owt7_lms_country' );
                                echo !empty($country) ? $country : "--"; 
                            ?>
                        </span>
                    </td>
                    <td>
                        <span class="owt7_lms_settings_values">
                            <?php 
                                $currency = get_option( 'owt7_lms_currency' );
                                echo !empty($currency) ? $currency : "--"; 
                            ?>
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
    $fileName = "owt7_mdl_country_settings";
    include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . "admin/views/settings/modals/{$fileName}.php";
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
    ?>
</div>
