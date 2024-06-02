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
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="edit_full_name">
                                <input class="d-none" id="updateID">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="edit_phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Email </label>
                                <input type="text" class="form-control form_input" id="edit_email">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="edit_date_of_birth">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">License Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="edit_license_number">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">License Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="edit_license_expiry_date">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control form_input" id="edit_address" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Driving History <span class="text-danger">*</span></label>
                                <textarea class="form-control form_input" id="edit_driving_history" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Medical Clearance Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select form_input" id="edit_medical_clearance_status">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label"> Status <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="edit_status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 p-1">
                                <br />
                                <input class="d-none" id="image_url" />
                                <img class="w-15" id="edit_newImg" />
                                <br />
                            </div>
                            <div class="col-8 p-1">
                                <label class="form-label">Image </label>
                                <input oninput="edit_newImg.src=window.URL.createObjectURL(this.files[0])"
                                    type="file" class="form-select form_input" id="edit_image">

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
            let res = await axios.post("/driver-by-id", {
                id: id.toString()
            }, HeaderToken());
            hideLoader();

            let data = res.data.rows;
            document.getElementById('edit_full_name').value = data.full_name;
            document.getElementById('edit_phone').value = data.phone;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_date_of_birth').value = data.date_of_birth;
            document.getElementById('edit_license_number').value = data.license_number;
            document.getElementById('edit_license_expiry_date').value = data.license_expiry_date;
            document.getElementById('edit_address').value = data.address;
            document.getElementById('edit_driving_history').value = data.driving_history;
            document.getElementById('edit_medical_clearance_status').value = data.medical_clearance_status;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('image_url').value = data.image;
            document.getElementById('edit_newImg').src = data.image;
            // console.log(data.medical_clearance_status);

        } catch (e) {
            unauthorized(e.response.status);
        }
    }

    async function Update() {
        try {
            let full_name = document.getElementById('edit_full_name').value;
            let phone = document.getElementById('edit_phone').value;
            let email = document.getElementById('edit_email').value;
            let date_of_birth = document.getElementById('edit_date_of_birth').value;
            let license_number = document.getElementById('edit_license_number').value;
            let license_expiry_date = document.getElementById('edit_license_expiry_date').value;
            let address = document.getElementById('edit_address').value;
            let driving_history = document.getElementById('edit_driving_history').value;
            let medical_clearance_status = document.getElementById('edit_medical_clearance_status').value;
            let status = document.getElementById('edit_status').value;

            let image = document.getElementById('edit_image').files[0];
            let imgae_url = document.getElementById('image_url').value;
            let id = document.getElementById('updateID').value;

            document.getElementById('update-modal-close').click();

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
            formData.append('status', status);
            formData.append('id', id);
            if (image) {
                formData.append('image', image);
                console.log(formData.get('image'));
            } else {
                console.log(imgae_url);
                formData.append('image_url', imgae_url);
            }
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    ...HeaderToken().headers
                }
            };
            // console.log(formData.get('status'));

            showLoader();

            let res = await axios.post("/update-driver", formData, config);
            hideLoader();

            if (res.data.status === "success") {
                successToast(res.data.message);
                let modal = new bootstrap.Modal(document.getElementById('update-modal'));
                document.getElementById('update-form').reset();
                modal.hide();
                await getList();
            } else {
                console.log(res.data.message);
                errorToast(res.data.message);

            }

        } catch (e) {
            unauthorized(e.response.status);
        }
    }
</script>
