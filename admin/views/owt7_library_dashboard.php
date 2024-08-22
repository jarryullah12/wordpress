<div class="owt7-lms">

    <div class="jumbotron">
        <h1><?php _e("Welcome to Library Management System", "library-management-system"); ?><sup class="premium"><?php _e("Free", "library-management-system"); ?></sup><sup>v<?php echo LIBRARY_MANAGEMENT_SYSTEM_VERSION; ?></sup></h1>
    </div>

    <div class="lms-dashboard card-container">
        <!-- Card 1 -->
        <div class="card">
            <span class="dashicons dashicons-book"></span>
            <h2><?php _e("Manage Books", "library-management-system"); ?></h2>
            <a href="admin.php?page=owt7_library_books"><?php _e("View Books", "library-management-system"); ?></a>
        </div>
        <!-- Card 2 -->
        <div class="card">
            <span class="dashicons dashicons-admin-users"></span>
            <h2><?php _e("Manage Users", "library-management-system"); ?></h2>
            <a href="admin.php?page=owt7_library_users"><?php _e("View Users", "library-management-system"); ?></a>
        </div>
        <!-- Card 3 -->
        <div class="card">
            <span class="dashicons dashicons-archive"></span>
            <h2><?php _e("Manage Bookcase", "library-management-system"); ?></h2>
            <a href="admin.php?page=owt7_library_bookcases"><?php _e("View Bookcases", "library-management-system"); ?></a>
        </div>
        <!-- Card 4 -->
        <div class="card">
            <span class="dashicons dashicons-chart-bar"></span>
            <h2><?php _e("Transaction Reports", "library-management-system"); ?></h2>
            <a href="admin.php?page=owt7_library_transactions"><?php _e("View Reports", "library-management-system"); ?></a>
        </div>
        <!-- Card 5 -->
        <div class="card">
            <span class="dashicons dashicons-admin-tools"></span>
            <h2><?php _e("Settings", "library-management-system"); ?></h2>
            <a href="admin.php?page=owt7_library_settings"><?php _e("Configure Settings", "library-management-system"); ?></a>
        </div>
    </div>
</div>
