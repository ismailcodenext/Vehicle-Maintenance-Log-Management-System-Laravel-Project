<div class="home">
    <!-- Dashboard Content Start -->
    <div class="content_wrapper">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="wrapper">
                    <div class="row justify-content-between mt-2">
                        <div class="align-items-center col">
                            <h4 style="color: white">Driver List</h4>
                        </div>
                        <div class="align-items-center col actionBtns ">
                            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end "> <span><i
                                        class="fa-solid fa-plus"></i></span>
                                Create</button>
                        </div>
                    </div>

                    <hr class="bg-dark " />

                    <div class="table-responsive">
                        <table class="table invoice_table" id="tableData">
                            <thead class="table_headings">
                                <tr>
                                    <th>No</th>
                                    <th>image</th>
                                    <th>Name</th>
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
            let res = await axios.get("/list-driver", HeaderToken());
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            res.data['Driver_data'].forEach(function(item, index) {
                let row = `<tr >
                    <td class="px-3">${index+1}</td>

                    <td><img  width="50" height="50"  src=${item['image'] ? item['image']: "images/default.jpg" } /></td>
                    <td>${item['full_name']}</td>

                    <td>
                     <div style="display: flex;" class="modelBtn">

                            <button data-id="${item['id']}" class="float-end btn-sm editBtn"> <span><i class="fa-solid fa-pen-to-square"></i></span>
                                Edit</button>


                            <button data-id="${item['id']}" class="float-end btn-sm deleteBtn"><i class="fa-solid fa-trash"></i>
                                Delete</button>

                            <button data-id="${item['id']}" class="float-end btn-sm viewBtn"><i class="fa-solid fa-eye"></i>
                                View</button>

                        </div>
                    </td>
                 </tr>`
                tableList.append(row)
            })

            $('.editBtn').on('click', async function() {
                let id = $(this).data('id');
                await FillUpUpdateForm(id);
                $("#update-modal").modal('show');
            })

            $('.viewBtn').on('click', async function() {
                let id = $(this).data('id');
                await showDriverDetails(id);
                $("#view-modal").modal('show');
            })

            $('.deleteBtn').on('click', function() {
                let id = $(this).data('id');
                $("#delete-modal").modal('show');
                $("#deleteID").val(id);
            })


            new DataTable('#tableData', {
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [5, 10, 15, 20, 30]
            });


        } catch (e) {
            unauthorized(e.response.status)
        }

    }
</script>
