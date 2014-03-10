<div class="row" style="margin-top:32px;">
<div class="col-sm-12">
<div class="box">
<div class="box-header pink-background">
    <div class="title">
        <div class="icon-plus"></div>
        Property
    </div>
    <div class="actions"></div>
</div>
<div class="box-content">
<?php echo View::factory('html/validation/errors')->set('errors', @$errors); ?>
<form class="form form-horizontal" method="post" enctype="multipart/form-data">
<h3>Property Info</h3>
<br>
<div class="form-group">
    <label class="col-md-2 control-label" for="title">Title <sup>*</sup></label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="title" maxlength="64" value="<?php echo @$_POST['title']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="property_type_id">Property Type <sup>*</sup></label>
    <div class="col-md-5">
        <select class="form-control" name="property_type_id">
            <option value="">Choose One</option>
            <?php foreach($property_types as $type): ?>
                <option value="<?php echo $type->id; ?>" <?php if (@$_POST['property_type_id'] == $type->id) echo "selected=\"selected\""; ?>><?php echo $type->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="price">Price ($) <sup>*</sup></label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="price" value="<?php echo @$_POST['price']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="acres">Lot Size (Acres) <sup>*</sup></label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="acres" value="<?php echo @$_POST['acres']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="description">Description <sup>*</sup></label>
    <div class="col-md-5">
        <textarea class="form-control" name="description"><?php echo @$_POST['description']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="mls_id">MLS #</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="mls_id" value="<?php echo @$_POST['mls_id']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="mls_url">MLS URL</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="mls_url" value="<?php echo @$_POST['mls_url']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="is_private_financing_available">Private Financing Available</label>
    <div class="col-md-5">
        <select class="form-control" name="is_private_financing_available">
            <option value="">Choose One</option>
            <option value="1" <?php if(@$_POST['is_private_financing_available'] == "1") echo "selected=\"selected\""; ?>>Yes</option>
            <option value="0" <?php if(@$_POST['is_private_financing_available'] == "0") echo "selected=\"selected\""; ?>>No</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="is_for_sale_by_owner">For Sale By Owner</label>
    <div class="col-md-5">
        <select class="form-control" name="is_for_sale_by_owner">
            <option value="">Choose One</option>
            <option value="1" <?php if(@$_POST['is_for_sale_by_owner'] == "1") echo "selected=\"selected\""; ?>>Yes</option>
            <option value="0" <?php if(@$_POST['is_for_sale_by_owner'] == "0") echo "selected=\"selected\""; ?>>No</option>
        </select>
    </div>
</div>

<h3>Contact Info</h3>
<br>

<div class="form-group">
    <label class="col-md-2 control-label" for="company_name">Company Name</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="company_name" value="<?php echo @$_POST['company_name']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="contact_name">Contact Name <sup>*</sup></label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="contact_name" value="<?php echo @$_POST['contact_name']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="contact_email">Contact E-mail <sup>*</sup></label>
    <div class="col-md-5">
        <input type="email" class="form-control" name="contact_email" value="<?php echo @$_POST['contact_email']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="contact_phone">Contact Phone <sup>*</sup></label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="contact_phone" value="<?php echo @$_POST['contact_phone']; ?>">
    </div>
</div>

<h3>Location Info</h3>

<div class="form-group">
    <label class="col-md-2 control-label" for="address">Street Address</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="address" value="<?php echo @$_POST['address']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="zip_code">Zip Code <sup>*</sup></label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="zip_code" value="<?php echo @$_POST['zip_code']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="subdivision">Subdivision</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="subdivision" value="<?php echo @$_POST['subdivision']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="school_district">School District</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="school_district" value="<?php echo @$_POST['school_district']; ?>">
    </div>
</div>

