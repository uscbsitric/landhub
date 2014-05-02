    							<!--
    							<link type="text/css" rel="stylesheet" media="all" href="//www.craigslist.org/styles/cl.css?v=4da58c838e789a9dba315e92308da29c">
							    <link type="text/css" rel="stylesheet" media="all" href="//www.craigslist.org/styles/jquery-ui-1.9.2.custom.css?v=3f1b9638a5222b05bec93117fa889ee5">
							    <link type="text/css" rel="stylesheet" media="all" href="//www.craigslist.org/styles/leaflet-stock.css?v=84d3c834332cbea762f0ab54db54c578">
							    -->
	<form class="form form-horizontal" method="post" enctype="multipart/form-data" action="/listings/craigslistpost">
		<input type="hidden" name="propertyID" value="<?php echo $property->id; ?>">
		<input type="hidden" name="cityID" 	   value="<?php echo $otherDetails['cityID']; ?>">
		<div class="posting shadow">
			<br>
			<h2 class="postingtitle">
			  <span class="star"></span>
			  &#x0024;<?php echo $property->price; ?> / <?php echo $property->beds; ?>br - <?php echo $property->sqft?>ft&sup2; - <?php echo $property->title; ?> (<?php echo $otherDetails['city'] ;?>)
			</h2>
	
			<section class="userbody">
				<figure class="iw">
						<div id="ci">
							<img id="iwi" src="<?php echo $otherDetails['propertyPhoto']->url; ?>" alt="" title="<?php echo $otherDetails['propertyPhoto']->caption; ?>">
						</div>
				</figure>

					<!--
					<div class="mapAndAttrs">
						<div class="mapbox">
							<div id="map" class="leaflet-container leaflet-fade-anim" data-longitude="-85.4682" data-latitude="32.5475" tabindex="0">
								<div class="leaflet-map-pane">
									<div class="leaflet-tile-pane"></div>
									<div class="leaflet-objects-pane">
										<div class="leaflet-shadow-pane"></div>
										<div class="leaflet-overlay-pane"></div>
										<div class="leaflet-marker-pane"></div>
										<div class="leaflet-popup-pane"></div>
									</div>
								</div>
								<div class="leaflet-control-container">
									<div class="leaflet-top leaflet-left">
										<div class="leaflet-control-zoom leaflet-bar leaflet-control">
											<a class="leaflet-control-zoom-in" href="#" title="Zoom in">
												+
											</a>
											<a class="leaflet-control-zoom-out" href="#" title="Zoom out">
												-
											</a>
										</div>
									</div>
									<div class="leaflet-top leaflet-right"></div>
									<div class="leaflet-bottom leaflet-left"></div>
									<div class="leaflet-bottom leaflet-right">
										<div class="leaflet-control-attribution leaflet-control"></div>
									</div>
								</div>
							</div>
							<p class="mapaddress">
								<small>
									(<a href="https://maps.google.com/maps/preview/@32.5475,-85.4682,16z" target="_blank"></a>)
									(<a href="http://maps.yahoo.com/#mvt=m&lat=32.5475&lon=-85.4682&zoom=16" target="_blank"></a>)
								</small>
							</p>
						</div>
					</div>
					-->
		
				<p class="attrgroup"><span><b><?php echo $property->beds; ?></b>BR / <b><?php echo $property->baths; ?></b>Ba</span> <span><b><?php echo $property->sqft; ?></b>ft<sup>2</sup></span>  <!--<span></span><br> <span>laundry on site</span> <span>carport</span> --></p>
	
				<section id="postingbody">
					<?php echo $property->description; ?>
				</section>
				<br><br>
				<section id="postingCommands">
					<button type="submit" name="submit" class="btn btn-primary" type="submit">
						<i class="icon-save"></i>
							Publish
					</button>
				</section>
			</section>
		</div>
	</form>

	<section class="cltags"><!-- START CLTAGS -->
		<ul class="blurbs" style="display: none">
		<li> <!-- CLTAG GeographicArea=auburn -->Location: auburn</li>
		<li>do NOT contact me with unsolicited services or offers</li></ul><!-- END CLTAGS -->
	</section>