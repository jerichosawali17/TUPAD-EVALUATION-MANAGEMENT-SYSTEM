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
                <li class="breadcrumb-item active">Beneficiary</li>
            </ol>
        </div>
        <!-- Page header end -->

        <!-- Main container start -->
        <div class="main-container">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
                <div class="col-sm-6">
                    <h3 class="display-5 mb-2 text-gray-800"><?php echo $batch_name; ?></h3>
                    <input type="hidden" id="id" value="<?php echo $batch_id; ?>">
                </div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <div class="mb-3 col-sm-3">
                    <label>Barangay</label>
                    <select type="text" id="barangay" class="form-control">
                        <option value="">Choose from</option>
                    </select>
                </div>
                <div class="mt-4 col-sm-9">
                    <button class="btn btn-success float-right" id="btn_update_list">
                        <i class="icon-download"></i> Update List
                    </button>
                </div>
                <div class="col-sm-12">
                    <div class="mb-2 mt-0 d-none" id="loader">
                        <div class="spinner-border spinner-border-sm text-primary">
                            <span class="sr-only"></span>
                        </div>
                        <span> Loading list. Please wait...</span>
                    </div>

                    <div class="table-container">
                        <div class="t-header">Beneficiary List</div>
                        <div class="table-responsive">
                            <table id="beneficiaries-list" class="table custom-table">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">#</th>
                                        <th class="align-middle text-center">Status</th>
                                        <th class="align-middle text-center">First Name</th>
                                        <th class="align-middle text-center">Middle Name</th>
                                        <th class="align-middle text-center">Last Name</th>
                                        <th class="align-middle text-center">Extension Name</th>
                                        <th class="align-middle text-center">Birthday</th>
                                        <th class="align-middle text-center">Barangay</th>
                                        <th class="align-middle text-center">City/Municipality</th>
                                        <th class="align-middle text-center">Province</th>
                                        <th class="align-middle text-center">District</th>
                                        <th class="align-middle text-center">Type of ID </th>
                                        <th class="align-middle text-center">ID Number</th>
                                        <th class="align-middle text-center">Contact No.</th>
                                        <th class="align-middle text-center">E-payment/Bank Account No.</th>
                                        <th class="align-middle text-center">Type of Beneficiary</th>
                                        <th class="align-middle text-center">Occupation</th>
                                        <th class="align-middle text-center">Sex</th>
                                        <th class="align-middle text-center">Civil Status</th>
                                        <th class="align-middle text-center">Age</th>
                                        <th class="align-middle text-center">Average Monthly Income</th>
                                        <th class="align-middle text-center">Dependent</th>
                                        <th class="align-middle text-center">Interested  in wagage employment or self-employment?</th>
                                        <th class="align-middle text-center">Skills training needed</th>
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

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModal">UPDATE BENEFICIARIES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_form" accept-charset="utf-8" >
                <div class="modal-body">
                    <div class="row gutters">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row gutters">
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="font-weight-bold">Upload List of Beneficiaries (CSV File)</label>
                                                <input type="hidden" id="batch_id" name="batch_id">
                                                <input type="file" class="form-control" id="csv_file" name="csv_file">
                                                <button type="button" id="see-beneficiaries" class="btn btn-default btn-sm float-right mt-1">See beneficiaries</button>
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

    benefList()
    getCity()

    function getCity() {
        var id = $('#id').val();
        $.ajax({
            url: '<?php echo base_url("beneficiary/getCity"); ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                $('#barangay').html(data);
            }
        });
    }

    function benefList(barangay = "")
    {
        var id = $('#id').val();
        var benefList = $('#beneficiaries-list').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?php echo base_url(); ?>beneficiary/benefList',
                'type':"POST",
                'data':{
                    id: id,
                    barangay: barangay
                }
            },
            'columns': [
                { data: 'id' },
                { data: 'status' },
                { data: 'firstname' },
                { data: 'middlename' },
                { data: 'lastname' },
                { data: 'extension_name' },
                { data: 'birthdate' },
                { data: 'barangay' },
                { data: 'city' },
                { data: 'province' },
                { data: 'district' },
                { data: 'type_of_id' },
                { data: 'id_number' },
                { data: 'contact_no' },
                { data: 'e_payment' },
                { data: 'type_of_benef' },
                { data: 'occupation' },
                { data: 'sex' },
                { data: 'civil_status' },
                { data: 'age' },
                { data: 'monthly_income' },
                { data: 'dependent' },
                { data: 'wage_employment' },
                { data: 'skills' },
                ]
        });
    }
    
    $(document).on('change', '#barangay', function () {
        var barangay = $(this).val()
        $('#beneficiaries-list').DataTable().destroy();
        benefList(barangay)
    })

    $(document).on('click', '#edit_benef', function () {
        var id = $(this).val()
        alert(id)
    })

    $(document).on('click', '#delete_benef', function () {
        var id = $(this).val()

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
                    url: '<?php echo base_url("beneficiary/delete_benef"); ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        $('#loader').removeClass('d-none')
                    },
                    success: function (data) {
                        $('#beneficiaries-list').DataTable().destroy();
                        benefList()
                        var res = jQuery.parseJSON(data);
                        Swal.fire({
                            title: res.title,
                            text: res.text,
                            icon: res.icon
                        })
                    },
                    complete:function(){
                        $('#loader').addClass('d-none')
                    }
                });
            }
        })
    })

    $(document).on('click', '#btn_update_list', function () {
        var id = $('#id').val();
        $('#updateModal').modal("show");
        $('#batch_id').val(id);
    })

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

    $('#update_form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to update this list!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("beneficiary/update_benef"); ?>',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#beneficiaries-list').DataTable().destroy();
                        benefList()
                        $('#updateModal').modal('hide');
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