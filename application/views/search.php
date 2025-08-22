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
                <li class="breadcrumb-item active">Search</li>
            </ol>
        </div>
        <!-- Page header end -->

        <!-- Main container start -->
        <div class="main-container">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
                <div class="col-sm-6">
                    <h3 class="display-5 text-gray-800">Search Beneficiary</h3>
                </div>
            </div>

            <!-- Row start -->
            <div class="row gutters">

                <div class="col-sm-12 ">
                    <div class="card mx-10">
                        <form action="<?php echo base_url(); ?>search/export_excel" method="POST">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-1 col-form-label">First name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="firstname" name="firstname">
                                </div>
                                <label for="inputPassword" class="col-sm-1 col-form-label">Last name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">City/Municipality</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="city" name="city">
                                        <option value="">Choose from</option>
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
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Barangay</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="barangay" name="barangay">
                                        <option value="">Select city first</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="contact" name="contact">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-success btn-block mt-3" id="search"><i class="icon-search"></i> Search</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mb-2 mt-0 d-none" id="loader">
                        <div class="spinner-border spinner-border-sm text-primary">
                            <span class="sr-only"></span>
                        </div>
                        <span> Loading list. Please wait...</span>
                    </div>

                    <div class="card">
                        <div class="card-header bg-light">
                            <button class="btn btn-success float-right d-none" type="submit" id="excel"><i class="icon-download"></i> Download Excel</button>
                            <div class="card-title mt-2">Duplicate List</div>
                        </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="duplicates-list">
                                    <table id="benef-list" class="table custom-table">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">#</th>
                                                <th class="align-middle text-center">Batch</th>
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
    $('#nav-search').addClass("active");

    $('#benef-list').DataTable()

    $(document).on('change', '#city', function () {
        var city = $(this).val();

        if (city != "") {
            $.ajax({
                url: '<?php echo base_url() ?>search/get_barangay',
                type: 'POST',
                data: {city: city},
                beforeSend: function() {
                    $('#loader').removeClass('d-none')
                },
                success: function(response) {
                    $('#barangay').html(response);
                },
                complete:function(){
                    $('#loader').addClass('d-none')
                }
            })
        } else {
            $("#barangay").html('<option value="">Select city first</option>');
        }
    })

    $(document).on('click', '#search', function () {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var city = $("#city").val();
        var barangay = $("#barangay").val();
        var contact = $("#contact").val();
        $('#benef-list').DataTable().destroy();
        getBeneficairy(firstname, lastname, city, barangay, contact)
        excel(firstname, lastname, city, barangay, contact)
    });

    function excel(firstname, lastname, city, barangay) {
        if (firstname == "" && lastname == "" && city == "" && barangay == "") {
            $('#excel').addClass('d-none');
        } else {
            $('#excel').removeClass('d-none');
        }
    }

    function getBeneficairy(firstname, lastname, city, barangay, contact) {

        var benefList = $('#benef-list').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?php echo base_url(); ?>search/benefList',
                'type':"POST",
                'data':{
                    firstname: firstname,
                    lastname: lastname,
                    city: city,
                    barangay: barangay,
                    contact: contact
                }
            },
            'columns': [
                { data: 'id' },
                { data: 'batch_name' },
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
    
</script>