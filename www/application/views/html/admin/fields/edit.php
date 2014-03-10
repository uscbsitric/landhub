<div class="row" style="margin-top:32px;">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header pink-background">
                <div class="title">
                    <div class="icon-plus"></div>
                    Custom Field
                </div>
                <div class="actions"></div>
            </div>
            <div class="box-content">
                <?php echo View::factory('html/validation/errors')->set('errors', @$errors); ?>
                <form class="form form-horizontal" style="margin-bottom: 0;" method="post" action="#" accept-charset="UTF-8">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Slug</label>
                        <div class="col-md-5">
                            <input id="name" name="name" class="form-control" placeholder="first_name" type="text" value="<?php echo Security::xss_clean(@$_POST["name"]); ?>" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="label">Label</label>
                        <div class="col-md-5">
                            <input id="name" name="label" class="form-control" placeholder="First Name" type="text" value="<?php echo Security::xss_clean(@$_POST["label"]); ?>" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="field_type">Field Type</label>
                        <div class="col-md-5">
                            <select name="field_type" required="required" class="form-control">
                                <option value="text" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'text'): echo "selected=\"selected\""; endif; ?>>Text</option>
                                <option value="textarea" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'textarea'): echo "selected=\"selected\""; endif; ?>>Textarea</option>
                                <option value="boolean" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'boolean'): echo "selected=\"selected\""; endif; ?>>Boolean (True/False)</option>
                                <option value="select" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'select'): echo "selected=\"selected\""; endif; ?>>Select</option>
                                <option value="multiselect" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'multiselect'): echo "selected=\"selected\""; endif; ?>>Multi-Select</option>
                                <option value="image" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'image'): echo "selected=\"selected\""; endif; ?>>Image</option>
                                <option value="images" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'images'): echo "selected=\"selected\""; endif; ?>>Multiple Images</option>
                                <option value="state" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'state'): echo "selected=\"selected\""; endif; ?>>State</option>
                                <option value="zipcode" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'zipcode'): echo "selected=\"selected\""; endif; ?>>Zip Code</option>
                                <option value="coordinates" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'coordinates'): echo "selected=\"selected\""; endif; ?>>GPS Coordinates</option>
                                <option value="phone" <?php if(Security::xss_clean(@$_POST["field_type"]) == 'phone'): echo "selected=\"selected\""; endif; ?>>Phone</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group data_source" style="display:none;">
                        <label class="col-md-2 control-label" for="default_value">Data Source</label>
                        <div class="col-md-5">
                            <input id="name" name="data_source" class="form-control" placeholder="" type="text" value="<?php echo Security::xss_clean(@$_POST["data_source"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="default_value">Default Value (optional)</label>
                        <div class="col-md-5">
                            <input id="name" name="default_value" class="form-control" placeholder="" type="text" value="<?php echo Security::xss_clean(@$_POST["default_value"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="is_required">Is Required?</label>
                        <div class="col-md-5">
                            <select name="is_required" required="required" class="form-control">
                                <option value="1" <?php if(Security::xss_clean(@$_POST["is_required"]) == 1): echo "selected=\"selected\""; endif; ?>>Yes</option>
                                <option value="0" <?php if(isset($_POST['is_required']) && Security::xss_clean(@$_POST["is_required"]) == 0): echo "selected=\"selected\""; endif; ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="is_required">Is Visible Field?</label>
                        <div class="col-md-5">
                            <select name="is_visible" required="required" class="form-control">
                                <option value="1" <?php if(Security::xss_clean(@$_POST["is_visible"]) == 1): echo "selected=\"selected\""; endif; ?>>Yes</option>
                                <option value="0" <?php if(isset($_POST['is_visible']) && Security::xss_clean(@$_POST["is_visible"]) == 0): echo "selected=\"selected\""; endif; ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions form-actions-padding-sm">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" name="submit" class="btn btn-primary" type="submit">
                                    <i class="icon-save"></i>
                                    Save
                                </button>
                                <a class="btn" href="/admin/fields">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
       $('select[name=field_type]').change(function() {
           var val = $(this).val();
           if(val == 'select' || val == 'multiselect') {
               $('.data_source').show();
           } else {
               $('.data_source').hide();
           }
       });
    });
</script>