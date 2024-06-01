<div class="modal animated zoomIn" style="z-index: 99999999 !important;"  id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Categories List Create</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label"> CateGory Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="CategoryName">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="Description">
                                <label class="form-label">Maximum Load Capacity <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="MaximumLoadCapacity">
                                <label class="form-label">Seating Capacity <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="SeatingCapacity">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control form_input" id="Status">
                                    <option class="form-control form_input" value="active">Active</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn modal_close_btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn" style="width: auto;">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Save() {
        try {
            let  CategoryName= document.getElementById('CategoryName').value;
            let  Description= document.getElementById('Description').value;
            let  MaximumLoadCapacity= document.getElementById('MaximumLoadCapacity').value;
            let  SeatingCapacity= document.getElementById('SeatingCapacity').value;
            let  Status= document.getElementById('Status').value;



            if (CategoryName.length === 0) {
                errorToast("CategoryName Required !");
            }
            else if (Description.length === 0) {
                errorToast("Description Required !");
            }else if (MaximumLoadCapacity.length === 0) {
                errorToast("MaximumLoadCapacity Required !");
            }else if (SeatingCapacity.length === 0) {
                errorToast("SeatingCapacity Required !");
            } else if (isNaN(MaximumLoadCapacity)) {
            errorToast("MaximumLoadCapacity must be a number!");
            }
            else {
                document.getElementById('modal-close').click();
                showLoader();
                let res = await axios.post("/create-vehicles-category",
                {
                  category_name:CategoryName,
                  description:Description,
                  maximum_load_capacity:MaximumLoadCapacity,
                  seating_capacity:SeatingCapacity,
                  status:Status
                 },
                   HeaderToken());
                hideLoader();

                if (res.data['status'] === "success") {
                    successToast(res.data['message']);
                    document.getElementById("save-form").reset();
                    await getList();
                } else {
                    errorToast(res.data['message'])
                }
            }

        } catch (e) {
            unauthorized(e.response.status)
        }
    }
</script>
