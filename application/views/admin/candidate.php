<div class="page-content-wrap content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>SSG</strong>
                    <button class="btn btn-success pull-right" onclick="add_candidate()"><i class="glyphicon glyphicon-plus"></i> Add Candidate</button>
                </div>
                <div class="panel-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Position</th>
                            <th>Partylist</th>
                            <th>Time</th>
                            <th>Date</th>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-timepicker.min.js"></script>

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
                "url": "<?php echo site_url('/admin/candidate/list')?>",
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

        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        $('#change').change(function(){
            $('[name="student_id"]').prop("disabled", !$(this).is(':checked'));

            if(this.checked) {
                $('[name="onChange_student"]').val('onChange_student');
            } else {
                $('[name="onChange_student"]').val('');
            }

        });

    });

    function add_candidate()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Candidate'); // Set Title to Bootstrap modal title
        $('#student_id').empty().attr('disabled',false);
        $('#position_id').empty();
        $('#partylist_id').empty();
        $('#checkBox').hide();
        load_student();
        load_position();
        load_partylist();
    }


    function edit(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#student_id').empty();
        $('#position_id').empty();
        $('#partylist_id').empty();
        $('#checkBox').show();

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('/admin/candidate/edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                load_student();
                load_position();
                load_partylist();
                $('[name="id"]').val(data.id); // put data ID to ID input box
                $('[name="action"]').val('update'); // put data ID to ID input box
                $('#student_id').prepend($('<option value="' + data.student_id + '" selected>' + data.student_id_number + '</option>')).attr('disabled',true);
                $('#position_id').prepend($('<option value="' + data.position_id + '" selected>' + data.position + '</option>'));
                $('#partylist_id').prepend($('<option value="' + data.partylist_id + '" selected>' + data.partylist + '</option>'));
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Candidate'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }


    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('/admin/candidate/create')?>";
        } else {
            url = "<?php echo site_url('/admin/candidate/update')?>";
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

    function load_student()
    {
        $.ajax({
            url: '<?php echo site_url('/admin/student/select')?>',
            type: "GET",
            dataType: "JSON",
            success : function(data) {
                if(data.success) {
                    $('#student_id').append(data.options);
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
    function load_position(){
        $.ajax({
            url: '<?php echo site_url('/admin/position/select')?>',
            type: "GET",
            dataType: "JSON",
            success : function(data) {
                if(data.success) {
                    $('#position_id').append(data.options);
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
    function load_partylist(){
        $.ajax({
            url: '<?php echo site_url('/admin/partylist/select')?>',
            type: "GET",
            dataType: "JSON",
            success : function(data) {
                if(data.success) {
                    $('#partylist_id').append(data.options);
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
</script>

<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Candidate Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <input type="hidden" value="" name="action"/>
                    <input type="hidden" value="" name="onChange_student"/>
                    <div class="form-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Student:</label>
                                <div class="col-md-9">
                                    <select id="student_id" name="student_id" class="form-control">

                                    </select>
                                    <span class="help-block"></span>

                                    <label id="checkBox">
                                        <input type="checkbox" value="change" id="change" name="change"/>
                                        Change Student?
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Position:</label>
                                <div class="col-md-9">
                                    <select id="position_id" name="position_id" class="form-control">

                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Partylist:</label>
                                <div class="col-md-9">
                                    <select id="partylist_id" name="partylist_id" class="form-control">

                                    </select>
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






