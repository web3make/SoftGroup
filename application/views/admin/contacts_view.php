<?php $this->load->view('admin/blocks/adminheader_view');?>	

        <h3>Contacts Data</h3>
        <br />
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Contacts</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th>contact</th>
                    <th>Name</th>
                    <th>About</th>
                    <th>Slogan</th>
                    <th>Rank</th>
                    <th>F</th>
                    <th>G+</th>
                    <th>Tw</th>
                    <th>In</th>
                    <th>Bio</th>
                    <th style="width:150px;">Photo</th>
                    <th style="width:150px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                    <th>Contact</th>
                    <th>Name</th>
                    <th>About</th>
                    <th>Slogan</th>
                    <th>Rank</th>
                    <th>F</th>
                    <th>G+</th>
                    <th>Tw</th>
                    <th>In</th>
                    <th>bio</th>
                    <th>Photo</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/contacts/ajax_list')?>",
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
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Contacts'); // Set Title to Bootstrap modal title
$('[name="contact"]').prop('disabled', false);
    $('#photo-preview').hide(); // hide photo preview modal

    $('#label-photo').text('Upload Photo'); // label photo upload
}

function edit_person(contact)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/contacts/ajax_edit')?>/" + contact,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="contact"]').val(data.contact).prop('disabled', true);
            $('[name="name"]').val(data.name);
            $('[name="about"]').val(data.about);
            $('[name="slogan"]').val(data.slogan);
            $('[name="rank"]').val(data.rank);
            $('[name="soc_fb"]').val(data.soc_fb);
            $('[name="soc_gp"]').val(data.soc_gp);
            $('[name="soc_tw"]').val(data.soc_tw);
            $('[name="soc_in"]').val(data.soc_in);
            $('[name="bio"]').val(data.bio);
			
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Contacts'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.photo)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'images/'+data.photo+'" class="img-responsive">'); // show photo
                $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo

            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#photo-preview div').text('(No photo)');
            }


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
        url = "<?php echo site_url('admin/contacts/ajax_add')?>";
    } else {
		$('[name="contact"]').prop('disabled', false);
        url = "<?php echo site_url('admin/contacts/ajax_update')?>";
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

function delete_person(contact)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/contacts/ajax_delete')?>/"+contact,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Contacts Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="contact"/> 

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact</label>
                            <div class="col-md-9">
                                <input name="contact" placeholder="contact" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">About</label>
                            <div class="col-md-9">
                                <input name="about" placeholder="about" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Slogan</label>
                            <div class="col-md-9">
                                <input name="slogan" placeholder="slogan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Rank</label>
                            <div class="col-md-9">
                                <select name="rank" class="form-control">
                                    <option value="0">--Select Gender--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<!---->
                        <div class="form-group">
                            <label class="control-label col-md-3">Facebook link</label>
                            <div class="col-md-9">
                                <input name="soc_fb" placeholder="soc_fb" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>						
						
                        <div class="form-group">
                            <label class="control-label col-md-3">Google + link</label>
                            <div class="col-md-9">
                                <input name="soc_gp" placeholder="soc_gp" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>						
						
                        <div class="form-group">
                            <label class="control-label col-md-3">Twiter link</label>
                            <div class="col-md-9">
                                <input name="soc_tw" placeholder="soc_tw" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>						
						
                        <div class="form-group">
                            <label class="control-label col-md-3">LinkedIn link</label>
                            <div class="col-md-9">
                                <input name="soc_in" placeholder="soc_in" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>						
						<!---->
                        <div class="form-group">
                            <label class="control-label col-md-3">Bio</label>
                            <div class="col-md-9">
                                <textarea name="bio" placeholder="Bio" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Photo</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Upload Photo </label>
                            <div class="col-md-9">
                                <input name="photo" type="file">
                                <span class="help-block"></span>
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
<!-- End Bootstrap modal -->
</body>
</html>