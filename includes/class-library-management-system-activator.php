<?php

/**
 * Fired during plugin activation
 *
 * @link       https://onlinewebtutorblog.com/
 * @since      3.0.0
 *
 * @package    Library_Management_System
 * @subpackage Library_Management_System/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      3.0.0
 * @package    Library_Management_System
 * @subpackage Library_Management_System/includes
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Library_Management_System_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    3.0.0
	 */
	public function activate() {
		// Plugin Tables
		$this->owt7_library_generate_plugin_tables();
		// Insert Table Data
		$this->owt7_library_insert_default_data();
		// Plugin Options
		$this->owt7_library_options();
	}

	private function owt7_library_generate_plugin_tables(){

		global $wpdb;

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // DB: "Users" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_users() . "'") != $this->owt7_library_tbl_users()) {
            
            $sqlUserTable = 'CREATE TABLE `' . $this->owt7_library_tbl_users() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `register_from` enum("web","admin") DEFAULT "admin",
                                    `u_id` VARCHAR(20) DEFAULT NULL, 
                                    `name` VARCHAR(20) DEFAULT NULL,
                                    `email` VARCHAR(80) DEFAULT NULL,
                                    `gender` enum("male","female","other") DEFAULT NULL, 
                                    `branch_id` int(5) DEFAULT NULL,
                                    `phone_no` VARCHAR(20) DEFAULT NULL,
                                    `profile_image` VARCHAR(220) DEFAULT NULL,
                                    `address_info` text,
                                    `status` int NOT NULL DEFAULT "1",
                                    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlUserTable);
        }

		// DB: "Books" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_books() . "'") != $this->owt7_library_tbl_books()) {
            
            $sqlBookTable = 'CREATE TABLE `' . $this->owt7_library_tbl_books() . '` (
									id INT NOT NULL AUTO_INCREMENT,
									book_id VARCHAR(20) DEFAULT NULL,
									bookcase_id INT(5) DEFAULT NULL,
									bookcase_section_id INT(5) DEFAULT NULL,
									category_id INT(5) DEFAULT NULL,
									name VARCHAR(120) DEFAULT NULL,
									author_name VARCHAR(150) DEFAULT NULL,
									publication_name VARCHAR(150) DEFAULT NULL,
									publication_year VARCHAR(10) DEFAULT NULL,
									publication_location VARCHAR(80) DEFAULT NULL,
									amount VARCHAR(10) DEFAULT NULL,
									cover_image VARCHAR(200) DEFAULT NULL,
									isbn VARCHAR(20) DEFAULT NULL,
									book_url VARCHAR(220) DEFAULT NULL,
									stock_quantity INT(5) DEFAULT NULL,
									book_language VARCHAR(50) DEFAULT NULL,
									book_pages INT(5) DEFAULT NULL,
									description TEXT,
									status INT NOT NULL DEFAULT "1",
									created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlBookTable);
        }

        // DB: "Bookcases" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_bookcase() . "'") != $this->owt7_library_tbl_bookcase()) {
            
            $sqlBookcaseTable = 'CREATE TABLE `' . $this->owt7_library_tbl_bookcase() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `name` VARCHAR(100) DEFAULT NULL,
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlBookcaseTable);
        }

        // DB: "Bookcase Sections" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_bookcase_sections() . "'") != $this->owt7_library_tbl_bookcase_sections()) {
            
            $sqlBookcaseSectionTable = 'CREATE TABLE `' . $this->owt7_library_tbl_bookcase_sections() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `name` VARCHAR(100) DEFAULT NULL,
                                    `bookcase_id` int(5) DEFAULT NULL,
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlBookcaseSectionTable);
        }

        // DB: "Branches" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_branch() . "'") != $this->owt7_library_tbl_branch()) {
            
            $sqlBranchTable = 'CREATE TABLE `' . $this->owt7_library_tbl_branch() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `name` VARCHAR(100) DEFAULT NULL,
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlBranchTable);
        }

        // DB: "Categories" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_category() . "'") != $this->owt7_library_tbl_category()) {
            
            $sqlCategoryTable = 'CREATE TABLE `' . $this->owt7_library_tbl_category() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `name` VARCHAR(100) DEFAULT NULL,
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlCategoryTable);
        }

        // DB: "Book Borrow" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_book_borrow() . "'") != $this->owt7_library_tbl_book_borrow()) {
            
            $sqlBookBorrowTable = 'CREATE TABLE `' . $this->owt7_library_tbl_book_borrow() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `borrow_id` VARCHAR(11) DEFAULT NULL,
                                    `category_id` int(5) DEFAULT NULL,
                                    `book_id` int(5) DEFAULT NULL,
                                    `branch_id` int(5) DEFAULT NULL,
                                    `u_id` int(5) DEFAULT NULL,
                                    `borrows_days` int(5) DEFAULT NULL,
                                    `return_date` VARCHAR(20) DEFAULT NULL,
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlBookBorrowTable);
        }

        // DB: "Book Return" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_book_return() . "'") != $this->owt7_library_tbl_book_return()) {
            
            $sqlBookReturnTable = 'CREATE TABLE `' . $this->owt7_library_tbl_book_return() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `borrow_id` VARCHAR(11) DEFAULT NULL,
                                    `category_id` int(5) DEFAULT NULL,
                                    `book_id` int(5) DEFAULT NULL,
                                    `branch_id` int(5) DEFAULT NULL,
                                    `u_id` int(5) DEFAULT NULL,
                                    `has_fine_status` enum("1","0") NOT NULL DEFAULT "0",
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlBookReturnTable);
        }

        // DB: "Return Late Fine" Table
        if ($wpdb->get_var("show tables like '" . $this->owt7_library_tbl_book_late_fine() . "'") != $this->owt7_library_tbl_book_late_fine()) {
            
            $sqlLateFineTable = 'CREATE TABLE `' . $this->owt7_library_tbl_book_late_fine() . '` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `return_id` int(5) DEFAULT NULL,
                                    `book_id` int(5) DEFAULT NULL,
                                    `u_id` int(5) DEFAULT NULL, 
                                    `extra_days` int(5) DEFAULT NULL,
                                    `fine_amount` int(5) DEFAULT NULL,
                                    `has_paid` enum("1","2") NOT NULL DEFAULT "1" COMMENT "1 - Not Paid, 2 - Paid",
                                    `status` enum("1","0") NOT NULL DEFAULT "1",
                                    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

            dbDelta($sqlLateFineTable);
        }
	}

	private function owt7_library_insert_default_data(){

    }
	
	private function owt7_library_options(){
        update_option("owt7_library_version", "3.0.0");
        update_option("owt7_library_system", serialize([
            "lms" => "free"
        ]));
        update_option("owt7_library_db_tables", serialize([
            $this->owt7_library_tbl_branch(),
            $this->owt7_library_tbl_users(),
            $this->owt7_library_tbl_bookcase(),
            $this->owt7_library_tbl_bookcase_sections(),
            $this->owt7_library_tbl_category(),
            $this->owt7_library_tbl_books(),
            $this->owt7_library_tbl_book_borrow(),
            $this->owt7_library_tbl_book_return(),
            $this->owt7_library_tbl_book_late_fine()
        ]));
        update_option("owt7_lms_late_fine_currency", "1");
        update_option("owt7_lms_country", "India");
        update_option("owt7_lms_currency", "INR");
	}

	// Helper functions: Return table names

    public function owt7_library_tbl_users(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_users";
    }

	public function owt7_library_tbl_books() {
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_books";
    }

    public function owt7_library_tbl_bookcase(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_bookcase";
    }

    public function owt7_library_tbl_bookcase_sections(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_bookcase_sections";
    }

    public function owt7_library_tbl_branch(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_branch";
    }

    public function owt7_library_tbl_category(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_category";
    }

    public function owt7_library_tbl_book_borrow(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_book_borrow";
    }

    public function owt7_library_tbl_book_return(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_return_book";
    }

    public function owt7_library_tbl_book_late_fine(){
        global $wpdb;
        return $wpdb->prefix . "owt7_lib_late_fine";
    }
	
    // ...
}