<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="create-modal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="full_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="date_of_birth">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">License Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="license_number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">License Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="license_expiry_date">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control form_input" id="address"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Driving History <span class="text-danger">*</span></label>
                                <textarea class="form-control form_input" id="driving_history"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Medical Clearance Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select form_input" id="medical_clearance_status">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
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
            let full_name = document.getElementById('full_name').value;
            let phone = document.getElementById('phone').value;
            let email = document.getElementById('email').value;
            let date_of_birth = document.getElementById('date_of_birth').value;
            let license_number = document.getElementById('license_number').value;
            let license_expiry_date = document.getElementById('license_expiry_date').value;
            let address = document.getElementById('address').value;
            let driving_history = document.getElementById('driving_history').value;
            let medical_clearance_status = document.getElementById('medical_clearance_status').value;

            if (full_name.length === 0) {
                errorToast("Name Required !");
            } else {
                document.getElementById('modal-close').click();
                let formData = new FormData();
                formData.append('full_name', full_name);
                formData.append('phone', phone);
                formData.append('email', email);
                formData.append('date_of_birth', date_of_birth);
                formData.append('license_number', license_number);
                formData.append('license_expiry_date', license_expiry_date);
                formData.append('address', address);
                formData.append('driving_history', driving_history);
                formData.append('medical_clearance_status', medical_clearance_status);


                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        ...HeaderToken().headers
                    }
                }

                showLoader();
                let res = await axios.post("/create-driver", formData, config);
                hideLoader();

                if (res.data['status'] === "success") {
                    successToast(res.data['message']);
                    document.getElementById("save-form").reset();
                    await getList();
                } else {
                    console.log(res.data['message']);
                    errorToast(res.data['message'])
                }
            }

        } catch (e) {
            console.log(e.response.status);
            unauthorized(e.response.status)
        }
    }
</script>
