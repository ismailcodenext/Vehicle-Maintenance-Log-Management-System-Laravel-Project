<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="update-modal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Test</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="edit_name">
                                <input class="d-none" id="updateID">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="edit_phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control form_input" id="edit_address" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form_input" id="edit_email">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="edit_status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn modal_close_btn" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update(event)" id="update-btn" class="btn modal_update_btn"
                    style="width: auto;">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function FillUpUpdateForm(id) {
        try {
            document.getElementById('updateID').value = id;
            showLoader();
            let res = await axios.post("/service-provider-by-id", {
                id: id.toString()
            }, HeaderToken());
            hideLoader();

            let data = res.data.rows;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_phone').value = data.phone;
            document.getElementById('edit_address').value = data.address;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_status').value = data.status;

        } catch (e) {
            unauthorized(e.response.status);
        }
    }


    async function Update() {
        try {
            let name = document.getElementById('edit_name').value;
            let phone = document.getElementById('edit_phone').value;
            let address = document.getElementById('edit_address').value;
            let email = document.getElementById('edit_email').value;
            let status = document.getElementById('edit_status').value;
            let updateID = document.getElementById('updateID').value;

            document.getElementById('update-modal-close').click();

            let formData = new FormData();
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('email', email);
            formData.append('status', status);
            formData.append('id', updateID);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    ...HeaderToken().headers
                }
            };

            showLoader();

            let res = await axios.post("/update-service-provider", formData, config);
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
