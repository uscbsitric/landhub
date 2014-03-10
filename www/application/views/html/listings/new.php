
<div class="row" style="margin-top:32px;">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header pink-background">
                <div class="title">
                    <div class="icon-plus"></div>
                    New Listing
                </div>
                <div class="actions"></div>
            </div>
            <div class="box-content">
            	<form class="form form-horizontal" method="post" enctype="multipart/form-data" action="/listings/craigslistpreview">
            		<h3>Listings Options</h3>
                    <br>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="title">State <sup>*</sup></label>
						<div class="col-md-5">
							<select class="form-control" name="state" id="state">
								<option value="">Choose One</option>
								<?php foreach($states as $state): ?>
									<option value="<?php echo $state->abbreviation; ?>" > <?php echo $state->name; ?> </option>
								<?php endforeach; ?>
							</select>
						</div>
                    </div> <!-- form-group -->
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="city">City <sup>*</sup></label>
                        <div class="col-md-5">
                            <select class="form-control" name="city" id="city" disabled>
                            	<option value="">Choose One</option>
                            </select>
                        </div>
                    </div> <!-- form-group -->
                    
                    <div class="form-actions form-actions-padding-sm">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" name="submit" class="btn btn-primary" type="submit">
                                    <i class="icon-save"></i>
                                    Submit
                                </button>
                                <a class="btn" href="/admin/fields">Cancel</a>
                            </div>
                        </div>
                    </div> <!-- form-actions form-actions-padding-sm -->
           		</form>
           	</div> <!-- box-content -->
        </div> <!-- box -->
    </div> <!-- col-sm-12 -->
</div> <!-- row -->

<script type="text/javascript">
	function getCitiesBasedOnSelectedState(id)
	{
		$('#city').empty(); // removes all child nodes of an element named city
		$.ajax({type: "POST",
				url: "<?php echo URL::site('listings/getcities'); ?>",
				data: {stateID: id},
				dataType: 'json',
				success: function(data)
						 {
					 		$.each(data, function(key, value)
							 			 {
					 						$('#city').append("<option value=" + key + ">" + value + "</option>");
					 			 		 }
					 			  );
				 			$('#city').removeAttr('disabled');
					 	 }
			   }
			  );
	}


	$('#state').on( 'change', function()
							  {
		  						getCitiesBasedOnSelectedState($('#state').val());
		  					  }
			      );
	
</script>