<h3>House Details</h3>
<p><small>Leave fields blank when not applicable.</small></p>
<br>
<div class="form-group">
    <label class="col-md-2 control-label" for="beds">Bed(s)</label>
    <div class="col-md-5">
        <select class="form-control" name="beds">
            <option value=""    <?php if(@$_POST['beds'] == "") echo "selected=\"selected\""; ?>>Choose One</option>
            <option value="0"   <?php if(@$_POST['beds'] == "0") echo "selected=\"selected\""; ?>>0</option>
            <option value="0.5" <?php if(@$_POST['beds'] == "0.5") echo "selected=\"selected\""; ?>>0.5</option>
            <option value="1"   <?php if(@$_POST['beds'] == "1") echo "selected=\"selected\""; ?>>1</option>
            <option value="1.5" <?php if(@$_POST['beds'] == "1.5") echo "selected=\"selected\""; ?>>1.5</option>
            <option value="2"   <?php if(@$_POST['beds'] == "2") echo "selected=\"selected\""; ?>>2</option>
            <option value="2.5" <?php if(@$_POST['beds'] == "2.5") echo "selected=\"selected\""; ?>>2.5</option>
            <option value="3"   <?php if(@$_POST['beds'] == "3") echo "selected=\"selected\""; ?>>3</option>
            <option value="3.5" <?php if(@$_POST['beds'] == "3.5") echo "selected=\"selected\""; ?>>3.5</option>
            <option value="4"   <?php if(@$_POST['beds'] == "4") echo "selected=\"selected\""; ?>>3</option>
            <option value="4.5" <?php if(@$_POST['beds'] == "4.5") echo "selected=\"selected\""; ?>>4.5</option>
            <option value="5"   <?php if(@$_POST['beds'] == "5") echo "selected=\"selected\""; ?>>5</option>
            <option value="5.5" <?php if(@$_POST['beds'] == "5.5") echo "selected=\"selected\""; ?>>5.5</option>
            <option value="6"   <?php if(@$_POST['beds'] == "6") echo "selected=\"selected\""; ?>>6</option>
            <option value="6.5" <?php if(@$_POST['beds'] == "6.5") echo "selected=\"selected\""; ?>>6.5</option>
            <option value="7"   <?php if(@$_POST['beds'] == "7") echo "selected=\"selected\""; ?>>7</option>
            <option value="7.5" <?php if(@$_POST['beds'] == "7.5") echo "selected=\"selected\""; ?>>7.5</option>
            <option value="8"   <?php if(@$_POST['beds'] == "8") echo "selected=\"selected\""; ?>>8</option>
            <option value="8.5" <?php if(@$_POST['beds'] == "8.5") echo "selected=\"selected\""; ?>>8.5</option>
            <option value="9"   <?php if(@$_POST['beds'] == "9") echo "selected=\"selected\""; ?>>9</option>
            <option value="9.5" <?php if(@$_POST['beds'] == "9.5") echo "selected=\"selected\""; ?>>9.5</option>
            <option value="10"  <?php if(@$_POST['beds'] == "10") echo "selected=\"selected\""; ?>>10</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="baths">Bath(s)</label>
    <div class="col-md-5">
        <select class="form-control" name="baths">
            <option value=""    <?php if(@$_POST['baths'] == "") echo "selected=\"selected\""; ?>>Choose One</option>
            <option value="0"   <?php if(@$_POST['baths'] == "0") echo "selected=\"selected\""; ?>>0</option>
            <option value="0.5" <?php if(@$_POST['baths'] == "0.5") echo "selected=\"selected\""; ?>>0.5</option>
            <option value="1"   <?php if(@$_POST['baths'] == "1") echo "selected=\"selected\""; ?>>1</option>
            <option value="1.5" <?php if(@$_POST['baths'] == "1.5") echo "selected=\"selected\""; ?>>1.5</option>
            <option value="2"   <?php if(@$_POST['baths'] == "2") echo "selected=\"selected\""; ?>>2</option>
            <option value="2.5" <?php if(@$_POST['baths'] == "2.5") echo "selected=\"selected\""; ?>>2.5</option>
            <option value="3"   <?php if(@$_POST['baths'] == "3") echo "selected=\"selected\""; ?>>3</option>
            <option value="3.5" <?php if(@$_POST['baths'] == "3.5") echo "selected=\"selected\""; ?>>3.5</option>
            <option value="4"   <?php if(@$_POST['baths'] == "4") echo "selected=\"selected\""; ?>>3</option>
            <option value="4.5" <?php if(@$_POST['baths'] == "4.5") echo "selected=\"selected\""; ?>>4.5</option>
            <option value="5"   <?php if(@$_POST['baths'] == "5") echo "selected=\"selected\""; ?>>5</option>
            <option value="5.5" <?php if(@$_POST['baths'] == "5.5") echo "selected=\"selected\""; ?>>5.5</option>
            <option value="6"   <?php if(@$_POST['baths'] == "6") echo "selected=\"selected\""; ?>>6</option>
            <option value="6.5" <?php if(@$_POST['baths'] == "6.5") echo "selected=\"selected\""; ?>>6.5</option>
            <option value="7"   <?php if(@$_POST['baths'] == "7") echo "selected=\"selected\""; ?>>7</option>
            <option value="7.5" <?php if(@$_POST['baths'] == "7.5") echo "selected=\"selected\""; ?>>7.5</option>
            <option value="8"   <?php if(@$_POST['baths'] == "8") echo "selected=\"selected\""; ?>>8</option>
            <option value="8.5" <?php if(@$_POST['baths'] == "8.5") echo "selected=\"selected\""; ?>>8.5</option>
            <option value="9"   <?php if(@$_POST['baths'] == "9") echo "selected=\"selected\""; ?>>9</option>
            <option value="9.5" <?php if(@$_POST['baths'] == "9.5") echo "selected=\"selected\""; ?>>9.5</option>
            <option value="10"  <?php if(@$_POST['baths'] == "10") echo "selected=\"selected\""; ?>>10</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="year_built">Year Built</label>
    <div class="col-md-5">
        <select class="form-control" name="year_built">
            <option value="">Choose One</option>
            <?php for ($i=date('Y'); $i >= 1900; $i--): ?>
                <option value="<?php echo $i; ?>" <?php if(@$_POST['year_built'] == $i) echo "selected=\"selected\""; ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="sqft">Square Feet</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="sqft" value="<?php echo @$_POST['sqft']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="title">Levels</label>
    <div class="col-md-5">
        <select class="form-control" name="levels">
            <option value=""    <?php if(@$_POST['levels'] == "") echo "selected=\"selected\""; ?>>Choose One</option>
            <option value="1"   <?php if(@$_POST['levels'] == "1") echo "selected=\"selected\""; ?>>1</option>
            <option value="1.5" <?php if(@$_POST['levels'] == "1.5") echo "selected=\"selected\""; ?>>1.5</option>
            <option value="2"   <?php if(@$_POST['levels'] == "2") echo "selected=\"selected\""; ?>>2</option>
            <option value="2.5" <?php if(@$_POST['levels'] == "2.5") echo "selected=\"selected\""; ?>>2.5</option>
            <option value="3"   <?php if(@$_POST['levels'] == "3") echo "selected=\"selected\""; ?>>3</option>
            <option value="3.5" <?php if(@$_POST['levels'] == "3.5") echo "selected=\"selected\""; ?>>3.5</option>
            <option value="4"   <?php if(@$_POST['levels'] == "4") echo "selected=\"selected\""; ?>>3</option>
            <option value="4.5" <?php if(@$_POST['levels'] == "4.5") echo "selected=\"selected\""; ?>>4.5</option>
            <option value="5"   <?php if(@$_POST['levels'] == "5") echo "selected=\"selected\""; ?>>5</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="garage">Garage</label>
    <div class="col-md-5">
        <select class="form-control" name="garage">
            <option value="">Choose One</option>
            <option value="1" <?php if(@$_POST['garage'] == "1") echo "selected=\"selected\""; ?>>Yes</option>
            <option value="0" <?php if(@$_POST['garage'] == "0") echo "selected=\"selected\""; ?>>No</option>
        </select>
    </div>
</div>

<h3>Photos</h3>
<br>
<?php if ($photos->count() > 0): ?>

    <?php foreach($photos as $photo): ?>

        <img class="pull-left" width="150" src="<?php echo $photo->url; ?>" style="margin-right:16px; margin-bottom:32px;">

    <?php endforeach; ?>

    <div class="clearfix"></div>
    <br>

<?php endif; ?>
<div class="form-group">
    <label class="col-md-2 control-label" for="year_built">Add Photos</label>
    <div class="col-md-5">
        <input class="form-control" type="file" name="photos" multiple="multiple"><br>
        <small>You may upload up to <?php echo $remaining; ?> more <?php echo Inflector::plural('photo', $remaining); ?>.</small>
    </div>
</div>

<h3>Other</h3>
<br>

<div class="form-group">
    <label class="col-md-2 control-label" for="notes">Personal Notes</label>
    <div class="col-md-5">
        <textarea class="form-control" name="notes"><?php echo @$_POST['notes']; ?></textarea><br>
        <small>Personal notes are not public and will not be displayed on the property listing.</small>
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