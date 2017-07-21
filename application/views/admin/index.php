        <!-- END X-NAVIGATION VERTICAL -->
        <div class="page-content-wrap">
            <p class="alert alert-success"> Welcome to the admin section.</p>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="col-xs-3">
                                <div class="icon"><i class="fa fa-address-book-o fa-5x"></i></div>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="widget-big-count num inline" data-start="0" data-end="210" data-postfix=""
                                     data-duration="1500" data-delay="0">201
                                </div>
                                <label class="widget-big-count inline"></label>
                                <div class="widget-title-fixed">TOTAL TRAINER</div>
                            </div>
                        </div>

                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View More..</span>
                                <span class="pull-right"><i class="fa fa-eye"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="col-xs-3">
                                <div class="icon"><i class="fa fa-tags fa-5x"></i></div>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="widget-big-count num inline" data-start="0" data-end="210" data-postfix=""
                                     data-duration="1500" data-delay="0">201
                                </div>
                                <label class="widget-big-count inline"></label>
                                <div class="widget-title-fixed">TOTAL ARTICLE</div>
                            </div>
                        </div>

                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View More..</span>
                                <span class="pull-right"><i class="fa fa-eye"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="col-xs-3">
                                <div class="icon"><i class="fa fa-cutlery fa-5x"></i></div>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="widget-big-count num inline" data-start="0" data-end="210" data-postfix=""
                                     data-duration="1500" data-delay="0">201
                                </div>
                                <label class="widget-big-count inline"></label>
                                <div class="widget-title-fixed">TOTAL DIET PLAN</div>
                            </div>
                        </div>

                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View More..</span>
                                <span class="pull-right"><i class="fa fa-eye"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="col-xs-3">
                                <div class="icon"><i class="fa fa-user fa-5x"></i></div>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="widget-big-count num inline" data-start="0" data-end="210" data-postfix=""
                                     data-duration="1500" data-delay="0">201
                                </div>
                                <label class="widget-big-count inline"></label>
                                <div class="widget-title-fixed">TOTAL MEMBER</div>
                            </div>
                        </div>

                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View More..</span>
                                <span class="pull-right"><i class="fa fa-eye"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- START LINE CHART -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Members</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-line-example" style="height: 300px;"></div>
                        </div>
                    </div>
                    <!-- END LINE CHART -->

                </div>
                <div class="col-md-6">
                    <!-- START Area CHART -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Article</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-area-example" style="height: 300px;"></div>
                        </div>
                    </div>
                    <!-- END Area CHART -->

                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- START SCRIPTS -->

<!-- START PLUGINS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.min.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/morris/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/morris/morris.min.js"></script>
<script type="text/javascript">
    var morrisCharts = function () {

        Morris.Line({
            element: 'morris-line-example',
            data: [
                {m: 'Jan', a: 150},
                {m: 'Feb', a: 128},
                {m: 'Mar', a: 138},
                {m: 'Apr', a: 105},
                {m: 'May', a: 180},
                {m: 'Jun', a: 145},
                {m: 'Jul', a: 100},
                {m: 'Aug', a: 133},
                {m: 'Sep', a: 110},
                {m: 'Oct', a: 90},
                {m: 'Nov', a: 175},
                {m: 'Dec', a: 150}
            ],
            xkey: 'm',
            ykeys: ['a'],
            parseTime: false,
            labels: ['Series A'],
            resize: true,
            lineColors: ['#46CCAE']
        });


        Morris.Area({
            element: 'morris-area-example',
            data: [
                {m: 'Jan', a: 150},
                {m: 'Feb', a: 128},
                {m: 'Mar', a: 138},
                {m: 'Apr', a: 125},
                {m: 'May', a: 130},
                {m: 'Jun', a: 145},
                {m: 'Jul', a: 130},
                {m: 'Aug', a: 133},
                {m: 'Sep', a: 120},
                {m: 'Oct', a: 160},
                {m: 'Nov', a: 175},
                {m: 'Dec', a: 150}
            ],
            xkey: 'm',
            ykeys: ['a'],
            parseTime: false,
            labels: ['Series A'],
            resize: true,
            lineColors: ['#46CCAE']
        });

    }();
</script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/actions.js"></script>
<!-- END SCRIPTS -->
</body>
</html>






