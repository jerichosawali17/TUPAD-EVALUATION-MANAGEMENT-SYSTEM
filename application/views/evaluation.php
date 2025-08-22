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
                <li class="breadcrumb-item active">Evaluation</li>
            </ol>
        </div>
        <!-- Page header end -->

        <!-- Main container start -->
        <div class="main-container">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
                <div class="col-sm-6">
                    <h3 class="display-5 text-gray-800">Evaluation</h3>
                </div>
            </div>

            <!-- Row start -->
            <div class="row gutters">

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Insert CSV File</label>
                        <input type="file" id="csv_file" name="csv_file" class="form-control">
                        <small id="file-alert" class="text-danger"></small>
                    </div>
                </div>

                <div class="col-sm-3">
                    <label>Check by</label>
                    <select type="text" id="category" class="form-control">
                        <option>TUPAD BENEFICIARIES</option>
                        <option>BARANGAY OFFICIALS</option>
                        <option>CONTACT NUMBER</option>
                    </select>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>District</label>
                        <select class="form-control" id="district" name="district">
                            <option value="">ALL</option>
                            <option>1ST DISTRICT</option>
                            <option>2ND DISTRICT</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 mt-n1">
                    <div class="form-group">
                        <button class="btn btn-success" id="evaluate">Evaluate</button>
                        <button class="btn btn-success" id="check-duplicate">Search duplicate entry</button>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mb-2 mt-0 d-none" id="loader">
                        <div class="spinner-border spinner-border-sm text-primary">
                            <span class="sr-only"></span>
                        </div>
                        <span> Loading list. Please wait...</span>
                    </div>

                    <div class="table-container">
                        <div class="t-header">Duplicate List</div>
                        <div class="table-responsive">
                            <div id="duplicates-list">
                                <table id="benef-list" class="table custom-table">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">#</th>
                                            <th class="align-middle text-center">First Name</th>
                                            <th class="align-middle text-center">Last Name</th>
                                            <th class="align-middle text-center"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
    $('#nav-evaluation').addClass("active");

    $('#benef-list').DataTable()

    $(document).on('click', '#see_benef', function () {
        var benef = $(this).val();
        var category = $('#category').val();
        $.ajax({
            url: '<?php echo base_url() ?>evaluation/see_benef',
            type: 'POST',
            data: {
                benef: benef, 
                category: category
            },
            beforeSend: function() {
                $('#loader').removeClass('d-none')
            },
            success: function(response) {
                $('#benefModal').modal('show');
                $('#show_benef_list').html(response);
                $('#duplicate-benef-list').DataTable()
            },
            complete:function(){
                $('#loader').addClass('d-none')
            }
        })
    })

    // $(document).on('change', '#district', function () {
    //     var district = $(this).val();
    //     var category = $('#category').val();
    //     var file_data = $('#csv_file').prop('files')[0];
    //     var form_data = new FormData();
    //     form_data.append('csv_file', file_data);
    //     form_data.append('district', district);
        
    //     $.ajax({
    //         url: '<?php echo base_url() ?>evaluation/checkBenef/' + category,
    //         type: 'POST',
    //         data: form_data,
    //         processData: false,
    //         contentType: false,
    //         beforeSend: function() {
    //             $('#loader').removeClass('d-none')
    //         },
    //         success: function(response) {
    //             $('#duplicates-list').html(response);
    //             $('#benef-list').DataTable()
    //         },
    //         complete:function(){
    //             $('#loader').addClass('d-none')
    //         }
    //     });
    // })

    // $(document).on('change', '#category', function () {
    //     var category = $(this).val();
    //     var district = $('#district').val();
    //     var file_data = $('#csv_file').prop('files')[0];
    //     var form_data = new FormData();
    //     form_data.append('csv_file', file_data);
    //     form_data.append('district', district);

    //     $.ajax({
    //         url: '<?php echo base_url() ?>evaluation/checkBenef/' + category,
    //         type: 'POST',
    //         data: form_data,
    //         processData: false,
    //         contentType: false,
    //         beforeSend: function() {
    //             $('#loader').removeClass('d-none')
    //         },
    //         success: function(response) {
    //             $('#duplicates-list').html(response);
    //             $('#benef-list').DataTable()
    //         },
    //         complete:function(){
    //             $('#loader').addClass('d-none')
    //         }
    //     });
    // })

    $(document).on('click', '#evaluate', function () {
        var category = $("#category").val();
        var district = $('#district').val();
        var file_data = $('#csv_file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('csv_file', file_data);
        form_data.append('district', district);

        $.ajax({
            url: '<?php echo base_url() ?>evaluation/checkBenef/' + category,
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#loader').removeClass('d-none')
            },
            success: function(response) {
                $('#duplicates-list').html(response);
                $('#benef-list').DataTable()
            },
            complete:function(){
                $('#loader').addClass('d-none')
            }
        });
    })

    $(document).on('click', '#check-duplicate', function () {
        var file_data = $('#csv_file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('csv_file', file_data);

        if (file_data) {
            $.ajax({
                url: '<?php echo base_url() ?>evaluation/check_duplicates',
                type: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#loader').removeClass('d-none')
                },
                success: function(response) {
                    $('#benefModal').modal('show');
                    $('#show_benef_list').html(response);
                },
                complete:function(){
                    $('#loader').addClass('d-none')
                }
            });
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please insert CSV file",
                icon: "warning"
            })
        }
    })

    // $(document).on('change', '#csv_file', function () {
    //     var category = $("#category").val()
    //     var district = $("#district").val()
    //     var file = this.files[0];
    //     var maxFileSize = 20 * 1024 * 1024; 
    //     var isValidFile = true;
    //     var validMimeTypes = [
    //         'text/csv',
    //         'application/csv'
    //         ];

    //     if (file) {
    //         if (file.size > maxFileSize || !validMimeTypes.includes(file.type)) {
    //             isValidFile = false;
    //             $(this).val('');
    //             $('#file-alert').html('Please select a valid CSV file with a maximum size of 15MB.');
    //         } else {
    //             var formData = new FormData();
    //             formData.append('csv_file', file);
    //             formData.append('district', district);

    //             $.ajax({
    //                 url: '<?php echo base_url() ?>evaluation/checkBenef/' + category,
    //                 type: 'POST',
    //                 data: formData,
    //                 processData: false,
    //                 contentType: false,
    //                 beforeSend: function() {
    //                     $('#loader').removeClass('d-none')
    //                 },
    //                 success: function(response) {
    //                     $('#duplicates-list').html(response);
    //                     $('#benef-list').DataTable()
    //                 },
    //                 complete:function(){
    //                     $('#loader').addClass('d-none')
    //                 }
    //             })
    //         }
    //     }

    //     if (isValidFile) {
    //         $('#file-alert').html('');
    //     } else {
    //         $('#file-alert').html('Please select a valid CSV file with a maximum size of 15MB.');
    //         $(this).val('');
    //     }
    // });
    
</script>