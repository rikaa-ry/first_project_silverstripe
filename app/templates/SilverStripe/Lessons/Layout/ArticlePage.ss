<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">Blog Detail</h1>
				
				<ul class="breadcrumb">
					<li><a href="#">Home </a></li>
					<li><a href="#">Travel Guides</a></li>
					<li><a href="#">Travel Guide Article</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE TITLE/BREADCRUMB -->


<!-- BEGIN CONTENT WRAPPER -->
<div class="content">
	<div class="container">
		<div class="row">
		
			<!-- BEGIN MAIN CONTENT -->
			<div class="main col-sm-8">
			
				<h1 class="blog-title">How to get your dream property for the best price?</h1>
				
				<div class="blog-main-image">
                    <% with $Photo.ScaleWidth(750) %>
                    <img class="my-custom-class" src="$URL" alt="" width="$Width" height="$Height" />
                    <% end_with %>
					<div class="tag"><i class="fa fa-file-text"></i></div>
				</div>
				
				<div class="blog-bottom-info">
					<ul>
						<li><i class="fa fa-calendar"></i> $Date.Nice</li>
						<li><i class="fa fa-comments-o"></i> 3 Comments</li>
						<li><i class="fa fa-tags"></i> 
						$CategoriesList
						</li>
					</ul>
					
					<div id="post-author"><i class="fa fa-pencil"></i> By $AuthorArticle</div>
				</div>
				
				<div class="post-content">
					<div class="highlight-bold">$Teaser</div>
					
					<div class="divider"></div>
					
					<p>Curabitur dapibus hendrerit dui, vel sagittis lectus laoreet et. Cras vitae purus dictum, fringilla urna sit amet, elementum leo. Etiam blandit enim eu arcu blandit sagittis. Aliquam ligula mi, luctus ut est non, hendrerit scelerisque eros. Integer a velit massa. Pellentesque eu convallis purus, nec elementum neque. Donec arcu elit, venenatis nec mauris convallis, suscipit elementum metus. Vivamus dictum turpis in venenatis auctor.</p>
					
					<img src="http://placehold.it/270x335" alt="" class="right" />
					<p>Vestibulum rhoncus consequat aliquet. Mauris varius posuere mattis. Duis vitae molestie arcu. Curabitur sollicitudin, velit ut eleifend auctor, nibh orci pharetra risus, a malesuada nisi felis vel turpis. Aliquam fermentum nulla felis, sed molestie libero porttitor in.</p>
					<p>Quisque ut dictum justo. Vestibulum lacinia arcu ac dui volutpat consectetur. Nulla dui mauris, consequat non aliquet vitae, volutpat at nunc. Sed eget hendrerit odio. Donec sagittis venenatis est ac fringilla.</p>
					<p>Phasellus suscipit aliquam nisl et porttitor. Suspendisse potenti. Fusce libero velit, tristique eu mauris vitae, convallis facilisis sapien. Mauris urna diam, fringilla sit amet eleifend id, commodo ac lorem. Curabitur at erat justo. Morbi tincidunt, nisi in hendrerit adipiscing, lacus orci pellentesque orci, ac tempus purus libero in lectus.</p>
					
					<div class="divider"></div>
					
					<div class="highlight-color">Donec suscipit, sapien quis vehicula dictum, massa odio posuere nisl, consectetur viverra purus dui vel elit.</div>
					
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse facilisis purus sed justo egestas dapibus. Etiam vel sagittis nisi. Curabitur ac egestas lorem. Sed ut odio iaculis, interdum magna non, mattis dolor. Vestibulum id dignissim elit. Cras ut scelerisque dolor. Vestibulum aliquet eu purus quis pellentesque. Nam eget lacus dolor. </p>
				
					<p class="quote">Vivamus suscipit <span>magna eu</span> turpis facilisis ornare. Aliquam ac ipsum dui. Nulla tincidunt orci nec elit dictum euismod ut  lectus <span>ultricies mollis</span> pellentesque.</p>
					
					<p>Phasellus pulvinar purus turpis, a consequat orci pellentesque vitae. Donec suscipit, sapien quis vehicula dictum, massa odio posuere nisl, consectetur viverra purus dui vel elit. Fusce tempor ante in metus egestas egestas.</p>
					
					<p>Sed in mauris consectetur lectus ultricies mollis. Nulla at vulputate mi. Phasellus mauris augue, sollicitudin nec ornare congue, posuere eget nulla. Vestibulum pulvinar mauris ut magna interdum lacinia. Nam eu viverra urna. Quisque turpis massa, gravida ut faucibus nec, faucibus non turpis. Mauris facilisis et est a mollis. Mauris non sagittis risus</p>
				</div>
				
				<div class="share-wraper col-sm-12 clearfix">
                    <% if $Brochure %>
                    <div class="row">
                        <% with $Brochure %>
                        <div class="col-sm-12"><a class="btn btn-warning btn-block" href="$Brochure.URL"> Download brochure [$Extension] ($Size)</a>
                        </div>
                        <% end_with %>
                    </div>
                    <% end_if %>
					<h5>Share this Post:</h5>
					<ul class="social-networks">
						<li><a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p%5Burl%5D=http%3A%2F%2Fwww.wiselythemes.com%2Fhtml%2Fcozy%2Fblog-detail.html%3Ffb%3Dtrue&amp;p%5Bimages%5D%5B0%5D=http%3A%2F%2Fwww.wiselythemes.com%2Fhtml%2Fcozy%2Fimages%2Fnews-img1.jpg&amp;p%5Btitle%5D=Cozy%20Blog%20Post"><i class="fa fa-facebook"></i></a></li>
						<li><a target="_blank" href="https://twitter.com/intent/tweet?url=http://www.wiselythemes.com/html/cozy/blog-detail.html&amp;text=Cozy%20Blog%20Post"><i class="fa fa-twitter"></i></a></li>
						<li><a target="_blank" href="https://plus.google.com/share?url=http://www.wiselythemes.com/html/cozy/blog-detail.html"><i class="fa fa-google"></i></a></li>
						<li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=http://www.wiselythemes.com/html/cozy/blog-detail.html&amp;description=Cozy%20Blog%20Post&amp;media=http%3A%2F%2Fwww.wiselythemes.com%2Fhtml%2Fcozy%2Fimages%2Fnews-img1.jpg"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="mailto:?subject=Check%20out%20this%20blog%20post%20from%20Cozy%20Real%20Estate!&amp;body=http://www.wiselythemes.com/html/cozy/blog-detail.html"><i class="fa fa-envelope"></i></a></li>
					</ul>
					
					<a class="print-button" href="javascript:window.print();">
						<i class="fa fa-print"></i>
					</a>
				</div>
				
				<h1 class="section-title">Comments</h1>
				
				<div class="comments">
					<ul>
						<% loop $Comments %>                        
						<li>
							<img src="images/comment-man.jpg" alt="" />
							<div class="comment">                                
								<h3>$Name<small>$Created.Format('j F, Y')</small></h3>
								<p>$Comment</p>
							</div>
						</li>
						<% end_loop %>
					</ul>
					
					<div class="comments-form">
						<div class="col-sm-12">
							<h3>Leave a Reply</h3>
							<p>Your email address will no be published. Required fields are marked*</p>
						</div>
					</div>
					$CommentForm
				</div>
			</div>	
			<!-- END MAIN CONTENT -->
			
			
			<!-- BEGIN SIDEBAR -->
			<div class="sidebar gray col-sm-4">
				
				<h2 class="section-title">Categories</h2>
				<ul class="categories">
					<li><a href="#">Business <span>(2)</span></a></li>
					<li><a href="#">Commercial <span>(1)</span></a></li>
					<li><a href="#">Land <span>(3)</span></a></li>
					<li><a href="#">Loans <span>(2)</span></a></li>
					<li><a href="#">News and Updates <span>(6)</span></a></li>
					<li><a href="#">Properties for Sale <span>(1)</span></a></li>
					<li><a href="#">Real Estate <span>(1)</span></a></li>
				</ul>
				
				<!-- BEGIN ARCHIVES ACCORDION -->
				<h2 class="section-title">Archives</h2>
				<div id="accordion" class="panel-group blog-accordion">
					<div class="panel">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
									<i class="fa fa-chevron-right"></i> 2014 (15)
								</a>
							</div>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<ul>
									<li><a href="#">July (3)</a></li>
									<li><a href="#">June (4)</a></li>
									<li><a href="#">May (1)</a></li>
									<li><a href="#">April (2)</a></li>
									<li><a href="#">March (3)</a></li>
									<li><a href="#">February (1)</a></li>
									<li><a href="#">January (1)</a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="panel">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
									<i class="fa fa-chevron-right"></i> 2013 (6)
								</a>
							</div>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li><a href="#">May (1)</a></li>
									<li><a href="#">April (2)</a></li>
									<li><a href="#">March (1)</a></li>
									<li><a href="#">February (2)</a></li>
									<li><a href="#">January (1)</a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="panel">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
									<i class="fa fa-chevron-right"></i> 2012 (5)
								</a>
							</div>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li><a href="#">April (1)</a></li>
									<li><a href="#">March (1)</a></li>
									<li><a href="#">February (2)</a></li>
									<li><a href="#">January (1)</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- END  ARCHIVES ACCORDION -->
				
				
				<!-- BEGIN TAGS -->
				<h2 class="section-title">Tags</h2>
				<ul class="tags col-sm-12">
					<li><a href="#">Apartments</a></li>
					<li><a href="#">Residential</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Real estate</a></li>
					<li><a href="#">Land</a></li>
					<li><a href="#">Business</a></li>
					<li><a href="#">Villas</a></li>
					<li><a href="#">Loans</a></li>
					<li><a href="#">Commercial</a></li>
					<li><a href="#">Rent</a></li>
				</ul>
				<!-- BEGIN TAGS -->
				
				
				<!-- BEGIN LATEST NEWS -->
				<h2 class="section-title">Latest News</h2>
				<ul class="latest-news">
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>
						
						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 30, 2014</li>
						</ul>
							
						<h3><a href="blog-detail.html">How to get your dream property for the best price?</a></h3>
					</li>
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>
						
						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 24, 2014</li>
						</ul>
							
						<h3><a href="blog-detail.html">7 tips to get the best mortgage.</a></h3>
					</li>
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>
						
						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 05, 2014</li>
						</ul>
						
						<h3><a href="blog-detail.html">House, location or price: What's the most important factor?</a></h3>
					</li>
				</ul>
				<!-- END LATEST NEWS -->
				
			</div>
			<!-- END SIDEBAR -->

		</div>
	</div>
</div>