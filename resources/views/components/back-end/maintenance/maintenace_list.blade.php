
<div class="home">
    <!-- Dashboard Content Start -->
    <div class="content_wrapper">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="wrapper">
                    <div class="row justify-content-between mt-2">
                        <div class="align-items-center col">
                            <h4 style="color: white">Maintenance List</h4>
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
                                <th>Id</th>
                                <th>Vehicle ID</th>
                                <th>Date of Service</th>
                                <th>Mileage at Service</th>
                                <th>Service Type ID</th>
                                <th>Service Provider Type ID</th>
                                <th>Description of Service</th>
                                <th>Cost</th>
                                <th>Actions</th>
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
            let res=await axios.get("/list-maintenance",HeaderToken());
            hideLoader();

            let tableList=$("#tableList");
            let tableData=$("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

              res.data['MaintenanceRecord_data'].forEach(function (item, index) {
                    let statusColor = item['status'] === 'Active' ? 'background-color: ; color: white;' : 'background-color: yellow; color: black;';
                    let row = `<tr>

                        <td>${item['id']}</td>
                        <td>${item['vehicle_id']}</td>
                        <td>${item['date_of_service']}</td>
                        <td>${item['mileage_at_service']} Kg</td>
                        <td>${item['service_type_id']}</td>
                        <td>${item['description_of_service']}</td>
                        <td>${item['cost']}</td>

                        <td style="${statusColor}">${item['status']}</td>
                        <td>
                            <div style="display: flex;" class="modelBtn">
                                <button data-id="${item['id']}" class="float-end editBtn">
                                    <span><i class="fa-solid fa-pen-to-square"></i></span> Edit
                                </button>
                                <button data-id="${item['id']}" class="float-end deleteBtn">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>`;
                    tableList.append(row);
                });


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
