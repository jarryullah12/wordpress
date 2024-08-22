<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://onlinewebtutorblog.com/
 * @since      3.0.0
 *
 * @package    Library_Management_System
 * @subpackage Library_Management_System/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Library_Management_System
 * @subpackage Library_Management_System/admin
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Library_Management_System_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	private $table_activator;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		require_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'includes/class-library-management-system-activator.php';
        $this->table_activator = new Library_Management_System_Activator();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    3.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( "owt7-lms-table-css", plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( "owt7-lms-table-buttons-css", plugin_dir_url( __FILE__ ) . 'css/buttons.dataTables.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( "owt7-lms-toastr-css", plugin_dir_url( __FILE__ ) . 'css/toastr.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/library-management-system-admin.css', array(), time(), 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    3.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( "owt7-lms-validate", plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-toastr", plugin_dir_url( __FILE__ ) . 'js/toastr.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable", plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable-btns", plugin_dir_url( __FILE__ ) . 'js/dataTables.buttons.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable-excel-btn", plugin_dir_url( __FILE__ ) . 'js/jszip.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable-pdf-btn", plugin_dir_url( __FILE__ ) . 'js/pdfmake.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable-vfs-fonts", plugin_dir_url( __FILE__ ) . 'js/vfs_fonts.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable-btns-plugin", plugin_dir_url( __FILE__ ) . 'js/buttons.html5.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt7-lms-datatable-copy-btn", plugin_dir_url( __FILE__ ) . 'js/buttons.print.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/library-management-system-admin.js', array( 'jquery' ), time(), false );

		wp_localize_script($this->plugin_name, "owt7_library", array(
			"ajaxurl" => admin_url("admin-ajax.php"),
			"active" => 1,
			"ajax_nonce" => wp_create_nonce('owt7_library_actions'),
			"messages" => array(
				"message_1" => __('Submitted, please wait', 'library-management-system'),
				"message_2" => __('Submit', 'library-management-system'),
				"message_3" => __('Success', 'library-management-system'),
				"message_4" => __('Error', 'library-management-system'),
				"message_5" => __('Upload Image', 'library-management-system'),
				"message_6" => __('Select Section', 'library-management-system'),
				"message_7" => __('Select User', 'library-management-system'),
				"message_8" => __('Select Book', 'library-management-system'),
				"message_9" => __('Run Data Importer remove existing data from Categories, Books, Bookcases, Sections, Branched and Users Table and then install new data. Do you want to Run Test Data Importer?', 'library-management-system'),
				"message_10" => __('Are you sure want to remove LMS Test Data?', 'library-management-system'),
				"message_11" => __('Are you sure want to pay the fine?', 'library-management-system'),
				"message_12" => __('Are you sure want to delete?', 'library-management-system'),
				"message_13" => __('Are you sure want to return this book?', 'library-management-system')
			)
		));

	}

	// Register Plugin Menus and Submenus
	public function owt7_library_management_menus() {
		// Main menu
		add_menu_page(__('Library Management', 'library-management-system'), __('Library Management', 'library-management-system'), 'manage_options', 'library_management_system', array($this, 'owt7_library_management_dashboard_page'), 'dashicons-book-alt', 67);
		// Submenus
		add_submenu_page('library_management_system', __('Dashboard', 'library-management-system'), __('Dashboard', 'library-management-system'), 'manage_options', 'library_management_system', array($this, 'owt7_library_management_dashboard_page'));
		add_submenu_page('library_management_system', __('Manage Users', 'library-management-system'), __('Manage Users', 'library-management-system'), 'manage_options', 'owt7_library_users', array($this, 'owt7_library_management_manage_users_page'));
		add_submenu_page('library_management_system', __('Manage Bookcase & Section', 'library-management-system'), __('Manage Bookcase & Section', 'library-management-system'), 'manage_options', 'owt7_library_bookcases', array($this, 'owt7_library_management_manage_bookcase_page'));
		add_submenu_page('library_management_system', __('Manage Books', 'library-management-system'), __('Manage Books', 'library-management-system'), 'manage_options', 'owt7_library_books', array($this, 'owt7_library_management_manage_books_page'));
		add_submenu_page('library_management_system', __('Book Transactions', 'library-management-system'), __('Book Transactions', 'library-management-system'), 'manage_options', 'owt7_library_transactions', array($this, 'owt7_library_management_transactions_page'));
		add_submenu_page('library_management_system', __('Settings', 'library-management-system'), __('Settings', 'library-management-system'), 'manage_options', 'owt7_library_settings', array($this, 'owt7_library_management_settings_page'));
		add_submenu_page('library_management_system', __('Free Vs Pro LMS', 'library-management-system'), __('Free Vs Pro LMS', 'library-management-system'), 'manage_options', 'owt7_library_free_vs_pro', array($this, 'owt7_library_management_free_vs_pro_page'));
		add_submenu_page('library_management_system', __('Upgrade to Pro', 'library-management-system'), __('Upgrade to Pro', 'library-management-system'), 'manage_options', 'owt7_library_addons', array($this, 'owt7_library_management_addons_page'));
	}

	// Add Documentation and Settings link To Plugin
	public function owt7_add_plugin_action_links($links){
		$settings_link = '<a href="admin.php?page=owt7_library_settings">Settings</a>';
		$links[] = $settings_link;
		$doc_link = '<a href="'.LIBRARY_FREE_VERSION_DOC_LINK.'" target="_blank">Documentation</a>';
		$links[] = $doc_link;
		return $links;
	}
	
	// Callback: "Dashboard"
	public function owt7_library_management_dashboard_page() {
		
		$this->owt7_library_include_template_file("", "owt7_library_dashboard");
	}

	// Callback: "Branch and Users"
	public function owt7_library_management_manage_users_page() {

		global $wpdb;

		$allowed_pages = [
			"user" => [
				"add",
				"list"
			],
			"branch" => [
				"add",
				"list"
			]
		];

		$mod = isset($_REQUEST['mod']) ? strtolower($_REQUEST['mod']) : "";
		$fn = isset($_REQUEST['fn']) ? strtolower($_REQUEST['fn']) : "";

		// Query String Params
		$id = isset($_REQUEST['id']) ? intval(base64_decode($_REQUEST['id'])) : "";
		$opt = isset($_REQUEST['opt']) ? strtolower($_REQUEST['opt']) : "";

		// Add Media Library Files
		wp_enqueue_media();

		$statuses = [
			"1" => "active",
			"0" => "inactive"
		];
		
		if(!empty($fn) && in_array($fn, $allowed_pages[$mod])){

			if($mod == "branch"){ // [add, edit, view]

				// All branches
				$branches = $wpdb->get_results(
					"SELECT branch.*, (SELECT count(*) FROM ".$this->table_activator->owt7_library_tbl_users()." as user WHERE branch.id = user.branch_id LIMIT 1) as total_users from " . $this->table_activator->owt7_library_tbl_branch()." as branch"
				);
			
				$branch = array();

				if(!empty($id)){
					$branch = $wpdb->get_row(
						"SELECT * from " . $this->table_activator->owt7_library_tbl_branch()." WHERE id = {$id}",
						ARRAY_A
					);
				}

				if(!empty($branch)){ // [edit, view]

					$this->owt7_library_include_template_file(
						"users", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"branch" => $branch,
							"statuses" => $statuses,
							"action" => $opt
						]
					);
				}else{ // [list, add]

					$this->owt7_library_include_template_file(
						"users", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"branches" => $branches,
							"statuses" => $statuses
						]
					);
				}
			} elseif($mod == "user"){ // [add, edit, view]

				// All "Active" branches
				$branches = $wpdb->get_results(
					"SELECT * from " . $this->table_activator->owt7_library_tbl_branch(). " WHERE status = 1"
				);
				
				$genders = ["male", "female", "other"];

				$user = array();

				if(!empty($id)){
					$user = $wpdb->get_row(
						"SELECT * from " . $this->table_activator->owt7_library_tbl_users()." WHERE id = {$id}",
						ARRAY_A
					);
				}

				$this->owt7_library_include_template_file(
					"users", 
					"owt7_library_{$fn}_{$mod}", 
					[
						"branches" => $branches,
						"user" => $user,
						"genders" => $genders,
						"statuses" => $statuses,
						"action" => $opt
					]
				);
			}
		}else{ // [list]

			// All Users
			$users = $wpdb->get_results(
				"SELECT user.*, (SELECT name FROM ".$this->table_activator->owt7_library_tbl_branch()." as branch WHERE branch.id = user.branch_id LIMIT 1) as branch_name from " . $this->table_activator->owt7_library_tbl_users()." as user"
			);

			// All "Active" branches
			$branches = $wpdb->get_results(
				"SELECT * from " . $this->table_activator->owt7_library_tbl_branch(). " WHERE status = 1"
			);
		
			$this->owt7_library_include_template_file(
				"users", 
				"owt7_library_users", [
					"users" => $users,
					"branches" => $branches,
				]
			);
		}
	}

	// Callback: "Bookcase and Sections"
	public function owt7_library_management_manage_bookcase_page() {

		global $wpdb;

		$allowed_pages = [
			"bookcase" => [
				"add",
				"list"
			],
			"section" => [
				"add",
				"list"
			]
		];

		$mod = isset($_REQUEST['mod']) ? strtolower($_REQUEST['mod']) : "";
		$fn = isset($_REQUEST['fn']) ? strtolower($_REQUEST['fn']) : "";

		// Query String Params
		$id = isset($_REQUEST['id']) ? intval(base64_decode($_REQUEST['id'])) : "";
		$opt = isset($_REQUEST['opt']) ? strtolower($_REQUEST['opt']) : "";

		$statuses = [
			"1" => "active",
			"0" => "inactive"
		];

		if(!empty($fn) && in_array($fn, $allowed_pages[$mod])){

			if($mod == "section"){ // [add, edit, view]

				// All "Active" bookcases
				$bookcases = $wpdb->get_results(
					"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase()." WHERE status = 1"
				);

				$section = array();

				if(!empty($id)){
					$section = $wpdb->get_row(
						"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase_sections()." WHERE id = {$id}",
						ARRAY_A
					);
				}

				if(!empty($section)){ // [edit, view]

					$this->owt7_library_include_template_file(
						"bookcases", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"section" => $section,
							"bookcases" => $bookcases,
							"statuses" => $statuses,
							"action" => $opt
						]
					);
				}else{ // [list, add]

					$sections = $wpdb->get_results(
						"SELECT sec.*, bkcase.name as bookcase_name from " . $this->table_activator->owt7_library_tbl_bookcase_sections(). " sec INNER JOIN ". $this->table_activator->owt7_library_tbl_bookcase() . " bkcase ON sec.bookcase_id = bkcase.id"
					);

					$this->owt7_library_include_template_file(
						"bookcases", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"sections" => $sections,
							"bookcases" => $bookcases,
							"statuses" => $statuses
						]
					);
				}
			}elseif($mod == "bookcase"){ // [add, edit, view]

				$bookcase = array();

				if(!empty($id)){
					$bookcase = $wpdb->get_row(
						"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase()." WHERE id = {$id}",
						ARRAY_A
					);
				}

				$this->owt7_library_include_template_file(
					"bookcases", 
					"owt7_library_{$fn}_{$mod}", 
					[
							"bookcase" => $bookcase,
							"statuses" => $statuses,
							"action" => $opt
					]
				);
			}
		}else{

			// All bookcases
			$bookcases = $wpdb->get_results(
				"SELECT bkcase.*, (SELECT count(*) FROM ".$this->table_activator->owt7_library_tbl_bookcase_sections()." as section WHERE section.bookcase_id = bkcase.id limit 1) as total_sections from " . $this->table_activator->owt7_library_tbl_bookcase()." as bkcase"
			);

			$this->owt7_library_include_template_file(
				"bookcases", 
				"owt7_library_bookcases", 
				[
					"bookcases" => $bookcases
				]
			);
		}
	}

	// Callback: "Books and Categories"
	public function owt7_library_management_manage_books_page(){

		global $wpdb;

		$allowed_pages = [
			"book" => [
				"add",
				"list"
			],
			"category" => [
				"add",
				"list"
			]
		];

		$mod = isset($_REQUEST['mod']) ? strtolower($_REQUEST['mod']) : "";
		$fn = isset($_REQUEST['fn']) ? strtolower($_REQUEST['fn']) : "";
		
		// Query String Params
		$id = isset($_REQUEST['id']) ? intval(base64_decode($_REQUEST['id'])) : "";
		$opt = isset($_REQUEST['opt']) ? strtolower($_REQUEST['opt']) : "";

		// Add Media Library Files
		wp_enqueue_media();

		$statuses = [
			"1" => "active",
			"0" => "inactive"
		];

		if(!empty($fn) && in_array($fn, $allowed_pages[$mod])){

			if($mod == "category"){ // [add, edit, view]

				$category = array();

				if(!empty($id)){
					$category = $wpdb->get_row(
						"SELECT * from " . $this->table_activator->owt7_library_tbl_category()." WHERE id = {$id}",
						ARRAY_A
					);
				}

				if(!empty($category)){ // [edit, view]

					$this->owt7_library_include_template_file(
						"books", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"category" => $category,
							"statuses" => $statuses,
							"action" => $opt
						]
					);
				}else{ // [list, add]

					// All categories
					$categories = $wpdb->get_results(
						"SELECT category.*, (SELECT count(*) FROM ".$this->table_activator->owt7_library_tbl_books()." as book WHERE book.category_id = category.id LIMIT 1) as total_books from " . $this->table_activator->owt7_library_tbl_category(). " as category"
					);

					$this->owt7_library_include_template_file(
						"books", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"categories" => $categories,
							"statuses" => $statuses
						]
					);
				}
			} elseif($mod == "book"){

				$book = array();
				$sections = array();

				// All categories
				$categories = $wpdb->get_results(
					"SELECT * from " . $this->table_activator->owt7_library_tbl_category(). " WHERE status = 1"
				);

				$bookcases = $wpdb->get_results(
					"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase(). " WHERE status = 1"
				);

				if(!empty($id)){
					$book = $wpdb->get_row(
						"SELECT * from " . $this->table_activator->owt7_library_tbl_books()." WHERE id = {$id}",
						ARRAY_A
					);
					if(!empty($book['bookcase_id'])){

						$sections = $wpdb->get_results(
							"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase_sections(). " WHERE bookcase_id = {$book['bookcase_id']} AND status = 1"
						);
					}
				}

				if(!empty($book)){ // [edit, view]

					$this->owt7_library_include_template_file(
						"books", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"book" => $book,
							"statuses" => $statuses,
							"sections" => $sections,
							"bookcases" => $bookcases,
							"action" => $opt,
							"categories" => $categories
						]
					);
				}else{ // [add]

					$this->owt7_library_include_template_file(
						"books", 
						"owt7_library_{$fn}_{$mod}", 
						[
							"statuses" => $statuses,
							"bookcases" => $bookcases,
							"categories" => $categories
						]
					);
				}
			}
		}else{

			// All books
			$books = $wpdb->get_results(
				"SELECT book.id, book.book_id, book.name, book.stock_quantity, book.status, book.created_at, (SELECT category.name FROM ".$this->table_activator->owt7_library_tbl_category()." as category WHERE category.id = book.category_id LIMIT 1) as category_name, (SELECT bkcase.name FROM ".$this->table_activator->owt7_library_tbl_bookcase()." as bkcase WHERE bkcase.id = book.bookcase_id LIMIT 1) as bookcase_name, (SELECT section.name FROM ".$this->table_activator->owt7_library_tbl_bookcase_sections()." as section WHERE section.id = book.bookcase_section_id LIMIT 1) as section_name from " . $this->table_activator->owt7_library_tbl_books(). " as book"
			);

			// All categories
			$categories = $wpdb->get_results(
				"SELECT * from " . $this->table_activator->owt7_library_tbl_category(). " WHERE status = 1"
			);

			$this->owt7_library_include_template_file(
				"books", 
				"owt7_library_books", [
					"books" => $books,
					"categories" => $categories
				]
			);
		}
	}

	// Callback: "Books Borrow and Return Transactions"
	public function owt7_library_management_transactions_page(){

		global $wpdb;

		$allowed_pages = [
			"books" => [
				"books",
				"borrow",
				"return-history",
				"return",
				"history"
			]
		];

		$mod = isset($_REQUEST['mod']) ? strtolower($_REQUEST['mod']) : ""; // books
		$fn = isset($_REQUEST['fn']) ? strtolower($_REQUEST['fn']) : ""; // [borrow, return-history, return]

		if(!empty($fn) && in_array($fn, $allowed_pages[$mod])){

			$fn = str_replace("-", "_", $fn);

			if($mod == "books"){

				$returns = [];

				$branches = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT id, name from " . $this->table_activator->owt7_library_tbl_branch() . " WHERE status = %d",
						1
					)
				);

				$categories = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT id, name from " . $this->table_activator->owt7_library_tbl_category() . " WHERE status = %d",
						1
					)
				);

				// Return History
				if($fn == "return_history"){

					$returns = $wpdb->get_results(
						"SELECT rt.id, rt.borrow_id, rt.status, rt.created_at, (SELECT category.name FROM " .$this->table_activator->owt7_library_tbl_category(). " category WHERE category.id = rt.category_id LIMIT 1) as category_name, (SELECT book.name FROM " .$this->table_activator->owt7_library_tbl_books(). " book WHERE book.id = rt.book_id LIMIT 1) as book_name, (SELECT branch.name FROM " .$this->table_activator->owt7_library_tbl_branch(). " branch WHERE branch.id = rt.branch_id LIMIT 1) as branch_name, (SELECT user.name FROM " .$this->table_activator->owt7_library_tbl_users(). " user WHERE user.id = rt.u_id LIMIT 1) as user_name, (SELECT borrow.borrows_days FROM " .$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.borrow_id = rt.borrow_id LIMIT 1) as total_days, (SELECT borrow.created_at FROM " .$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.borrow_id = rt.borrow_id LIMIT 1) as issued_on, (SELECT fine.has_paid FROM " .$this->table_activator->owt7_library_tbl_book_late_fine(). " fine WHERE fine.return_id = rt.id LIMIT 1) as has_paid, (SELECT fine.fine_amount FROM " .$this->table_activator->owt7_library_tbl_book_late_fine(). " fine WHERE fine.return_id = rt.id LIMIT 1) as fine_amount, (SELECT fine.extra_days FROM " .$this->table_activator->owt7_library_tbl_book_late_fine(). " fine WHERE fine.return_id = rt.id LIMIT 1) as extra_days FROM ".$this->table_activator->owt7_library_tbl_book_return(). " as rt ORDER by rt.id DESC"
					);
				}

				$this->owt7_library_include_template_file(
					"transactions", 
					"owt7_library_{$mod}_{$fn}",
					[
						"branches" => $branches,
						"categories" => $categories,
						"returns" => $returns
					]
				);
			}else{

				$this->owt7_library_include_template_file(
					"transactions", 
					"owt7_library_books_{$mod}_{$fn}"
				);
			}
		}else{

			$borrows = $wpdb->get_results(
				"SELECT borrow.id, borrow.borrow_id, borrow.borrows_days, borrow.return_date, borrow.status, borrow.created_at, (SELECT category.name FROM " .$this->table_activator->owt7_library_tbl_category(). " category WHERE category.id = borrow.category_id LIMIT 1) as category_name, (SELECT book.name FROM " .$this->table_activator->owt7_library_tbl_books(). " book WHERE book.id = borrow.book_id LIMIT 1) as book_name, (SELECT branch.name FROM " .$this->table_activator->owt7_library_tbl_branch(). " branch WHERE branch.id = borrow.branch_id LIMIT 1) as branch_name, (SELECT user.name FROM " .$this->table_activator->owt7_library_tbl_users(). " user WHERE user.id = borrow.u_id LIMIT 1) as user_name FROM ".$this->table_activator->owt7_library_tbl_book_borrow(). " borrow ORDER by borrow.id DESC"
			);

			$branches = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT id, name from " . $this->table_activator->owt7_library_tbl_branch() . " WHERE status = %d",
					1
				)
			);

			$categories = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT id, name from " . $this->table_activator->owt7_library_tbl_category() . " WHERE status = %d",
					1
				)
			);

			$this->owt7_library_include_template_file(
				"transactions", 
				"owt7_library_books_transactions",
				[
					"borrows" => $borrows,
					"branches" => $branches,
					"categories" => $categories
				]
			);
		}
	}

	// Callback: "Books Borrow and Return Transactions"
	public function owt7_library_management_settings_page(){

		global $wpdb;
		// [late_fine, country]
		$mod = isset($_REQUEST['mod']) ? strtolower($_REQUEST['mod']) : ""; 

		if(!empty($mod)){

			$this->owt7_library_include_template_file(
				"settings", 
				"owt7_library_{$mod}_settings"
			);
		}else{

			$this->owt7_library_include_template_file(
				"settings", 
				"owt7_library_settings"
			);
		}
	}

	// Callback: "Free Vs Pro LMS"
	public function owt7_library_management_free_vs_pro_page(){

		$this->owt7_library_include_template_file("lms", "owt7_library_free_vs_pro");
	}

	// Callback: "Addons"
	public function owt7_library_management_addons_page(){

		$this->owt7_library_include_template_file("lms", "owt7_library_addons");
	}

	// Helper function
	private function owt7_library_include_template_file($mod, $template, $lib_params = array()){

		ob_start();
		$params = $lib_params;
		if(!empty($mod)){
			include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . "admin/views/{$mod}/" . $template . ".php";
		}else{
			include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/' . $template . ".php";
		}
		$template = ob_get_contents();
		ob_end_clean();

		echo $template;
	}

	// Generate Unique Identifier
	private function owt7_library_generate_unique_identifier($prefix = 'LMS', $length = 6) {
		if ($length <= 0) {
			return $prefix;
		}
	
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
	
		return $prefix . $randomString;
	}

	// Send Response in JSON
	private function json($response = array())
    {
		$data = isset($response[2]) ? $response[2] : array();
		$ar = array('sts' => $response[0], 'msg' => $response[1], 'arr' => $data);
        print_r(json_encode($ar));
        die;
    }

	// LMS Free Version Credit
	private function owt7_library_free_version_credit($table, $type = ""){

		global $wpdb;

		$data = $wpdb->get_results(
			"SELECT * from {$table}"
		);

		$limited_credits = ["categories", "bookcases", "branches"];

		if(!empty($type) && in_array($type, $limited_credits)){
			$credit = base64_decode(LMS_FREE_VERSION_LIMIT);
			$credit = intval($credit - 10);
			if(count($data) < $credit){
				return true;
			}else{
				return false;
			}
		}else{
			if(count($data) < base64_decode(LMS_FREE_VERSION_LIMIT)){
				return true;
			}else{
				return false;
			}
		}
	}

	// Manage Stock
	private function owt7_library_manage_books_stock($book_id, $action){
		global $wpdb;
		$book_data = $wpdb->get_row(
			"SELECT * FROM " . $this->table_activator->owt7_library_tbl_books() . " WHERE id = {$book_id}"
		);
		if(!empty($book_data)){
			$stock_quantity = $book_data->stock_quantity;
			if($action == "plus"){
				$stock_quantity = $stock_quantity + 1;
				$wpdb->update($this->table_activator->owt7_library_tbl_books(), [
					"stock_quantity" => $stock_quantity
				], [
					"id" => $book_id
				]);
				return true;
			} elseif($action == "minus"){
				if($stock_quantity > 0){
					$stock_quantity = $stock_quantity - 1;
					$wpdb->update($this->table_activator->owt7_library_tbl_books(), [
						"stock_quantity" => $stock_quantity
					], [
						"id" => $book_id
					]);
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	// Ajax Handler
	public function owt7_library_management_ajax_handler(){

		//ini_set("display_errors", 1);

		global $wpdb;

        $param = isset( $_REQUEST['param'] ) ? trim( $_REQUEST['param'] ) : "";

		if ( isset( $_REQUEST['owt7_lms_nonce'] ) && wp_verify_nonce( $_REQUEST['owt7_lms_nonce'], 'owt7_library_actions' ) ) {

			if ( !empty( $param ) ) {

				if ( $param == "owt7_lms_branch_form" ) {
	
					// Action Type
					$action_type = isset( $_REQUEST['action_type'] ) ? sanitize_text_field( trim( $_REQUEST['action_type'] ) ) : "" ;
					// Form Data
					$branch = isset( $_REQUEST['owt7_txt_branch_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_branch_name'] ) ) : "";
					$status = isset( $_REQUEST['owt7_dd_branch_status'] ) ? absint( $_REQUEST['owt7_dd_branch_status'] ) : 1;
					$edit_id = isset( $_REQUEST['edit_id'] ) ? sanitize_text_field( trim( $_REQUEST['edit_id'] ) ) : "" ;
	
					if(!empty($action_type)){ // [add, edit]

						if($action_type == "add"){

							if ( !empty( $branch ) ) {

								if($this->owt7_library_free_version_credit($this->table_activator->owt7_library_tbl_branch(), "branches")){

									$is_branch_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_branch() . " WHERE LOWER(TRIM(name)) = %s",
											strtolower(trim($branch))
										)
									);
				
									if ( !empty( $is_branch_exists ) ) {
				
										$response = [
											0, 
											__("Branch name already taken", "library-management-system")
										];
									} else {
				
										$wpdb->insert($this->table_activator->owt7_library_tbl_branch(), array(
											"name" => $branch,
											"status" => $status
										));
				
										if ( $wpdb->insert_id > 0 ) {
				
											$response = [
												1,
												__("Successfully, Branch added to LMS", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to add Branch", "library-management-system")
											];
										}
									}
								}else{

									$response = [
										0, 
										__("Sorry, No Credits Left.<br/>Upgrade to Pro Version of LMS.", "library-management-system")
									];
								}
							} else {
								$response = [
									0, 
									__("Branch value required", "library-management-system")
								];
							}
						} elseif ($action_type == "edit"){

							if ( !empty( $branch ) ) {
	
								$branch_have_same_id = $wpdb->get_row(
									$wpdb->prepare(
										"SELECT * from " . $this->table_activator->owt7_library_tbl_branch() . " WHERE LOWER(TRIM(name)) = %s AND id <> %d",
										strtolower(trim($branch)), $edit_id
									)
								);
			
								if ( !empty( $branch_have_same_id ) ) {
			
									$response = [
										0, 
										__("Branch name already taken", "library-management-system")
									];
								}else{

									$is_branch_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_branch() . " WHERE id = %d",
											$edit_id
										)
									);

									if(!empty($is_branch_exists)){

										$wpdb->update($this->table_activator->owt7_library_tbl_branch(), array(
											"name" => $branch,
											"status" => $status
										), [
											"id" => $edit_id
										]);
				
										$response = [
											1,
											__("Successfully, Branch data updated", "library-management-system")
										];
									}else{

										$response = [
											0,
											__("Branch not found", "library-management-system")
										];
									}
								}
							} else {
								$response = [
									0, 
									__("Branch value required", "library-management-system")
								];
							}
						}

					}else{

						$response = [
							0, 
							__("Invalid Operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_user_form" ) {
					
					// Action Type
					$action_type = isset( $_REQUEST['action_type'] ) ? sanitize_text_field( trim( $_REQUEST['action_type'] ) ) : "" ;
					// Form Data
					$userId = isset( $_REQUEST['owt7_txt_u_id'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_u_id'] ) ) : "" ;
					$branchId = isset( $_REQUEST['owt7_dd_branch_id'] ) ? absint( $_REQUEST['owt7_dd_branch_id'] ) : 1 ;
					$name = isset( $_REQUEST['owt7_txt_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_name'] ) ) : "" ;
					$email = isset( $_REQUEST['owt7_txt_email'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_email'] ) ) : "" ;
					$phone = isset( $_REQUEST['owt7_txt_phone'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_phone'] ) ) : "" ;
					$gender = isset( $_REQUEST['owt7_dd_gender'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_dd_gender'] ) ) : "" ;
					$address = isset( $_REQUEST['owt7_txt_address'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_address'] ) ) : "" ;
					$profileImage = isset( $_REQUEST['owt7_profile_image'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_profile_image'] ) ) : "" ;
					$status = isset( $_REQUEST['owt7_dd_user_status'] ) ? absint( $_REQUEST['owt7_dd_user_status'] ) : 1 ;
					$edit_id = isset( $_REQUEST['edit_id'] ) ? sanitize_text_field( trim( $_REQUEST['edit_id'] ) ) : "" ;

					if(!empty($action_type)){ // [add, edit, view]

						if($action_type == "add"){

							if(!empty($userId) || !empty($branchId) || !empty($name)){

								if($this->owt7_library_free_version_credit($this->table_activator->owt7_library_tbl_users())){

									$is_user_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_users() . " WHERE LOWER(TRIM(u_id)) = %s",
											strtolower(trim($userId))
										)
									);
				
									if ( !empty( $is_user_exists ) ) {
				
										$response = [
											0, 
											__("User already exists", "library-management-system")
										];
									}else{
			
										$wpdb->insert($this->table_activator->owt7_library_tbl_users(), array(
											"register_from" => "admin",
											"u_id" => $userId,
											"name" => $name,
											"email" => $email,
											"gender" => $gender,
											"branch_id" => $branchId,
											"phone_no" => $phone,
											"profile_image" => $profileImage,
											"address_info" => $address,
											"status" => $status
										));
				
										if ( $wpdb->insert_id > 0 ) {
				
											$response = [
												1, 
												__("Successfully, User added to LMS", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to add User", "library-management-system")
											];
										}
									}
								}else{

									$response = [
										0, 
										__("Sorry, No Credits Left.<br/>Upgrade to Pro Version of LMS.", "library-management-system")
									];
								}
							}else{
		
								$response = [
									0, 
									__("Required fields are missing", "library-management-system")
								];
							}
						} elseif($action_type == "edit"){

							if(!empty($userId) || !empty($branchId) || !empty($name)){

								$user_have_same_id = $wpdb->get_row(
									$wpdb->prepare(
										"SELECT * from " . $this->table_activator->owt7_library_tbl_users() . " WHERE LOWER(TRIM(u_id)) = %s AND id <> %d",
										strtolower(trim($userId)), $edit_id
									)
								);
			
								if ( !empty( $user_have_same_id ) ) {
			
									$response = [
										0, 
										__("User ID already taken", "library-management-system")
									];
								}else{

									$is_user_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_users() . " WHERE id = %d",
											$edit_id
										)
									);

									if(!empty($is_user_exists)){

										$wpdb->update($this->table_activator->owt7_library_tbl_users(), array(
											"u_id" => $userId,
											"name" => $name,
											"email" => $email,
											"gender" => $gender,
											"branch_id" => $branchId,
											"phone_no" => $phone,
											"profile_image" => $profileImage,
											"address_info" => $address,
											"status" => $status
										), [
											"id" => $edit_id
										]);
				
										$response = [
											1, 
											__("Successfully, User data updated", "library-management-system")
										];
									}else{

										$response = [
											0, 
											__("User not found", "library-management-system")
										];
									}
								}
							}else{
		
								$response = [
									0, 
									__("Required fields are missing", "library-management-system")
								];
							}
						}
					}else{

						$response = [
							0, 
							__("Invalid Operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_delete_function" ){

					$deleteId = isset( $_REQUEST['id'] ) ? intval( base64_decode( $_REQUEST['id'] ) ) : "";
					$deleteModule = isset( $_REQUEST['module'] ) ? base64_decode( $_REQUEST['module'] ) : ""; 
					// [user, branch, bookcase, section, category, book, borrow, return]
					// Table name
					$tableName = "";
					$deleteStatus = false;
					$associatedModules = [
						"branch" => "user",
						"bookcase" => "section",
						"category" => "book"
					];
					
					if($deleteModule == "user"){
						$tableName = $this->table_activator->owt7_library_tbl_users();
					} elseif($deleteModule == "branch"){
						$tableName = $this->table_activator->owt7_library_tbl_branch();
						// Check to delete
						$has_data = $wpdb->get_row("SELECT count(*) as total_rows FROM {$this->table_activator->owt7_library_tbl_users()} WHERE branch_id = {$deleteId}");
						if(isset($has_data->total_rows) && $has_data->total_rows > 0){
							$deleteStatus = true;
						}
					} elseif($deleteModule == "bookcase"){
						$tableName = $this->table_activator->owt7_library_tbl_bookcase();
						// Check to delete
						$has_data = $wpdb->get_row("SELECT count(*) as total_rows FROM {$this->table_activator->owt7_library_tbl_bookcase_sections()} WHERE bookcase_id = {$deleteId}");
						if(isset($has_data->total_rows) && $has_data->total_rows){
							$deleteStatus = true;
						}
					} elseif($deleteModule == "section"){
						$tableName = $this->table_activator->owt7_library_tbl_bookcase_sections();
					} elseif($deleteModule == "category"){
						$tableName = $this->table_activator->owt7_library_tbl_category();
						// Check to delete
						$has_data = $wpdb->get_row("SELECT count(*) as total_rows FROM {$this->table_activator->owt7_library_tbl_books()} WHERE category_id = {$deleteId}");
						if(isset($has_data->total_rows) && $has_data->total_rows){
							$deleteStatus = true;
						}
					} elseif($deleteModule == "book"){
						$tableName = $this->table_activator->owt7_library_tbl_books();
					} elseif($deleteModule == "book_borrow"){
						$tableName = $this->table_activator->owt7_library_tbl_book_borrow();
						$deleteModule = str_replace("_", " ", $deleteModule);
					} elseif($deleteModule == "book_return"){
						$tableName = $this->table_activator->owt7_library_tbl_book_return();
						$deleteModule = str_replace("_", " ", $deleteModule);
					}

					if(!empty($tableName)){

						if(!$deleteStatus){

							$is_data_exists = $wpdb->get_row(
								$wpdb->prepare(
									"SELECT * from " . $tableName . " WHERE id = %d",
									$deleteId
								)
							);
		
							if(!empty($is_data_exists)){

								$wpdb->delete($tableName, [
									"id" => $is_data_exists->id
								]);
		
								$response = [
									1, 
									__("Successfully, " . ucfirst($deleteModule) . " deleted", "library-management-system")
								];
							}else{
		
								$response = [
									0, 
									__(ucfirst($deleteModule) . " not found", "library-management-system")
								];
							}
						}else{

							$response = [
								0, 
								__("Failed to delete. There are number of rows of " . ucfirst($associatedModules[$deleteModule]) . " associated with this " . ucfirst($deleteModule) . ". Please delete them first.", "library-management-system")
							];
						}
					}else{

						$response = [
							0, 
							__("Data Module not found", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_bookcase_form" ) {
	
					// Action Type
					$action_type = isset( $_REQUEST['action_type'] ) ? sanitize_text_field( trim( $_REQUEST['action_type'] ) ) : "" ;
					// Form Data
					$bookcase = isset( $_REQUEST['owt7_txt_bookcase_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_bookcase_name'] ) ) : "";
					$status = isset( $_REQUEST['owt7_dd_bookcase_status'] ) ? absint( $_REQUEST['owt7_dd_bookcase_status'] ) : 1;
					$edit_id = isset( $_REQUEST['edit_id'] ) ? sanitize_text_field( trim( $_REQUEST['edit_id'] ) ) : "" ;
	
					if(!empty($action_type)){ // [add, edit]

						if($action_type == "add"){

							if ( !empty( $bookcase ) ) {

								if($this->owt7_library_free_version_credit($this->table_activator->owt7_library_tbl_bookcase(), "bookcases")){

									$is_bookcase_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase() . " WHERE LOWER(TRIM(name)) = %s",
											strtolower(trim($bookcase))
										)
									);
				
									if ( !empty( $is_bookcase_exists ) ) {
				
										$response = [
											0, 
											__("Bookcase name already taken", "library-management-system")
										];
									} else {
				
										$wpdb->insert($this->table_activator->owt7_library_tbl_bookcase(), array(
											"name" => $bookcase,
											"status" => $status
										));
				
										if ( $wpdb->insert_id > 0 ) {
				
											$response = [
												1, 
												__("Successfully, Bookcase added to LMS", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to add Bookcase", "library-management-system")
											];
										}
									}
								}else{
									$response = [
										0, 
										__("Sorry, No Credits Left.<br/>Upgrade to Pro Version of LMS.", "library-management-system")
									];
								}
							} else {
								$response = [
									0, 
									__("Bookcase value required", "library-management-system")
								];
							}
						} elseif ($action_type == "edit"){

							if ( !empty( $bookcase ) ) {
	
								$bookcase_have_same_id = $wpdb->get_row(
									$wpdb->prepare(
										"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase() . " WHERE LOWER(TRIM(name)) = %s AND id <> %d",
										strtolower(trim($bookcase)), $edit_id
									)
								);
			
								if ( !empty( $bookcase_have_same_id ) ) {
			
									$response = [
										0, 
										__("Bookcase name already taken", "library-management-system")
									];
								}else{

									$is_bookcase_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase() . " WHERE id = %d",
											$edit_id
										)
									);

									if(!empty($is_bookcase_exists)){

										$wpdb->update($this->table_activator->owt7_library_tbl_bookcase(), array(
											"name" => $bookcase,
											"status" => $status
										), [
											"id" => $edit_id
										]);
				
										$response = [
											1, 
											__("Successfully, Bookcase data updated", "library-management-system")
										];
									}else{

										$response = [
											0, 
											__("Bookcase not found", "library-management-system")
										];
									}
								}
							} else {
								$response = [
									0, 
									__("Bookcase value required", "library-management-system")
								];
							}
						}

					}else{

						$response = [
							0, 
							__("Invalid Operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_section_form" ) {
	
					// Action Type
					$action_type = isset( $_REQUEST['action_type'] ) ? sanitize_text_field( trim( $_REQUEST['action_type'] ) ) : "" ;
					// Form Data
					$bookcase_id = isset( $_REQUEST['owt7_dd_bookcase_id'] ) ? absint( $_REQUEST['owt7_dd_bookcase_id'] ) : "";
					$section = isset( $_REQUEST['owt7_txt_section_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_section_name'] ) ) : "";
					$status = isset( $_REQUEST['owt7_dd_section_status'] ) ? absint( $_REQUEST['owt7_dd_section_status'] ) : 1;
					$edit_id = isset( $_REQUEST['edit_id'] ) ? sanitize_text_field( trim( $_REQUEST['edit_id'] ) ) : "" ;
	
					if(!empty($action_type)){ // [add, edit]

						if($action_type == "add"){

							if ( !empty( $section ) ) {

								if($this->owt7_library_free_version_credit($this->table_activator->owt7_library_tbl_bookcase_sections())){

									$is_section_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase_sections() . " WHERE LOWER(TRIM(name)) = %s AND bookcase_id = %d",
											strtolower(trim($section)), $bookcase_id
										)
									);
				
									if ( !empty( $is_section_exists ) ) {
				
										$response = [
											0, 
											__("Section name already taken", "library-management-system")
										];
									} else {
				
										$wpdb->insert($this->table_activator->owt7_library_tbl_bookcase_sections(), array(
											"name" => $section,
											"bookcase_id" => $bookcase_id,
											"status" => $status
										));
				
										if ( $wpdb->insert_id > 0 ) {
				
											$response = [
												1, 
												__("Successfully, Section added to LMS", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to add Section", "library-management-system")
											];
										}
									}
								}else{
									$response = [
										0, 
										__("Sorry, No Credits Left.<br/>Upgrade to Pro Version of LMS.", "library-management-system")
									];
								}
							} else {
								$response = [
									0, 
									__("Section value required", "library-management-system")
								];
							}
						} elseif ($action_type == "edit"){

							if ( !empty( $section ) ) {
	
								$section_have_same_id = $wpdb->get_row(
									$wpdb->prepare(
										"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase_sections() . " WHERE LOWER(TRIM(name)) = %s AND bookcase_id = %d AND id <> %d",
										strtolower(trim($section)), $bookcase_id, $edit_id
									)
								);
			
								if ( !empty( $section_have_same_id ) ) {
			
									$response = [
										0, 
										__("Section name already taken", "library-management-system")
									];
								}else{

									$is_section_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_bookcase_sections() . " WHERE id = %d",
											$edit_id
										)
									);

									if(!empty($is_section_exists)){

										$wpdb->update($this->table_activator->owt7_library_tbl_bookcase_sections(), array(
											"name" => $section,
											"bookcase_id" => $bookcase_id,
											"status" => $status
										), [
											"id" => $edit_id
										]);
				
										$response = [
											1, 
											__("Successfully, Section data updated", "library-management-system")
										];
									}else{

										$response = [
											0, 
											__("Section not found", "library-management-system")
										];
									}
								}
							} else {
								$response = [
									0, 
									__("Section value required", "library-management-system")
								];
							}
						}

					}else{

						$response = [
							0, 
							__("Invalid Operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_category_form" ) {
	
					// Action Type
					$action_type = isset( $_REQUEST['action_type'] ) ? sanitize_text_field( trim( $_REQUEST['action_type'] ) ) : "" ;
					// Form Data
					$category = isset( $_REQUEST['owt7_txt_category_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_category_name'] ) ) : "";
					$status = isset( $_REQUEST['owt7_dd_category_status'] ) ? absint( $_REQUEST['owt7_dd_category_status'] ) : 1;
					$edit_id = isset( $_REQUEST['edit_id'] ) ? sanitize_text_field( trim( $_REQUEST['edit_id'] ) ) : "" ;
	
					if(!empty($action_type)){ // [add, edit]

						if($action_type == "add"){

							if ( !empty( $category ) ) {

								if($this->owt7_library_free_version_credit($this->table_activator->owt7_library_tbl_category(), "categories")){

									$is_category_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_category() . " WHERE LOWER(TRIM(name)) = %s",
											strtolower(trim($category))
										)
									);
				
									if ( !empty( $is_category_exists ) ) {
				
										$response = [
											0, 
											__("Category name already taken", "library-management-system")
										];
									} else {
				
										$wpdb->insert($this->table_activator->owt7_library_tbl_category(), array(
											"name" => $category,
											"status" => $status
										));
				
										if ( $wpdb->insert_id > 0 ) {
				
											$response = [
												1, 
												__("Successfully, Category added to LMS", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to add Category", "library-management-system")
											];
										}
									}
								}else{
									$response = [
										0,
										__("Sorry, No Credits Left.<br/>Upgrade to Pro Version of LMS.", "library-management-system") 
									];
								}
							} else {
								$response = [
									0, 
									__("Category value required", "library-management-system")
								];
							}
						} elseif ($action_type == "edit"){

							if ( !empty( $category ) ) {
	
								$category_have_same_id = $wpdb->get_row(
									$wpdb->prepare(
										"SELECT * from " . $this->table_activator->owt7_library_tbl_category() . " WHERE LOWER(TRIM(name)) = %s AND id <> %d",
										strtolower(trim($category)), $edit_id
									)
								);
			
								if ( !empty( $category_have_same_id ) ) {
			
									$response = [
										0, 
										__("Category name already taken", "library-management-system")
									];
								}else{

									$is_category_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_category() . " WHERE id = %d",
											$edit_id
										)
									);

									if(!empty($is_category_exists)){

										$wpdb->update($this->table_activator->owt7_library_tbl_category(), array(
											"name" => $category,
											"status" => $status
										), [
											"id" => $edit_id
										]);
				
										$response = [
											1, 
											__("Successfully, Category data updated", "library-management-system")
										];
									}else{

										$response = [
											0, 
											__("Category not found", "library-management-system")
										];
									}
								}
							} else {
								$response = [
									0, 
									__("Category value required", "library-management-system")
								];
							}
						}

					}else{

						$response = [
							0, 
							__("Invalid Operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_book_form" ) {
	
					// Action Type
					$action_type = isset( $_REQUEST['action_type'] ) ? sanitize_text_field( trim( $_REQUEST['action_type'] ) ) : "" ;
					// Form Data
					$book_id = isset( $_REQUEST['owt7_txt_book_id'] ) ? $_REQUEST['owt7_txt_book_id'] : "";
					$category_id = isset( $_REQUEST['owt7_dd_category_id'] ) ? absint( $_REQUEST['owt7_dd_category_id'] ) : "";
					$bookcase_id = isset( $_REQUEST['owt7_dd_bookcase_id'] ) ? absint( $_REQUEST['owt7_dd_bookcase_id'] ) : "";
					$section_id = isset( $_REQUEST['owt7_dd_section_id'] ) ? absint( $_REQUEST['owt7_dd_section_id'] ) : "";
					$status = isset( $_REQUEST['owt7_dd_book_status'] ) ? absint( $_REQUEST['owt7_dd_book_status'] ) : 1;
					$book_name = isset( $_REQUEST['owt7_txt_book_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_book_name'] ) ) : "";
					$author_name = isset( $_REQUEST['owt7_txt_author_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_author_name'] ) ) : "" ;
					$publication_name = isset( $_REQUEST['owt7_txt_publication_name'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_publication_name'] ) ) : "" ;
					$publication_year = isset( $_REQUEST['owt7_txt_publication_year'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_publication_year'] ) ) : "" ;
					$publication_location = isset( $_REQUEST['owt7_txt_publication_location'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_publication_location'] ) ) : "" ;
					$cost = isset( $_REQUEST['owt7_txt_cost'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_cost'] ) ) : "" ;
					$isbn = isset( $_REQUEST['owt7_txt_isbn'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_isbn'] ) ) : "" ;
					$book_url = isset( $_REQUEST['owt7_txt_book_url'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_book_url'] ) ) : "" ;
					$quantity = isset( $_REQUEST['owt7_txt_quantity'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_quantity'] ) ) : "" ;
					$book_language = isset( $_REQUEST['owt7_txt_book_language'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_book_language'] ) ) : "" ;
					$total_pages = isset( $_REQUEST['owt7_txt_total_pages'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_total_pages'] ) ) : "" ;
					$description = isset( $_REQUEST['owt7_txt_description'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_txt_description'] ) ) : "" ;
					$cover_image = isset( $_REQUEST['owt7_cover_image'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_cover_image'] ) ) : "" ;
					$edit_id = isset( $_REQUEST['edit_id'] ) ? absint( $_REQUEST['edit_id'] ) : "";
	
					if(!empty($action_type)){ // [add, edit]

						if($action_type == "add"){

							if ( !empty( $book_id ) || !empty( $category_id ) || !empty( $bookcase_id ) || !empty( $section_id ) || !empty( $book_name ) ) {

								if($this->owt7_library_free_version_credit($this->table_activator->owt7_library_tbl_books())){
									$is_book_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_books() . " WHERE LOWER(TRIM(name)) = %s AND book_id = %s AND category_id = %d",
											strtolower(trim($book_name)), $book_id, $category_id
										)
									);
				
									if ( !empty( $is_book_exists ) ) {
				
										$response = [
											0, 
											__("Book name already taken", "library-management-system")
										];
									} else {
				
										$wpdb->insert($this->table_activator->owt7_library_tbl_books(), array(
											"book_id" => $book_id,
											"bookcase_id" => $bookcase_id,
											"bookcase_section_id" => $section_id,
											"category_id" => $category_id,
											"author_name" => $author_name,
											"name" => $book_name,
											"publication_name" => $publication_name,
											"publication_year" => $publication_year,
											"publication_location" => $publication_location,
											"amount" => $cost,
											"cover_image" => $cover_image,
											"isbn" => $isbn,
											"book_url" => $book_url,
											"stock_quantity" => $quantity,
											"book_language" => $book_language,
											"book_pages" => $total_pages,
											"description" => $description,
											"status" => $status
										));
				
										if ( $wpdb->insert_id > 0 ) {
				
											$response = [
												1, 
												__("Successfully, Book added to LMS", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to add Book", "library-management-system")
											];
										}
									}
								}else{
									$response = [
										0, 
										__("Sorry, No Credits Left.<br/>Upgrade to Pro Version of LMS.", "library-management-system")
									];
								}
							} else {
								$response = [
									0, 
									__("Please fill required values", "library-management-system")
								];
							}
						} elseif ($action_type == "edit"){

							if ( !empty( $book_id ) || !empty( $category_id ) || !empty( $bookcase_id ) || !empty( $section_id ) || !empty( $book_name ) ) {
	
								$book_have_same_data = $wpdb->get_row(
									$wpdb->prepare(
										"SELECT * from " . $this->table_activator->owt7_library_tbl_books() . " WHERE LOWER(TRIM(name)) = %s AND book_id = %s AND category_id = %d AND id <> %d",
										strtolower(trim($book_name)), $book_id, $category_id, $edit_id
									)
								);
			
								if ( !empty( $book_have_same_data ) ) {
			
									$response = [
										0, 
										__("Book name already taken", "library-management-system")
									];
								}else{

									$is_book_exists = $wpdb->get_row(
										$wpdb->prepare(
											"SELECT * from " . $this->table_activator->owt7_library_tbl_books() . " WHERE id = %d",
											$edit_id
										)
									);

									if(!empty($is_book_exists)){

										$wpdb->update($this->table_activator->owt7_library_tbl_books(), array(
											"book_id" => $book_id,
											"bookcase_id" => $bookcase_id,
											"bookcase_section_id" => $section_id,
											"category_id" => $category_id,
											"author_name" => $author_name,
											"name" => $book_name,
											"publication_name" => $publication_name,
											"publication_year" => $publication_year,
											"publication_location" => $publication_location,
											"amount" => $cost,
											"cover_image" => $cover_image,
											"isbn" => $isbn,
											"book_url" => $book_url,
											"stock_quantity" => $quantity,
											"book_language" => $book_language,
											"book_pages" => $total_pages,
											"description" => $description,
											"status" => $status
										), [
											"id" => $edit_id
										]);
				
										$response = [
											1, 
											__("Successfully, Book data updated", "library-management-system")
										];
									}else{

										$response = [
											0, 
											__("Book not found", "library-management-system")
										];
									}
								}
							} else {
								$response = [
									0, 
									__("Please fill required values", "library-management-system")
								];
							}
						}

					}else{

						$response = [
							0, 
							__("Invalid Operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_filter_section" ){
					// Bookcase ID
					$bookcase_id = isset( $_REQUEST['bkcase_id'] ) ? absint( $_REQUEST['bkcase_id'] ) : "" ;
					$sections = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT id, name from " . $this->table_activator->owt7_library_tbl_bookcase_sections() . " WHERE bookcase_id = %d AND status = %d",
							$bookcase_id, 1
						)
					);
					if(!empty($sections)){
						$response = [
							1, 
							"Sections",
							[
								"sections" => $sections
							]
						];
					}else{
						$response = [
							0, 
							__("No Section Found", "library-management-system")
						];	
					}
				} elseif ( $param == "owt7_lms_filter_user" ){
					// Branch ID
					$branch_id = isset( $_REQUEST['branch_id'] ) ? absint( $_REQUEST['branch_id'] ) : "" ;
					$users = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT id, name from " . $this->table_activator->owt7_library_tbl_users() . " WHERE branch_id = %d AND status = %d",
							$branch_id, 1
						)
					);
					if(!empty($users)){
						$response = [
							1, 
							"Users",
							[
								"users" => $users
							]
						];
					}else{
						$response = [
							0, 
							__("No User Found", "library-management-system")
						];	
					}
				} elseif ( $param == "owt7_lms_filter_book" ){
					// Category ID
					$category_id = isset( $_REQUEST['category_id'] ) ? absint( $_REQUEST['category_id'] ) : "" ;
					$books = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT id, name from " . $this->table_activator->owt7_library_tbl_books() . " WHERE category_id = %d AND status = %d",
							$category_id, 1
						)
					);
					if(!empty($books)){
						$response = [
							1, 
							"Books",
							[
								"books" => $books
							]
						];
					}else{
						$response = [
							0, 
							__("No book found", "library-management-system")
						];	
					}
				} elseif ( $param == "owt7_lms_borrow_book"){
					
					$branch_id = isset( $_REQUEST['owt7_dd_branch_id'] ) ? absint( $_REQUEST['owt7_dd_branch_id'] ) : "";
					$u_id = isset( $_REQUEST['owt7_dd_u_id'] ) ? absint( $_REQUEST['owt7_dd_u_id'] ) : "";
					$category_id = isset( $_REQUEST['owt7_dd_category_id'] ) ? absint( $_REQUEST['owt7_dd_category_id'] ) : "";
					$book_id = isset( $_REQUEST['owt7_dd_book_id'] ) ? absint( $_REQUEST['owt7_dd_book_id'] ) : "";
					$days_count = isset( $_REQUEST['owt7_dd_days'] ) ? absint( $_REQUEST['owt7_dd_days'] ) : "";

					if(!empty($branch_id) || !empty($u_id) || !empty($category_id) || !empty($book_id) || !empty($days_id)){

						$has_book_borrowed = $wpdb->get_row(
							"SELECT * FROM " . $this->table_activator->owt7_library_tbl_book_borrow() . " WHERE u_id = {$u_id} AND book_id = {$book_id} AND status = 1"
						);

						if(!empty($has_book_borrowed)){
							$response = [
								0, 
								__("Failed, This Book already borrowed by User.", "library-management-system")
							];
						}else{
							$borrowed_books = $wpdb->get_row(
								"SELECT * FROM " . $this->table_activator->owt7_library_tbl_book_borrow() . " WHERE u_id = {$u_id} AND status = 1"
							);
							if(!empty($borrowed_books)){
								$response = [
									0, 
									__("Want to Borrow More than 1 Book?<br/>Upgrade to Pro Version", "library-management-system")
								];
							}else{

								// Check for Late Fine (If any)
								$book_fine_details = $wpdb->get_row(
									"SELECT * FROM " . $this->table_activator->owt7_library_tbl_book_late_fine() . " WHERE u_id = {$u_id} and has_paid = 1 AND status = 1"
								);

								if(!empty($book_fine_details)){
									$response = [
										0, 
										__("Failed to Borrow Book.<br/>User has late fine.", "library-management-system")
									];
								}else{

									if($this->owt7_library_manage_books_stock($book_id, "minus")){

										$borrow_id = $this->owt7_library_generate_unique_identifier(8);
										$currentDate = new DateTime();
										$currentDate->modify("+" .$days_count. " days");
										$newDate = $currentDate->format('Y-m-d');
	
										$wpdb->insert($this->table_activator->owt7_library_tbl_book_borrow(), [
											"borrow_id" => $borrow_id,
											"category_id" => $category_id,
											"book_id" => $book_id,
											"branch_id" => $branch_id,
											"u_id" => $u_id,
											"borrows_days" => $days_count,
											"return_date" => $newDate,
											"status" => 1
										]);
	
										if ( $wpdb->insert_id > 0 ) {
						
											$response = [
												1, 
												__("Successfully, Book borrowed", "library-management-system")
											];
										} else {
											$response = [
												0, 
												__("Failed to borrow book", "library-management-system")
											];
										}
									}else{
										$response = [
											0, 
											__("Failed, Book is Out of Stock.", "library-management-system")
										];
									}
								}
							}
						}
					}else{
						$response = [
							0, 
							__("All fields are required", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_filter_borrow_book"){

					$u_id = isset( $_REQUEST['u_id'] ) ? absint( $_REQUEST['u_id'] ) : "" ;

					$borrowed_books = $wpdb->get_results(
						"SELECT borrow.id, (SELECT book.name FROM " . $this->table_activator->owt7_library_tbl_books() . " as book WHERE book.id = borrow.book_id LIMIT 1) as book_name FROM " . $this->table_activator->owt7_library_tbl_book_borrow() . " as borrow WHERE borrow.status = 1 AND borrow.u_id = " . $u_id
					);

					if(!empty($borrowed_books)){
						$response = [
							1, 
							"Books",
							[
								"books" => $borrowed_books
							]
						];
					}else{
						$response = [
							0, 
							__("No book found", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_return_book"){

					$borrow_ids = isset( $_REQUEST['owt7_borrow_books_id'] ) ? $_REQUEST['owt7_borrow_books_id'] : "";

					if(!empty($borrow_ids) && is_array($borrow_ids)){

						foreach($borrow_ids as $borrow_id){

							$book_borrow_details = $wpdb->get_row(
								"SELECT * FROM ".$this->table_activator->owt7_library_tbl_book_borrow() . " WHERE id = {$borrow_id} AND status = 1"
							);

							if(!empty($book_borrow_details)){

								// Late Fine Calculation
								$borrow_days = intval($book_borrow_details->borrows_days);
								$return_date = date("Y-m-d");
								$borrow_date = date("Y-m-d", strtotime($book_borrow_details->created_at));

								$borrow_date_obj = new DateTime($borrow_date);
								$return_date_obj = new DateTime($return_date);

								// Calculate the difference in days
								$date_diff = $borrow_date_obj->diff($return_date_obj)->days;
								$total_late_fine = 0;
								$extra_days = 0;
								// Check if the difference in days exceeds the borrow_days
								if ($date_diff > $borrow_days) {
									$extra_days = $date_diff - $borrow_days;
									$per_day_late_fine = get_option("owt7_lms_late_fine_currency");
									$total_late_fine = $extra_days * intval($per_day_late_fine);
								}

								if($this->owt7_library_manage_books_stock($book_borrow_details->book_id, "plus")){
									// Insert into Return History
									$wpdb->insert($this->table_activator->owt7_library_tbl_book_return(), [
										"borrow_id" => $book_borrow_details->borrow_id,
										"category_id" => $book_borrow_details->category_id,
										"book_id" => $book_borrow_details->book_id,
										"branch_id" => $book_borrow_details->branch_id,
										"u_id" => $book_borrow_details->u_id,
										"has_fine_status" => $extra_days > 0 ? 1 : 0,
										"status" => 1
									]);

									// Manage Late Fine History
									if($extra_days > 0 && $total_late_fine > 0){
										$wpdb->insert($this->table_activator->owt7_library_tbl_book_late_fine(), [
											"return_id" => $wpdb->insert_id,
											"book_id" => $book_borrow_details->book_id,
											"u_id" => $book_borrow_details->u_id,
											"extra_days" => $extra_days,
											"fine_amount" => $total_late_fine,
											"status" => 1,
											"has_paid" => 1 // 1 - Not paid, 2 - Paid
										]);
									}

									// Update Borrow History
									$wpdb->update($this->table_activator->owt7_library_tbl_book_borrow(), [
										"status" => 0
									], [
										"id" => $borrow_id
									]);
								}
							}
						}

						$response = [
							1, 
							__("Successfully, Book(s) Returned", "library-management-system")
						];

					}else{
						$response = [
							0, 
							__("Please Select Book(s) to be Return", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_data_filters"){

					$filterby = isset( $_REQUEST['filterby'] ) ? sanitize_text_field( trim( $_REQUEST['filterby'] ) ) : "" ;
					$list = isset( $_REQUEST['list'] ) ? sanitize_text_field( trim( $_REQUEST['list'] ) ) : "" ;
					$filterbyId = isset( $_REQUEST['id'] ) ? absint( $_REQUEST['id'] ) : 0;

					if(!empty($filterby)){

						$borrows = array();

						if($filterby == "category" && intval($filterbyId) > 0){

							if(!empty($list) && $list == "borrow_history"){

								$borrows = $wpdb->get_results(
									"SELECT borrow.id, borrow.borrow_id, borrow.borrows_days, borrow.return_date, borrow.status, borrow.created_at, (SELECT category.name FROM " .$this->table_activator->owt7_library_tbl_category(). " category WHERE category.id = borrow.category_id LIMIT 1) as category_name, (SELECT book.name FROM " .$this->table_activator->owt7_library_tbl_books(). " book WHERE book.id = borrow.book_id LIMIT 1) as book_name, (SELECT branch.name FROM " .$this->table_activator->owt7_library_tbl_branch(). " branch WHERE branch.id = borrow.branch_id LIMIT 1) as branch_name, (SELECT user.name FROM " .$this->table_activator->owt7_library_tbl_users(). " user WHERE user.id = borrow.u_id LIMIT 1) as user_name FROM ".$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.category_id = {$filterbyId} ORDER by borrow.id DESC"
								);
							} elseif(!empty($list) && $list == "return_history"){

								$returns = $wpdb->get_results(
									"SELECT rt.id, rt.borrow_id, rt.status, rt.created_at, (SELECT category.name FROM " .$this->table_activator->owt7_library_tbl_category(). " category WHERE category.id = rt.category_id LIMIT 1) as category_name, (SELECT book.name FROM " .$this->table_activator->owt7_library_tbl_books(). " book WHERE book.id = rt.book_id LIMIT 1) as book_name, (SELECT branch.name FROM " .$this->table_activator->owt7_library_tbl_branch(). " branch WHERE branch.id = rt.branch_id LIMIT 1) as branch_name, (SELECT user.name FROM " .$this->table_activator->owt7_library_tbl_users(). " user WHERE user.id = rt.u_id LIMIT 1) as user_name, (SELECT borrow.borrows_days FROM " .$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.borrow_id = rt.borrow_id LIMIT 1) as total_days, (SELECT borrow.created_at FROM " .$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.borrow_id = rt.borrow_id LIMIT 1) as issued_on FROM ".$this->table_activator->owt7_library_tbl_book_return(). " as rt WHERE rt.category_id = {$filterbyId} ORDER by rt.id DESC"
								);
							}
						} elseif($filterby == "branch" && intval($filterbyId) > 0){

							if(!empty($list) && $list == "borrow_history"){

								$borrows = $wpdb->get_results(
									"SELECT borrow.id, borrow.borrow_id, borrow.borrows_days, borrow.return_date, borrow.status, borrow.created_at, (SELECT category.name FROM " .$this->table_activator->owt7_library_tbl_category(). " category WHERE category.id = borrow.category_id LIMIT 1) as category_name, (SELECT book.name FROM " .$this->table_activator->owt7_library_tbl_books(). " book WHERE book.id = borrow.book_id LIMIT 1) as book_name, (SELECT branch.name FROM " .$this->table_activator->owt7_library_tbl_branch(). " branch WHERE branch.id = borrow.branch_id LIMIT 1) as branch_name, (SELECT user.name FROM " .$this->table_activator->owt7_library_tbl_users(). " user WHERE user.id = borrow.u_id LIMIT 1) as user_name FROM ".$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.branch_id = {$filterbyId} ORDER by borrow.id DESC"
								);
							} elseif(!empty($list) && $list == "return_history"){

								$returns = $wpdb->get_results(
									"SELECT rt.id, rt.borrow_id, rt.status, rt.created_at, (SELECT category.name FROM " .$this->table_activator->owt7_library_tbl_category(). " category WHERE category.id = rt.category_id LIMIT 1) as category_name, (SELECT book.name FROM " .$this->table_activator->owt7_library_tbl_books(). " book WHERE book.id = rt.book_id LIMIT 1) as book_name, (SELECT branch.name FROM " .$this->table_activator->owt7_library_tbl_branch(). " branch WHERE branch.id = rt.branch_id LIMIT 1) as branch_name, (SELECT user.name FROM " .$this->table_activator->owt7_library_tbl_users(). " user WHERE user.id = rt.u_id LIMIT 1) as user_name, (SELECT borrow.borrows_days FROM " .$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.borrow_id = rt.borrow_id LIMIT 1) as total_days, (SELECT borrow.created_at FROM " .$this->table_activator->owt7_library_tbl_book_borrow(). " borrow WHERE borrow.borrow_id = rt.borrow_id LIMIT 1) as issued_on FROM ".$this->table_activator->owt7_library_tbl_book_return(). " as rt WHERE rt.branch_id = {$filterbyId} ORDER by rt.id DESC"
								);
							}
						}

						if(!empty($list) && $list == "borrow_history"){

							if(!empty($borrows)){
								ob_start();
								// Template Variables
								$params['borrows'] = $borrows;
								include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/transactions/templates/owt7_library_borrow_list.php';
								$template = ob_get_contents();
								ob_end_clean();
								// Output
								$response = [
									1, 
									"Book(s) Borrow List",
									[
										"template" => $template
									]
								];
							}else{
	
								$response = [
									0, 
									__("No data found", "library-management-system")
								];
							}
						} elseif(!empty($list) && $list == "return_history"){

							if(!empty($returns)){
								ob_start();
								// Template Variables
								$params['returns'] = $returns;
								include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/views/transactions/templates/owt7_library_return_list.php';
								$template = ob_get_contents();
								ob_end_clean();
								// Output
								$response = [
									1, 
									"Book(s) Return List",
									[
										"template" => $template
									]
								];
							}else{
	
								$response = [
									0, 
									__("No data found", "library-management-system")
								];
							}
						}
					}else{

						$response = [
							0, 
							__("Invalid LMS operation", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_data_settings"){

					$type = isset( $_REQUEST['owt7_lms_settings_type'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_lms_settings_type'] ) ) : "" ;
					
					if(!empty($type) && $type == "late_fine"){
						
						$amount = isset( $_REQUEST['owt7_lms_fine_amount'] ) ? absint( $_REQUEST['owt7_lms_fine_amount'] ) : 0;
						update_option( 'owt7_lms_late_fine_currency', intval($amount) );

						$response = [
							1, 
							__("Successfully, LMS Settings updated", "library-management-system")
						];
					} elseif(!empty($type) && $type == "country_currency"){
						
						$country = isset( $_REQUEST['owt7_lms_country'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_lms_country'] ) ) : "" ;
						$currency = isset( $_REQUEST['owt7_lms_currency'] ) ? sanitize_text_field( trim( $_REQUEST['owt7_lms_currency'] ) ) : "" ;
						update_option( 'owt7_lms_country', $country );
						update_option( 'owt7_lms_currency', $currency );

						$response = [
							1, 
							__("Successfully, LMS Settings updated", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_data_option_filters"){

					$filterValue = isset( $_REQUEST['value'] ) ? sanitize_text_field( $_REQUEST['value'] ) : "all" ;
					$filterBy = isset( $_REQUEST['filterBy'] ) ? sanitize_text_field( trim( $_REQUEST['filterBy'] ) ) : "" ;
					$module = isset( $_REQUEST['module'] ) ? sanitize_text_field( trim( $_REQUEST['module'] ) ) : "" ;

					if(!empty($module)){

						// Books
						if($module == "books" && $filterBy == "category"){

							if($filterValue == "all"){

								// All Books
								$books = $wpdb->get_results(
									"SELECT book.id, book.book_id, book.name, book.stock_quantity, book.status, book.created_at, (SELECT category.name FROM ".$this->table_activator->owt7_library_tbl_category()." as category WHERE category.id = book.category_id LIMIT 1) as category_name, (SELECT bkcase.name FROM ".$this->table_activator->owt7_library_tbl_bookcase()." as bkcase WHERE bkcase.id = book.bookcase_id LIMIT 1) as bookcase_name, (SELECT section.name FROM ".$this->table_activator->owt7_library_tbl_bookcase_sections()." as section WHERE section.id = book.bookcase_section_id LIMIT 1) as section_name from " . $this->table_activator->owt7_library_tbl_books(). " as book"
								);
							} elseif ( $filterValue > 0 ){

								// Filtered Books
								$books = $wpdb->get_results(
									"SELECT book.id, book.book_id, book.name, book.stock_quantity, book.status, book.created_at, (SELECT category.name FROM ".$this->table_activator->owt7_library_tbl_category()." as category WHERE category.id = book.category_id LIMIT 1) as category_name, (SELECT bkcase.name FROM ".$this->table_activator->owt7_library_tbl_bookcase()." as bkcase WHERE bkcase.id = book.bookcase_id LIMIT 1) as bookcase_name, (SELECT section.name FROM ".$this->table_activator->owt7_library_tbl_bookcase_sections()." as section WHERE section.id = book.bookcase_section_id LIMIT 1) as section_name from " . $this->table_activator->owt7_library_tbl_books(). " as book WHERE book.category_id = {$filterValue}"
								);
							}

							$moduleFolder = "books";
						} elseif($module == "sections" && $filterBy == "bookcase"){ // Bookcases

							if($filterValue == "all"){

								// All Sections
								$sections = $wpdb->get_results(
									"SELECT sec.*, bkcase.name as bookcase_name from " . $this->table_activator->owt7_library_tbl_bookcase_sections(). " sec INNER JOIN ". $this->table_activator->owt7_library_tbl_bookcase() . " bkcase ON sec.bookcase_id = bkcase.id"
								);
							} elseif ( $filterValue > 0 ){

								// Filtered Sections
								$sections = $wpdb->get_results(
									"SELECT sec.*, bkcase.name as bookcase_name from " . $this->table_activator->owt7_library_tbl_bookcase_sections(). " sec INNER JOIN ". $this->table_activator->owt7_library_tbl_bookcase() . " bkcase ON sec.bookcase_id = bkcase.id WHERE sec.bookcase_id = {$filterValue}"
								);
							}

							$moduleFolder = "bookcases";
						} elseif($module == "users" && $filterBy == "branch"){ // Users

							if($filterValue == "all"){

								// All Users
								$users = $wpdb->get_results(
									"SELECT user.*, (SELECT name FROM ".$this->table_activator->owt7_library_tbl_branch()." as branch WHERE branch.id = user.branch_id LIMIT 1) as branch_name from " . $this->table_activator->owt7_library_tbl_users()." as user"
								);
							} elseif ( $filterValue > 0 ){

								// Filtered Users
								$users = $wpdb->get_results(
									"SELECT user.*, (SELECT name FROM ".$this->table_activator->owt7_library_tbl_branch()." as branch WHERE branch.id = user.branch_id LIMIT 1) as branch_name from " . $this->table_activator->owt7_library_tbl_users()." as user WHERE user.branch_id = {$filterValue}"
								);
							}

							$moduleFolder = "users";
						} 

						$params[$module] = ${$module};

						ob_start();
						include_once LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . "admin/views/{$moduleFolder}/templates/owt7_library_{$module}_list.php";
						$template = ob_get_contents();
						ob_end_clean();

						$response = [
							1,
							ucfirst($module),
							[
								"template" => $template
							]
						];
					}else{

						$response = [
							0, 
							__("Invalid LMS Module", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_import_test_data" ){

					// Remove existing data
					$truncateTableNames = [
						$this->table_activator->owt7_library_tbl_category(),
						$this->table_activator->owt7_library_tbl_books(),
						$this->table_activator->owt7_library_tbl_bookcase(),
						$this->table_activator->owt7_library_tbl_bookcase_sections(),
						$this->table_activator->owt7_library_tbl_branch(),
						$this->table_activator->owt7_library_tbl_users()
					];
					foreach($truncateTableNames as $table){
						$wpdb->query("TRUNCATE TABLE {$table}");
					}

					$directory = LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH . 'admin/sample-data';
					$files = array_diff(scandir($directory), array('..', '.'));

					$import_status = false;

					foreach ($files as $file) {

						$csvFilePath = $directory . "/" . $file;

						if(file_exists($csvFilePath)){

							if (pathinfo($file, PATHINFO_EXTENSION) == 'csv') {

								$file_name = pathinfo($file, PATHINFO_FILENAME);
								$csvFile = fopen($directory . "/" . $file, 'r');
	
								$data_columns = fgetcsv($csvFile);

								$csv_data = [];
								while (($row = fgetcsv($csvFile)) !== false) {
									$csv_data[] = $row;
								}
	
								fclose($csvFile);

								if (!empty($csv_data)) {

									global $wpdb;
									$table_name = "";
									$credit = base64_decode(LMS_FREE_VERSION_LIMIT);
	
									if($file_name == "categories"){
										$csv_data = array_slice($csv_data, 0, ($credit - 10));
										$table_name = $this->table_activator->owt7_library_tbl_category();
									} elseif($file_name == "books"){
										$csv_data = array_slice($csv_data, 0, $credit);
										$table_name = $this->table_activator->owt7_library_tbl_books();
									} elseif($file_name == "bookcases"){
										$csv_data = array_slice($csv_data, 0, ($credit - 10));
										$table_name = $this->table_activator->owt7_library_tbl_bookcase();
									} elseif($file_name == "sections"){
										$csv_data = array_slice($csv_data, 0, $credit);
										$table_name = $this->table_activator->owt7_library_tbl_bookcase_sections();
									} elseif($file_name == "branches"){
										$csv_data = array_slice($csv_data, 0, ($credit - 10));
										$table_name = $this->table_activator->owt7_library_tbl_branch();
									} elseif($file_name == "users"){
										$csv_data = array_slice($csv_data, 0, $credit);
										$table_name = $this->table_activator->owt7_library_tbl_users();
									}

									$eachRow = [];
									// Attach column with Data
									foreach($csv_data as $data){
										for($rowCount = 0; $rowCount < count($data_columns); $rowCount++){
											$eachRow[$data_columns[$rowCount]] = $data[$rowCount];
										}
										$wpdb->insert($table_name, $eachRow);
									}

									$import_status = true;
								}
							}
						}
					}

					if($import_status){
						// Test Data Flag
						update_option("owt7_lms_test_data", 1);
						
						$response = [
							1, 
							__("Successfully, Test Data Imported to LMS", "library-management-system")
						];
					}else{
						$response = [
							0, 
							__("Failed to Import Test data", "library-management-system")
						];
					}
				} elseif ( $param == "owt7_lms_remove_test_data" ){

					// Remove existing data
					$truncateTableNames = [
						$this->table_activator->owt7_library_tbl_category(),
						$this->table_activator->owt7_library_tbl_books(),
						$this->table_activator->owt7_library_tbl_bookcase(),
						$this->table_activator->owt7_library_tbl_bookcase_sections(),
						$this->table_activator->owt7_library_tbl_branch(),
						$this->table_activator->owt7_library_tbl_users()
					];
					foreach($truncateTableNames as $table){
						$wpdb->query("TRUNCATE TABLE {$table}");
					}

					delete_option("owt7_lms_test_data");
						
					$response = [
						1, 
						__("Successfully, Test Data Removed", "library-management-system")
					];
				} elseif ( $param == "owt7_pay_late_fine" ){

					$return_id = isset( $_REQUEST['return_id'] ) ? absint( base64_decode($_REQUEST['return_id']) ) : 0;

					$book_fine_details = $wpdb->get_row(
						"SELECT * FROM " . $this->table_activator->owt7_library_tbl_book_late_fine() . " WHERE return_id = {$return_id} and has_paid = 1"
					);

					if(!empty($book_fine_details)){
						$wpdb->update($this->table_activator->owt7_library_tbl_book_late_fine(), [
							"has_paid" => 2,
							"status" => 0
						], [
							"return_id" => $return_id
						]);
						$wpdb->update($this->table_activator->owt7_library_tbl_book_return(), [
							"has_fine_status" => 0
						], [
							"id" => $return_id
						]);
						$response = [
							1, 
							__("Successfully, Late Fine Paid.", "library-management-system")
						];
					}else{
						$response = [
							0, 
							__("Fine already paid", "library-management-system")
						];
					}
				} else{

					$response = [
						0, 
						__("Invalid LMS Operation", "library-management-system")
					];
				}
			}else{
	
				$response = [
					0, 
					__("Invalid LMS operation", "library-management-system")
				];
			}
		} else {
			
			$response = [
				0, 
				__("LMS actions blocked due to security reasons", "library-management-system")
			];
		}

		wp_send_json($this->json($response));

		wp_die();
	}
}
