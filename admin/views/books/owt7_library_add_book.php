<div class="owt7-lms">

    <div class="owt7_library_add_book">

        <div class="page-header">
            <div class="breadcrumb"> <?php _e("Library System", "library-management-system"); ?> >> <span class="active"><?php _e("Add New Book", "library-management-system"); ?></span> </div>
            <div class="page-actions">
                <a href="admin.php?page=owt7_library_books&mod=category&fn=add" class="btn"><?php _e("Add New Category", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_books&mod=category&fn=list" class="btn"><?php _e("List Category", "library-management-system"); ?></a>
                <a href="admin.php?page=owt7_library_books" class="btn"><?php _e("List Book", "library-management-system"); ?></a>
            </div>
        </div>

        <div class="page-container">

            <div class="page-title">
                <?php if(isset($params['action'])){ ?> <h2><?php _e(ucfirst($params['action'])." Book", "library-management-system"); ?></h2>
                <?php }else{ ?> <h2><?php _e("Add Book", "library-management-system"); ?></h2> <?php } ?>
            </div>

            <form class="owt7_lms_book_form" id="owt7_lms_book_form" action="javascript:void(0);" method="post">

                <?php wp_nonce_field( 'owt7_library_actions', 'owt7_lms_nonce' ); ?>
                <input type="hidden" name="action_type"
                    value="<?php echo isset($params['action']) && !empty($params['action']) ? $params['action'] : 'add'; ?>">
                <?php 
                if(isset($params['action']) && $params['action'] == 'edit'){ 
                    ?>
                <div class="form-row buttons-group">
                    <input type="hidden" name="edit_id"
                        value="<?php echo isset($params['book']['id']) ? $params['book']['id'] : ''; ?>">
                </div>
                <?php
                } 
                ?>

                <div class="form-row">
                    <!-- Book ID -->
                    <div class="form-group">
                        <label for="owt7_txt_book_id"><?php _e("Book ID", "library-management-system"); ?> <span class="required">*</span> 
                            <?php if(isset($params['action']) && in_array($params['action'], ["view", "edit"])){}else{ ?>
                                <a href="javascript:void(0);" data-module="book" id="owt7_btn_ids_auto_generate"><u><?php _e('Auto-generate', 'library-management-system') ?></u>?</a>
                            <?php } ?>
                         </label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['book_id']) ? $params['book']['book_id'] : ''; ?>" required type="text" id="owt7_txt_book_id" <?php if(isset($params['action']) && in_array($params['action'], ["view", "edit"])){ ?>readonly<?php }else{} ?> name="owt7_txt_book_id" placeholder="...">
                    </div>
                    <!-- Category -->
                    <div class="form-group">
                        <label for="owt7_dd_category_id"><?php _e("Category", "library-management-system"); ?> <span class="required">*</span></label>
                        <select <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> required id="owt7_dd_category_id" name="owt7_dd_category_id">
                            <option value=""><?php _e("-- Select Category --", "library-management-system"); ?></option>
                            <?php 
                                if(!empty($params['categories']) && is_array($params['categories'])){
                                    foreach($params['categories'] as $category){
                                        $selected = "";
                                        if(isset($params['book']['category_id']) && $params['book']['category_id'] == $category->id){
                                            $selected = "selected";
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="<?php echo $category->id; ?>">
                                    <?php echo ucfirst($category->name); ?></option>
                                <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Bookcase -->
                    <div class="form-group">
                        <label for="owt7_dd_bookcase_id"><?php _e("Bookcase", "library-management-system"); ?> <span class="required">*</span></label>
                        <select <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> required id="owt7_dd_bookcase_id" name="owt7_dd_bookcase_id">
                            <option value=""><?php _e("-- Select Bookcase --", "library-management-system"); ?></option>
                            <?php 
                                if(!empty($params['bookcases']) && is_array($params['bookcases'])){
                                    foreach($params['bookcases'] as $bookcase){
                                        $selected = "";
                                        if(isset($params['book']['bookcase_id']) && $params['book']['bookcase_id'] == $bookcase->id){
                                            $selected = "selected";
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="<?php echo $bookcase->id; ?>">
                                    <?php echo ucfirst($bookcase->name); ?></option>
                                <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <!-- Section -->
                    <div class="form-group">
                        <label for="owt7_dd_section_id"><?php _e("Section", "library-management-system"); ?> <span class="required">*</span></label>
                        <select <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> required id="owt7_dd_section_id" name="owt7_dd_section_id">
                            <option value=""><?php _e("-- Select Section --", "library-management-system"); ?></option>
                            <?php 
                                if(!empty($params['sections']) && is_array($params['sections'])){
                                    foreach($params['sections'] as $section){
                                        $selected = "";
                                        if(isset($params['book']['bookcase_section_id']) && $params['book']['bookcase_section_id'] == $section->id){
                                            $selected = "selected";
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="<?php echo $section->id; ?>">
                                    <?php echo ucfirst($section->name); ?></option>
                                <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Book Name -->
                    <div class="form-group">
                        <label for="owt7_txt_book_name"><?php _e("Book Name", "library-management-system"); ?> <span class="required">*</span></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['name']) ? $params['book']['name'] : ''; ?>" required type="text" id="owt7_txt_book_name" name="owt7_txt_book_name" placeholder="...">
                    </div>
                    <!-- Author Name -->
                    <div class="form-group">
                        <label for="owt7_txt_author_name"><?php _e("Author(s) Name", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['author_name']) ? $params['book']['author_name'] : ''; ?>" type="text" id="owt7_txt_author_name" name="owt7_txt_author_name" placeholder="...">
                    </div>
                </div>

                <div class="form-row">
                    <!-- Publication Name -->
                    <div class="form-group">
                        <label for="owt7_txt_publication_name"><?php _e("Publication Name", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['publication_name']) ? $params['book']['publication_name'] : ''; ?>" type="text" id="owt7_txt_publication_name" name="owt7_txt_publication_name" placeholder="...">
                    </div>
                    <!-- Publication Year -->
                    <div class="form-group">
                        <label for="owt7_txt_publication_year"><?php _e("Publication Year", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['publication_year']) ? $params['book']['publication_year'] : ''; ?>" type="text" id="owt7_txt_publication_year" name="owt7_txt_publication_year" placeholder="...">
                    </div>
                </div>

                <div class="form-row">
                    <!-- Publication Location -->
                    <div class="form-group">
                        <label for="owt7_txt_publication_location"><?php _e("Publication Location", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['publication_location']) ? $params['book']['publication_location'] : ''; ?>" type="text" id="owt7_txt_publication_location" name="owt7_txt_publication_location" placeholder="...">
                    </div>
                    <div class="form-group">
                        <!-- Cost -->
                        <label for="owt7_txt_cost"><?php _e("Cost", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['amount']) ? $params['book']['amount'] : ''; ?>" type="number" min="0" max="100000" id="owt7_txt_cost" name="owt7_txt_cost" placeholder="...">
                    </div>
                </div>

                <div class="form-row">
                    <!-- ISBN -->
                    <div class="form-group">
                        <label for="owt7_txt_isbn"><?php _e("ISBN", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['isbn']) ? $params['book']['isbn'] : ''; ?>" type="text" id="owt7_txt_isbn" name="owt7_txt_isbn" placeholder="...">
                    </div>
                    <!-- Book URL -->
                    <div class="form-group">
                        <label for="owt7_txt_book_url"><?php _e("Book URL", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['book_url']) ? $params['book']['book_url'] : ''; ?>" type="text" id="owt7_txt_book_url" name="owt7_txt_book_url" placeholder="...">
                    </div>
                </div>

                <div class="form-row">
                    <!-- Stock Quantity -->
                    <div class="form-group">
                        <label for="owt7_txt_quantity"><?php _e("Stock Quantity", "library-management-system"); ?> <span class="required">*</span></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['stock_quantity']) ? $params['book']['stock_quantity'] : ''; ?>" type="number" min="1" max="1000000" required id="owt7_txt_quantity" name="owt7_txt_quantity" placeholder="...">
                    </div>
                    <!-- Book Language -->
                    <div class="form-group">
                        <label for="owt7_txt_book_language"><?php _e("Book Language", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['book_language']) ? $params['book']['book_language'] : ''; ?>" type="text" id="owt7_txt_book_language" name="owt7_txt_book_language" placeholder="...">
                    </div>
                </div>

                <div class="form-row">
                    <!-- Number of Pages -->
                    <div class="form-group">
                        <label for="owt7_txt_total_pages"><?php _e("Number of Page(s)", "library-management-system"); ?></label>
                        <input <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> value="<?php echo isset($params['book']['book_pages']) ? $params['book']['book_pages'] : ''; ?>" type="text" id="owt7_txt_total_pages" name="owt7_txt_total_pages" placeholder="...">
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="owt7_txt_description"><?php _e("Description", "library-management-system"); ?></label>
                        <textarea <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> name="owt7_txt_description" id="owt7_txt_description" cols="50" rows="4" placeholder="..."><?php echo isset($params['book']['description']) ? $params['book']['description'] : ''; ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Cover Image -->
                    <div class="form-group">
                        <label for="owt7_cover_image"><?php _e("Cover Image", "library-management-system"); ?></label>
                        <?php if(isset($params['action']) && $params['action'] == 'view'){ }else{ ?>
                        <button id="owt7_upload_image" type="button" class="btn btn-primary button-large">
                            <?php _e("Upload Cover Image", "library-management-system"); ?>
                        </button>
                        <?php } 
                                if(!empty($params['book']['cover_image'])){
                                    ?> <img src="<?php echo $params['book']['cover_image']; ?>"
                            id="owt7_library_image_preview" /> <?php
                                }else{
                                    ?> <img src="<?php echo LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_URL . 'admin/images/default-cover-image.png'; ?>" id="owt7_library_image_preview" /> <?php
                                } 
                        ?>
                        <input type="hidden" value="<?php echo isset($params['book']['cover_image']) ? $params['book']['cover_image'] : LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_URL . 'admin/images/default-cover-image.png'; ?>" name="owt7_cover_image" id="owt7_image_url" />
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="owt7_dd_book_status"><?php _e("Status", "library-management-system"); ?> <span class="required">*</span></label>
                        <select <?php echo isset($params['action']) && $params['action'] == 'view' ? 'disabled' : ''; ?> id="owt7_dd_book_status" required name="owt7_dd_book_status">
                            <option value=""><?php _e("-- Select Status --", "library-management-system"); ?></option>
                            <?php 
                            if(!empty($params['statuses']) && is_array($params['statuses'])){
                                foreach($params['statuses'] as $key => $status){
                                    $selected = "";
                                    if(isset($params['book']['status']) && $params['book']['status'] == $key){
                                        $selected = "selected";
                                    }
                                    ?>
                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo ucfirst($status); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <?php if(isset($params['action']) && $params['action'] == 'view'){ }else{ ?>
                <div class="form-row buttons-group">
                    <button class="btn submit-save-btn" type="submit"><?php _e("Submit & Save", "library-management-system"); ?></button>
                </div>
                <?php } ?>

            </form>

        </div>
    </div>