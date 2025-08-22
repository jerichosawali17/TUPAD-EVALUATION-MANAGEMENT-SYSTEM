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
                <li class="breadcrumb-item active">Batches</li>
            </ol>
        </div>
        <!-- Page header end -->

        <!-- Main container start -->
        <div class="main-container">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
                <div class="col-sm-6">
                    <h3 class="display-5 mb-2 text-gray-800">Batches</h3>
                </div>
                <div class="col-sm-6">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-plus"></i> Add Batch
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" data-toggle="modal" data-target="#batchModal">TUPAD  Beneficiaries</button>
                            <button class="dropdown-item" data-toggle="modal" data-target="#brgyModal">Barangay Officials</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <div class="mb-3 col-sm-3">
                    <label>Show by</label>
                    <select type="text" id="category" class="form-control">
                        <option>TUPAD BENEFICIARIES</option>
                        <option>BARANAGY OFFICIALS</option>
                    </select>
                </div>
                
                <div class="mb-3 col-sm-3">
                    <label>City/Municipality</label>
                    <select type="text" id="municipality" class="form-control">
                        <option value="">Select from</option>
                        <option value="PROVINCEWIDE">PROVINCEWIDE</option>
                        <option>PUERTO GALERA</option>
                        <option>SAN TEODORO</option>
                        <option>BACO</option>
                        <option>CALAPAN CITY</option>
                        <option>NAUJAN</option>
                        <option>VICTORIA</option>
                        <option>SOCORRO</option>
                        <option>POLA</option>
                        <option>PINAMALAYAN</option>
                        <option>GLORIA</option>
                        <option>BANSUD</option>
                        <option>BONGABONG</option>
                        <option>ROXAS</option>
                        <option>MANSALAY</option>
                        <option>BULALACAO</option>
                    </select>
                </div>
                <div class="mb-3 col-sm-3">
                    <label>Status</label>
                    <select type="text" id="batch_status" class="form-control">
                        <option value="">Select from</option>
                        <option>UPDATED</option>
                        <option>NOT UPDATED</option>
                    </select>
                </div>
                <div class="mb-3 col-sm-3">
                    <label>Month</label>
                    <select type="text" id="month_added" class="form-control">
                        <option value="">Select from</option>
                    </select>
                </div>
                <div class="col-sm-12">
                    <div class="mb-2 mt-0 d-none" id="loader">
                        <div class="spinner-border spinner-border-sm text-primary">
                            <span class="sr-only"></span>
                        </div>
                        <span> Loading list. Please wait...</span>
                    </div>

                    <div class="table-container" id="batch-table-div">
                        <div class="t-header">Batch List</div>
                        <div class="table-responsive">
                            <table id="batch-table" class="table custom-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="align-middle">Batch No</th>
                                        <th class="align-middle">Batch name</th>
                                        <th class="align-middle">City/Municipality</th>
                                        <th class="align-middle">No. of <br>Beneficiaries</th>
                                        <th class="align-middle">Status</th>
                                        <th class="align-middle">Active Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="table-container d-none" id="brgy-table-div">
                        <div class="t-header">Barangay Official List</div>
                        <div class="table-responsive">
                            <table id="brgy-table" class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First name</th>
                                        <th>Middle name</th>
                                        <th>Last name</th>
                                        <th>City</th>
                                        <th>Barangay</th>
                                        <th>Position</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Row end -->
            <?php $this->load->view('includes/footer.php');  ?>
        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="batchModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batchModal">INSERT BATCH</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="batch_form" accept-charset="utf-8" >
                <div class="modal-body">
                    <div class="row gutters">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row gutters">
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">Batch name</label>
                                                <input type="text" class="form-control" name="batch_name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputName" class="font-weight-bold">City/Municipality</label>
                                                <select class="form-control selectpicker" name="city" data-live-search="true">
                                                    <option value="">Select from</option>
                                                    <option value="PROVINCEWIDE">PROVINCEWIDE</option>
                                                    <option>PUERTO GALERA</option>
                                                    <option>SAN TEODORO</option>
                                                    <option>BACO</option>
                                                    <option>CALAPAN CITY</option>
                                                    <option>NAUJAN</option>
                                                    <option>VICTORIA</option>
                                                    <option>SOCORRO</option>
                                                    <option>POLA</option>
                                                    <option>PINAMALAYAN</option>
                                                    <option>GLORIA</option>
                                                    <option>BANSUD</option>
                                                    <option>BONGABONG</option>
                                                    <option>ROXAS</option>
                                                    <option>MANSALAY</option>
                                                    <option>BULALACAO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">No. of beneficiaries</label>
                                                <input type="number" class="form-control" name="no_of_benef">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">ADL No.</label>
                                                <input type="text" class="form-control" id="adl-no" name="adl" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">Upload Beneficiaries (CSV File)</label>
                                                <input type="file" class="form-control" id="csv_file" name="csv_file">
                                                <button type="button" id="see-beneficiaries" class="btn btn-default btn-sm float-right mt-1">See beneficiaries</button>
                                                <div id="benef_-loader" class="mt-1 d-none">
                                                    <div class="spinner-border spinner-border-sm text-primary">
                                                        <span class="sr-only"></span>
                                                    </div>
                                                    <span> Loading list. Please wait...</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="show"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save_bacth">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="brgyModal" tabindex="-1" role="dialog" aria-labelledby="brgyModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brgyModal">INSERT BARANGYA OFFICIALS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="brgy_form" accept-charset="utf-8" >
                <div class="modal-body">
                    <div class="row gutters">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row gutters">
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">Upload List of Barangay Officials (CSV File)</label>
                                                <input type="file" class="form-control" id="brgy_file" name="brgy_file">
                                            </div>
                                        </div>
                                        <div id="show"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editBatchModal" tabindex="-1" role="dialog" aria-labelledby="editBatchModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="editBatchModal">EDIT BATCH</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_batch_form">
                <div class="modal-body">
                    <div class="row gutters">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row gutters">
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">Batch name</label>
                                                <input type="hidden" class="form-control" id="batch_id" name="batch_id">
                                                <input type="text" class="form-control" id="batch_name" name="batch_name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputName" class="font-weight-bold">City/Municipality</label>
                                                <select class="form-control" id="city" name="city">
                                                    <option value="">Select from</option>
                                                    <option value="PROVINCEWIDE">PROVINCEWIDE</option>
                                                    <option>PUERTO GALERA</option>
                                                    <option>SAN TEODORO</option>
                                                    <option>BACO</option>
                                                    <option>CALAPAN CITY</option>
                                                    <option>NAUJAN</option>
                                                    <option>VICTORIA</option>
                                                    <option>SOCORRO</option>
                                                    <option>POLA</option>
                                                    <option>PINAMALAYAN</option>
                                                    <option>GLORIA</option>
                                                    <option>BANSUD</option>
                                                    <option>BONGABONG</option>
                                                    <option>ROXAS</option>
                                                    <option>MANSALAY</option>
                                                    <option>BULALACAO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">No. of beneficiaries</label>
                                                <input type="number" class="form-control" id="no_of_benef" name="no_of_benef">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputName" class="font-weight-bold">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select from</option>
                                                    <option>UPDATED</option>
                                                    <option>NOT UPDATED</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputName" class="font-weight-bold">Active Status</label>
                                                <select class="form-control" name="active_status" id="active_status">
                                                    <option value="">Select from</option>
                                                    <option value="1">ACTIVE</option>
                                                    <option value="0">NOT ACTIVE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">ADL No.</label>
                                                <input type="text" class="form-control" id="adl" name="adl">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">Date Uploaded</label>
                                                <input type="date" class="form-control" id="date_uploaded" name="date_uploaded">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="edit_batch_btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="benefModal" tabindex="-1" role="dialog" aria-labelledby="batchModal" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 1400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batchModal">LIST OF BENEFICIARIES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-container">
                    <div class="table-responsive">
                        <div id="show_benef_list"></div>
                    </div>
                    <div class="container m-1">
                        <span class="font-weight-bold">Legends: </span>&nbsp;
                        <span class="badge badge-success"><i class="bi bi-person-fill"></i> Senior Citizen</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/script.php');  ?>

