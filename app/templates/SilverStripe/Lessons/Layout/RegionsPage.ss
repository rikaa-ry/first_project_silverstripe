
<!-- BEGIN CONTENT WRAPPER -->
<div class="content">
    <div class="container">
        <div class="row">

            <!-- BEGIN SIDEBAR -->
            <div class="sidebar gray col-sm-4">


                <!-- BEGIN LATEST NEWS -->
                <h2 class="section-title">Popular articles</h2>
                <ul class="latest-news">
                <% loop LatestArticles(3) %>
                    <li class="col-md-12">
                        <div class="image">
                            <a href="blog-detail.html"></a>
                            $Photo.Fit(100,100)
                        </div>

                        <ul class="top-info">
                            <li><i class="fa fa-calendar"></i> $Date.Nice </li>
                        </ul>

                        <h4><a href="$Link">$Title</a></h4>
                    </li>
                <% end_loop %>

                </ul>
                <!-- END LATEST NEWS -->

            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN MAIN CONTENT -->
            <div class="main col-sm-8">


                <!-- BEGIN BLOG LISTING -->
                <div class="grid-style1 clearfix">
                    <% loop $Regions %>
                        <div class="item col-md-12"><!-- Set width to 4 columns for grid view mode only -->
                            <div class="image image-large">
                                <a href="$Link">
                                    <span class="btn btn-default"><i class="fa fa-file-o"></i> Read More</span>
                                </a>
                                $Photo.Fit(720,255)
                            </div>
                            <div class="info-blog">
                                <h3>
                                    <a href="$Link">$Title</a>
                                </h3>
                                <p>$Description.FirstParagraph</p>
                            </div>
                        </div>
                    <% end_loop %>
                </div>
                <!-- END BLOG LISTING -->


                <!-- BEGIN PAGINATION -->
                <div class="pagination">
                    <ul id="previous">
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    </ul>
                    <ul>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                    </ul>
                    <ul id="next">
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
                <!-- END PAGINATION -->

            </div>
            <!-- END MAIN CONTENT -->

        </div>
    </div>
</div>
<!-- END CONTENT WRAPPER -->
