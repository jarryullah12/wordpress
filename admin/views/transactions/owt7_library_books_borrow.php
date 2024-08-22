<div class="owt7-lms">

    <div class="lms-borrow-books">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span class="active"><?php _e("Borrow a Book", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_transactions" class="btn"><?php _e("Book(s) Borrow History", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_transactions&mod=books&fn=return" class="btn"><?php _e("Book(s) Return", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_transactions&mod=books&fn=return-history" class="btn"><?php _e("Book(s) Return History", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <h2><?php _e("Borrow a Book", "library-management-system"); ?></h2>
            </div>

            <form class="owt7_lms_borrow_book" id="owt7_lms_borrow_book" action="javascript:void(0);" method="post">

                <?php wp_nonce_field( 'owt7_library_actions', 'owt7_lms_nonce' ); ?>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone"><?php _e("Borrow Date", "library-management-system"); ?></label>
                        <input type="text" id="owt7_txt_borrow_date" name="owt7_txt_borrow_date"
                            value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="owt7_dd_branch_id"><?php _e("Branch", "library-management-system"); ?> <span class="required">*</span></label>
                        <select required id="owt7_dd_branch_id" name="owt7_dd_branch_id">
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
                    </div>
                    <div class="form-group">
                        <label for="owt7_dd_u_id"><?php _e("User", "library-management-system"); ?> <span class="required">*</span></label>
                        <select required id="owt7_dd_u_id" name="owt7_dd_u_id">
                            <option value=""><?php _e("-- Select User --", "library-management-system"); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="owt7_dd_category_id"><?php _e("Category", "library-management-system"); ?> <span class="required">*</span></label>
                        <select required id="owt7_dd_category_id" name="owt7_dd_category_id">
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
                    <div class="form-group">
                        <label for="owt7_dd_book_id"><?php _e("Book", "library-management-system"); ?> <span class="required">*</span></label>
                        <select required id="owt7_dd_book_id" name="owt7_dd_book_id">
                            <option value=""><?php _e("-- Select Book --", "library-management-system"); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="owt7_dd_days"><?php _e("Days", "library-management-system"); ?> <span class="required">*</span></label>
                        <select required id="owt7_dd_days" name="owt7_dd_days">
                            <option value=""><?php _e("-- Select Days --", "library-management-system"); ?></option>
                            <option value="7">7 <?php _e("Days", "library-management-system"); ?></option>
                            <option value="15">15 <?php _e("Days", "library-management-system"); ?></option>
                            <option value="30">30 <?php _e("Days", "library-management-system"); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-row buttons-group">
                    <button class="btn submit-save-btn" type="submit"><?php _e("Submit & Save", "library-management-system"); ?></button>
                </div>
            </form>

        </div>
    </div>

</div>