<script>
    $('#nav-batches').addClass("active");

    var cleave = new Cleave('#adl-no', {
        delimiter: '-',
        blocks: [4, 2, 4],
        uppercase: true
    });

    batchList()
    month_added()

    function batchList(city = "", status = "", month = "")
    {
        var batchList = $('#batch-table').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?php echo base_url(); ?>batches/batchList',
                'type':"POST",
                'data':{
                    city: city,
                    status: status,
                    month: month
                }
            },
            'columns': [
                { data: 'id' },
                { data: 'batch_id' },
                { data: 'batch_name' },
                { data: 'city' },
                { data: 'no_of_benef' },
                { data: 'status' },
                { data: 'active_status' },
                ]
        });
    }

    function brgyList(city = "")
    {
        var batchList = $('#brgy-table').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?php echo base_url(); ?>batches/brgyList',
                'type':"POST",
                'data':{
                    city: city
                }
            },
            'columns': [
                { data: 'id' },
                { data: 'firstname' },
                { data: 'middlename' },
                { data: 'lastname' },
                { data: 'city' },
                { data: 'barangay' },
                { data: 'position' },
                ]
        });
    }

    function month_added() {
        $.ajax({
            url: '<?php echo base_url("batches/month_added"); ?>',
            success: function (data) {
                $('#month_added').html(data)
            }
        });
    }
    
    $(document).on('change', '#category', function () {
        var category = $(this).val()
        var city = $("#municipality").val()
        var status = $("#status").val()
        var month = $("#month_added").val()

        if (category == "TUPAD BENEFICIARIES") {
            $('#batch-table').DataTable().destroy();
            batchList(city, status, month)
            $('#batch-table-div').removeClass('d-none');
            $('#brgy-table-div').addClass('d-none');
        } else {
            $('#brgy-table').DataTable().destroy();
            brgyList(city)
            $('#batch-table-div').addClass('d-none');
            $('#brgy-table-div').removeClass('d-none');
        }
    })

    $(document).on('change', '#municipality', function () {
        var city = $(this).val()
        var category = $("#category").val()
        var status = $("#status").val()
        var month = $("#month_added").val()

        if (category == "TUPAD BENEFICIARIES") {
            $('#batch-table').DataTable().destroy();
            batchList(city, status, month)
            $('#batch-table-div').removeClass('d-none');
            $('#brgy-table-div').addClass('d-none');
        } else {
            $('#brgy-table').DataTable().destroy();
            brgyList(city)
            $('#batch-table-div').addClass('d-none');
            $('#brgy-table-div').removeClass('d-none');
        }
    })

    $(document).on('change', '#batch_status', function () {
        var status = $(this).val()
        var city = $("#municipality").val()

        $('#batch-table').DataTable().destroy();
        batchList(city, status)
        $('#batch-table-div').removeClass('d-none');
        $('#brgy-table-div').addClass('d-none');
    })

    $(document).on('change', '#month_added', function () {
        var month = $(this).val()
        var city = $("#municipality").val()
        var category = $("#category").val()
        var status = $("#status").val()

        if (category == "TUPAD BENEFICIARIES") {
            $('#batch-table').DataTable().destroy();
            batchList(city, status, month)
            $('#batch-table-div').removeClass('d-none');
            $('#brgy-table-div').addClass('d-none');
        } else {
            $('#brgy-table').DataTable().destroy();
            brgyList(city)
            $('#batch-table-div').addClass('d-none');
            $('#brgy-table-div').removeClass('d-none');
        }
    })

    

    // $(document).on('change', '#csv_file', function () {
    //     var file_data = $('#csv_file').prop('files')[0];
    //     var form_data = new FormData();
    //     form_data.append('csv_file', file_data);

    //     $.ajax({
    //         url: '<?php echo base_url("batches/checkbenef"); ?>',
    //         type: 'POST',
    //         data: form_data,
    //         contentType: false,
    //         processData: false,
    //         beforeSend: function() {
    //             $('#benef_loader').removeClass('d-none')
    //         },
    //         success: function (response) {
    //             $('#benefModal').modal('show')
    //             $('#show_benef_list').html(response)
    //             $('#benef-list').DataTable()
    //         },
    //         complete:function(){
    //             $('#benef_loader').addClass('d-none')
    //         }
    //     });
    // });

    $(document).on('click', '#see-beneficiaries', function () {
        var file_data = $('#csv_file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('csv_file', file_data);

        $.ajax({
            url: '<?php echo base_url("batches/see_benef"); ?>',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loader').removeClass('d-none')
            },
            success: function (response) {
                $('#benefModal').modal('show')
                $('#show_benef_list').html(response)
                $('#benef-list').DataTable()
            },
            complete:function(){
                $('#loader').addClass('d-none')
            }
        });
    });

    $(document).on('click', '#view_benef', function () {
        var batch_id = $(this).val()

        $.ajax({
            url: '<?php echo base_url("batches/view_benef"); ?>',
            type: 'POST',
            data: {
                batch_id: batch_id
            },
            beforeSend: function() {
                $('#loader').removeClass('d-none')
            },
            success: function (response) {
                $('#benefModal').modal('show')
                $('#show_benef_list').html(response)
                $('#benef-list').DataTable()
            },
            complete:function(){
                $('#loader').addClass('d-none')
            }
        });
    });

    $(document).on('click', '#edit_batch', function () {
        var batch_id = $(this).val()

        $.ajax({
            url: '<?php echo base_url("batches/fetch_batch"); ?>',
            type: 'POST',
            data: {
                batch_id: batch_id
            },
            success: function (data) {
                $('#editBatchModal').modal('show')
                var res = jQuery.parseJSON(data);
                $('#batch_id').val(res.batch_id)
                $('#batch_name').val(res.batch_name)
                $('#city').val(res.city)
                $('#no_of_benef').val(res.no_of_benef)
                $('#status').val(res.status)
                $('#active_status').val(res.active_status)
                $('#adl').val(res.adl)
                $('#date_uploaded').val(res.implement_date)
            }
        });
    });

    $(document).on('click', '#delete_batch', function () {
        var batch_id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to delete this data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url("batches/delete_batch"); ?>',
                    type: 'POST',
                    data: {
                        batch_id: batch_id
                    },
                    success: function (data) {
                        $('#batch-table').DataTable().destroy();
                        batchList()
                        var res = jQuery.parseJSON(data);
                        Swal.fire({
                            title: res.title,
                            text: res.text,
                            icon: res.icon
                        })
                    }
                });
            }
        })
    });

    $('#batch_form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to insert this batch!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("batches/add_bacth"); ?>',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#save_bacth').prop('disabled', true)
                    },
                    success: function (data) {
                        $('#batch-table').DataTable().destroy();
                        batchList()
                        $('#batchModal').modal('hide');
                        var res = jQuery.parseJSON(data);
                        Swal.fire({
                            title: res.title,
                            text: res.text,
                            icon: res.icon
                        })
                    },
                    complete:function(){
                        $('#save_bacth').prop('disabled', false)
                    }
                });
            }
        })
    });

    $('#edit_batch_form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to update this batch!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("batches/edit_batch"); ?>',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#edit_batch_btn').prop('disabled', true)
                    },
                    success: function (data) {
                        $('#batch-table').DataTable().destroy();
                        batchList()
                        $('#editBatchModal').modal('hide');
                        var res = jQuery.parseJSON(data);
                        Swal.fire({
                            title: res.title,
                            text: res.text,
                            icon: res.icon
                        })
                    },
                    complete:function(){
                        $('#edit_batch_btn').prop('disabled', false)
                    }
                });
            }
        })
    });

    $('#brgy_form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to insert this batch!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("batches/add_brgy"); ?>',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#brgy-table').DataTable().destroy();
                        brgyList()
                        $('#brgyModal').modal('hide');
                        var res = jQuery.parseJSON(data);
                        Swal.fire({
                            title: res.title,
                            text: res.text,
                            icon: res.icon
                        })
                    },
                });
            }
        })
    });

    
</script>