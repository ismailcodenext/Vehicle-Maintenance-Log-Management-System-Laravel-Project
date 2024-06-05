<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="create-modal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Service Provider</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="name">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control form_input" id="address" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form_input" id="email">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn modal_close_btn" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn" style="width: auto;">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Save() {
        try {
            let name = document.getElementById('name').value;
            let phone = document.getElementById('phone').value;
            let address = document.getElementById('address').value;
            let email = document.getElementById('email').value;
            let status = document.getElementById('status').value;

            if (name.length === 0) {
                errorToast("Name Required !");
            } else if (phone.length === 0) {
                errorToast("Phone Required !");
            } else if (address.length === 0) {
                errorToast("Address Required !");
            } else if (email.length === 0) {
                errorToast("Email Required !");
            } else if (status.length === 0) {
                errorToast("Status Required !");
            } else {
                document.getElementById('modal-close').click();
                let formData = new FormData();
                formData.append('name', name);
                formData.append('phone', phone);
                formData.append('address', address);
                formData.append('email', email);
                formData.append('status', status);


                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        ...HeaderToken().headers
                    }
                }

                showLoader();
                let res = await axios.post("/create-service-provider", formData, config);
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
