<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://onlinewebtutorblog.com/
 * @since      3.0.0
 *
 * @package    Library_Management_System
 * @subpackage Library_Management_System/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      3.0.0
 * @package    Library_Management_System
 * @subpackage Library_Management_System/includes
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Library_Management_System_Deactivator {

	private $table_activator;

    public function __construct($activator)
    {
        $this->table_activator = $activator;
    }
	
	/**
	 * @since    3.0.0
	 */
	public function deactivate() {

		global $wpdb;

        // Remove Options
        delete_option("owt7_library_version");
        delete_option("owt7_library_system");
		delete_option("owt7_library_db_tables");
        delete_option("owt7_lms_late_fine_currency");
        delete_option("owt7_lms_country");
        delete_option("owt7_lms_currency");

        // Table names
        $db_tables_array = array(
            $this->table_activator->owt7_library_tbl_branch(),
            $this->table_activator->owt7_library_tbl_users(),
            $this->table_activator->owt7_library_tbl_bookcase(),
            $this->table_activator->owt7_library_tbl_bookcase_sections(),
            $this->table_activator->owt7_library_tbl_category(),
            $this->table_activator->owt7_library_tbl_books(),
            $this->table_activator->owt7_library_tbl_book_borrow(),
            $this->table_activator->owt7_library_tbl_book_return(),
            $this->table_activator->owt7_library_tbl_book_late_fine()
        );

        // Tables drop
        foreach($db_tables_array as $table){
            $wpdb->query("DROP TABLE IF EXISTS " . $table);
        }
	}
}