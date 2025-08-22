<?php $this->load->view('includes/header.php');  ?>
        <!-- Page wrapper start -->
        <div class="page-wrapper">

            <!-- Sidebar wrapper start -->
            <?php $this->load->view('includes/sidebar.php');  ?>
            <!-- Sidebar wrapper end -->

            <!-- Page content start  -->
            <div class="page-content">

                <!-- Header start -->
                <?php $this->load->view('includes/topbar.php');  ?>
                <!-- Header end -->

                <!-- Page header start -->
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                    </ol>
                </div>
                <!-- Page header end -->

                <!-- Main container start -->
                <div class="main-container">

                    <!-- Row starts -->
                    <div class="row gutters">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tickets Status</div>
                                </div>
                                <div class="card-body">

                                    <!-- Row starts -->
                                    <div class="row gutters">
                                        <div class="col-xl-2 col-sm-4 col-12">
                                            <div class="ticket-status-card">
                                                <h6>Unresolved</h6>
                                                <h3>5290</h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-sm-4 col-12">
                                            <div class="ticket-status-card">
                                                <h6>Overdue</h6>
                                                <h3>770</h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-sm-4 col-12">
                                            <div class="ticket-status-card">
                                                <h6>Due Today</h6>
                                                <h3>25</h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-sm-4 col-12">
                                            <div class="ticket-status-card">
                                                <h6>Open</h6>
                                                <h3>1800</h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-sm-4 col-12">
                                            <div class="ticket-status-card">
                                                <h6>On Hold</h6>
                                                <h3>450</h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-sm-4 col-12">
                                            <div class="ticket-status-card">
                                                <h6>Unassigned</h6>
                                                <h3>275</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row ends -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

                    <!-- Row starts -->
                    <div class="row gutters">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tickets</div>
                                </div>
                                <div class="card-body">
                                    <div class="custom-btn-group" role="group">
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-rounded">Today</button>
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-rounded">Yesterday</button>
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-rounded">Last Week</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-rounded">Month</button>
                                    </div>
                                    <div id="tickets"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

                    <!-- Row starts -->
                    <div class="row gutters">
                        <div class="col-sm-6 col-12">
                            <div class="card h-250">
                                <div class="card-header">
                                    <div class="card-title">Support Requests</div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="support-requests"></div>
                                    <p class="text-center">
                                        <small class="text-success">*Received highest number of requests on Saturday.</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card h-250">
                                <div class="card-header">
                                    <div class="card-title">Complaints</div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="complaints"></div>
                                    <p class="text-center">
                                        <small class="text-danger">*Received highest number of complaints on Saturday.</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="overview-box2 h-250">
                                <i class="icon-alarm_on"></i>
                                <h5>Time to resolve complaint</h5>
                                <h4>7m:30s</h4>
                                <p>(Goal: 7m:0s)</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="overview-box2 orange h-250">
                                <i class="icon-av_timer"></i>
                                <h5>Average speed of answer</h5>
                                <h4>0m:15s</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

                    <!-- Row starts -->
                    <div class="row gutters">
                        <div class="col-xl-4 col-sm-12 col-12">
                            <div class="card h-320">
                                <div class="card-header">
                                    <div class="card-title">Avg Cost Per Support</div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="cost-per-support"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                            <div class="card h-320">
                                <div class="card-header">
                                    <div class="card-title">Traffic Analysis</div>
                                </div>
                                <div class="card-body">
                                    <div id="traffic-analysis"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                            <div class="card h-320">
                                <div class="card-header">
                                    <div class="card-title">Customer Ratings</div>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="user-ratings">
                                        <div class="total-ratings">
                                            <h2>5.0</h2>
                                            <div class="rating-stars">
                                                <div id="rate2"></div>
                                            </div>
                                        </div>
                                        <div class="ratings-list-container">
                                            <div class="ratings-list">
                                                <div class="rating-level">5.0</div>
                                                <div class="rating-stars">
                                                    <div class="rateA"></div>
                                                </div>
                                                <div class="total">
                                                    8,500 <span class="percentage">85%</span>
                                                </div>
                                            </div>
                                            <div class="ratings-list">
                                                <div class="rating-level">4.0</div>
                                                <div class="rating-stars">
                                                    <div class="rateB"></div>
                                                </div>
                                                <div class="total">
                                                    1,000 <span class="percentage">10%</span>
                                                </div>
                                            </div>
                                            <div class="ratings-list">
                                                <div class="rating-level">3.0</div>
                                                <div class="rating-stars">
                                                    <div class="rateC"></div>
                                                </div>
                                                <div class="total">
                                                    300 <span class="percentage">03%</span>
                                                </div>
                                            </div>
                                            <div class="ratings-list">
                                                <div class="rating-level">2.0</div>
                                                <div class="rating-stars">
                                                    <div class="rateD"></div>
                                                </div>
                                                <div class="total">
                                                    200 <span class="percentage">02%</span>
                                                </div>
                                            </div>
                                            <div class="ratings-list">
                                                <div class="rating-level">1.0</div>
                                                <div class="rating-stars">
                                                    <div class="rateE"></div>
                                                </div>
                                                <div class="total">
                                                    100 <span class="percentage">01%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

                </div>
                <!-- Main container end -->

            </div>
            <!-- Page content end -->

        </div>
        <!-- Page wrapper end -->

<?php $this->load->view('includes/script.php');  ?>