<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Vehicles CateGory</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label"> CateGory Name *</label>
                                <input type="text" class="form-control form_input" id="CateGoryNameUpdate">
                                <label class="form-label"> Description *</label>
                                <input type="text" class="form-control form_input" id="DescriptionUpdate">
                                <label class="form-label"> Maximum Load Capacity *</label>
                                <input type="text" class="form-control form_input" id="MaximumLoadCapacityUpdate">
                                <label class="form-label"> Seating Capacity *</label>
                                <input type="text" class="form-control form_input" id="SeatingCapacityUpdate">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control form_input" id="StatusUpdate">
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                </select>
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn modal_close_btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update(event)" id="update-btn" class="btn modal_update_btn" style="width: auto;">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
  async function FillUpUpdateForm(id) {
    try {
        document.getElementById('updateID').value = id;
        showLoader();
        let res = await axios.post("/vehicles-category-by-id", { id: id.toString() }, HeaderToken());
        hideLoader();

        let data = res.data.rows;
        document.getElementById('CateGoryNameUpdate').value = data.category_name;
        document.getElementById('DescriptionUpdate').value = data.description;
        document.getElementById('MaximumLoadCapacityUpdate').value = data.maximum_load_capacity;
        document.getElementById('SeatingCapacityUpdate').value = data.seating_capacity;

        // Set the status value
        document.getElementById('StatusUpdate').value = data.status;
    } catch (e) {
        unauthorized(e.response.status);
    }
}


    async function Update() {
        try {
            let CateGoryNameUpdate = document.getElementById('CateGoryNameUpdate').value;
            let DescriptionUpdate = document.getElementById('DescriptionUpdate').value;
            let MaximumLoadCapacityUpdate = document.getElementById('MaximumLoadCapacityUpdate').value;
            let SeatingCapacityUpdate = document.getElementById('SeatingCapacityUpdate').value;
            let StatusUpdate = document.getElementById('StatusUpdate').value;
            let updateID = document.getElementById('updateID').value;

            document.getElementById('update-modal-close').click();

            showLoader();

            let res = await axios.post("/update-vehicles-category",{
                  id:updateID,
                  category_name:CateGoryNameUpdate,
                  description:DescriptionUpdate,
                  maximum_load_capacity:MaximumLoadCapacityUpdate,
                  seating_capacity:SeatingCapacityUpdate,
                  status:StatusUpdate
                },
                  HeaderToken()
                );
            hideLoader();

            if (res.data.status === "success") {
                successToast(res.data.message);
                let modal = new bootstrap.Modal(document.getElementById('update-modal'));
                modal.hide();
                await getList();
            } else {
                errorToast(res.data.message);
            }

        } catch (e) {
            unauthorized(e.response.status);
        }
    }
</script>
