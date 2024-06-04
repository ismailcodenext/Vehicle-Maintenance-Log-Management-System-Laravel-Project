
<div class="home">
    <!-- Dashboard Content Start -->
    <div class="content_wrapper">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="wrapper">
                    <div class="row justify-content-between mt-2">
                        <div class="align-items-center col">
                            <h4 style="color: white">Vehicles Documents & Registrations List</h4>
                        </div>
                        <div class="align-items-center col actionBtns ">
                            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end "> <span><i class="fa-solid fa-plus"></i></span>
                                Create</button>
                        </div>
                    </div>

                    <hr class="bg-dark "/>

                    <div class="table-responsive">
                        <table class="table invoice_table" id="tableData">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Vehicle</th>
                                <th>Registration Number</th>
                                <th>Registration Expiry Date</th>
                                <th>Insurance Number</th>
                                <th>Insurance Expiry Date</th>
                                <th>Tax Token Number</th>
                                <th>Tax Token Expiry Date</th>
                                <th>Fitness Number</th>
                                <th>Fitness Expiry Date</th>
                                <th>Permit Number</th>
                                <th>Permit Expiry Date</th>
                                <th>Road Worthiness Number</th>
                                <th>Road Worthiness Expiry Date</th>
                                <th>Emission Test Number</th>
                                <th>Emission Test Expiry Date</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tableList">

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Dashboard Content End -->

</div>


<script>
    getList();

    async function getList() {

        try {
            showLoader();
            let res=await axios.get("/list-vehicles-documents",HeaderToken());
            hideLoader();

            let tableList=$("#tableList");
            let tableData=$("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            res.data['vehicles_data'].forEach(function (item,index) {
                let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['vehicle_id']}</td>
                    <td>${item['registration_number']} </td>
                    <td>${item['registration_expiry_date']}</td>
                    <td>${item['insurance_number'] ? item['insurance_number']: 'none'}</td>
                    <td>${item['insurance_expiry_date'] ? item['insurance_expiry_date']: 'none'}</td>
                    <td>${item['tax_token_number']}</td>
                    <td>${item['tax_token_expiry_date']}</td>
                    <td>${item['fitness_certificate_number']}</td>
                    <td>${item['fitness_certificate_expiry_date']}</td>
                    <td>${item['permit_number']}</td>
                    <td>${item['permit_expiry_date']}</td>
                    <td>${item['road_worthiness_certificate_number'] ? item['road_worthiness_certificate_number']: 'none'}</td>
                    <td>${item['road_worthiness_certificate_expiry_date'] ? item['road_worthiness_certificate_expiry_date']: 'none'}</td>
                    <td>${item['emission_test_certificate_number'] ? item['emission_test_certificate_number']: 'none'}</td>
                    <td>${item['emission_test_certificate_expiry_date'] ? item['emission_test_certificate_expiry_date']: 'none'}</td>
                    <td>${item['note'] ? item['note']: 'none'}</td>
                    <td>${item['status']}</td>
                    <td>
                     <div style="display: flex;" class="modelBtn">

                            <button data-id="${item['id']}" class="float-end editBtn"> <span><i class="fa-solid fa-pen-to-square"></i></span>
                                Edit</button>


                            <button data-id="${item['id']}" class="float-end deleteBtn"><i class="fa-solid fa-trash"></i>
                                Delete</button>

                        </div>
                    </td>
                 </tr>`
                tableList.append(row)
            })

            $('.editBtn').on('click', async function () {
                let id= $(this).data('id');
                await FillUpUpdateForm(id)
                $("#update-modal").modal('show');
            })

            $('.deleteBtn').on('click',function () {
                let id= $(this).data('id');
                $("#delete-modal").modal('show');
                $("#deleteID").val(id);
            })

            new DataTable('#tableData',{
                order:[[0,'desc']],
                lengthMenu:[5,10,15,20,30]
            });


        }catch (e) {
            unauthorized(e.response.status)
        }

    }


</script>
