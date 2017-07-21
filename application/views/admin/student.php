<div class="page-content-wrap content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Student</strong>
                    <button class="btn btn-success pull-right" onclick="add_student()"><i class="glyphicon glyphicon-plus"></i> Add Student</button>
                </div>
                <div class="panel-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Mobile Number</th>
                            <th>Grade & Section</th>
                            <th style="width:100px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker.js"></script>

<!-- START TEMPLATE -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/actions.js"></script>
<!-- END SCRIPTS -->

<script type="text/javascript">

    var save_method;
    var table;
    var base_url = '<?php echo base_url(); ?>';


    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('/admin/student/list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [ -2 ], //2 last column (photo)
                    "orderable": false, //set not orderable
                },
            ],

        });
        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });

    function add_student()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Student'); // Set Title to Bootstrap modal title
        load_select();
    }


    function edit_student(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[id="password"]').hide();
        $('[name="type"]').val('update');
        load_select();


        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('/admin/student/edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id"]').val(data.id); // put data ID to ID input box
                $('[name="student_id"]').val(data.student_id); // put data name to student input box
                $('[name="firstname"]').val(data.firstname); // put data name to student input box
                $('[name="middlename"]').val(data.middlename); // put data name to student input box
                $('[name="lastname"]').val(data.lastname); // put data name to student input box
                $('[name="email"]').val(data.email); // put data name to student input box
                $('[name="gender"]').val(data.gender); // put data name to student input box
                $('[name="dob"]').val(data.dob); // put data name to student input box
                $('[name="mobile"]').val(data.mobile); // put data name to student input box
                $('[name="grade_section"]').val(data.grade_section_id); // put data name to student input box
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Student'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from database');
            }
        });
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function load_select()
    {
        $.ajax({
            url: '<?php echo site_url('/admin/grade-section/select')?>',
            type: "GET",
            dataType: "JSON",
                success : function(data) {
                    if(data.success) {
                        $('#select').html(data.options);
                    }
                    else {
                        alert('Failed');
                    }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from database');
            }
        });
    }


    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('/admin/student/create')?>";
        } else {
            url = "<?php echo site_url('/admin/student/update')?>";
        }

        // ajax adding data to database

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }
</script>

<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Student Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <input type="hidden" value="" name="type"/>
                    <div class="form-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Student ID:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="student_id" placeholder="Enter Student ID..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="middlename" placeholder="Enter Middlename..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="lastname" placeholder="Enter Lastname..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email Address:</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email Address..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender:</label>
                                <div class="col-md-9">
                                    <select name="gender" class="form-control">
                                        <option value="">--Select Gender--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Date of Birth:</label>
                                <div class="col-md-9">
                                    <input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Mobile Number:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Grade & Section:</label>
                                <div class="col-md-9">
                                    <select id="select" name="grade_section" class="form-control">
                                        
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group" id="password">
                                <label class="control-label col-md-3">Password:</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group" id="password">
                                <label class="control-label col-md-3">Confirm Password:</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password2" placeholder="Confirm Password..." >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>






