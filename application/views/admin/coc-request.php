<div class="page-content-wrap content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>COC Request</strong>
                </div>
                <div class="panel-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name of Student</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Remarks</th>
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
                "url": "<?php echo site_url('/admin/candidate/coc-list')?>",
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

        $('#change').change(function(){
            $('#btnApprove').prop("disabled", !$(this).is(':checked'));
        });
    });

    function status(status)
    {
        $('[name="remarks"]').val(status);
        var formData = new FormData($('#form')[0]);

        $.ajax({
            url : "<?php echo site_url('/admin/candidate/update/remarks')?>",
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
                $('#btnApprove').text('Approve COC'); //change button text
                $('#btnApprove').attr('disabled',true); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnApprove').text('Approve COC'); //change button text
                $('#btnApprove').attr('disabled',true); //set button enable

            }
        });
    }


    function update(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('/admin/candidate/edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id); // put data ID to ID input box
                $('[name="action"]').val('update'); // put data ID to ID input box
                $('#fullname').html(data.firstname + ' ' + data.lastname);
                $('#id_student').html(data.student_id_number);
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
                    <input type="hidden" value="" name="remarks"/>
                    I, <label id="fullname"></label> and <label id="id_student"></label> are

                    <div id="checkBox">
                        <input type="checkbox" value="change" id="change" name="change"/>
                        <label for="change">Change Student?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnDecline" onclick="status('declined')" class="btn btn-primary">Decline COC</button>
                <button type="button" id="btnApprove" onclick="status('approved')" class="btn btn-primary" disabled>Approve COC</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>






