<div class="page-content-wrap content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Polling Question</strong>
                    <button class="btn btn-success pull-right" onclick="add_polling()"><i class="glyphicon glyphicon-plus"></i> Add Polling Question</button>
                </div>
                <div class="panel-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Position</th>
                            <th>Status</th>
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
                "url": "<?php echo site_url('/admin/polling-question/list')?>",
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

    });

    function add_polling()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Polling Question'); // Set Title to Bootstrap modal title
        $('#position_id').empty();
        load_position();
    }


    function edit(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#position_id').empty();

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('/admin/polling-question/edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                load_position();
                $('[name="id"]').val(data.id); // put data ID to ID input box
                $('[name="question"]').val(data.question); // put data name to position input box
                $('#position_id').prepend($('<option value="' + data.position_id + '" selected>' + data.position + '</option>'));
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Polling Question'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    function status(id, status)
    {
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('/admin/polling-question/status')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                alert(id + status);
                reload_table();

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
            url = "<?php echo site_url('/admin/polling-question/create')?>";
        } else {
            url = "<?php echo site_url('/admin/polling-question/update')?>";
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
</script>

<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Polling Question Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Question</label>
                                <div class="col-md-9">
                                    <input name="question" placeholder="Question" class="form-control" type="text">
                                    <span class="help-block"></span>
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






