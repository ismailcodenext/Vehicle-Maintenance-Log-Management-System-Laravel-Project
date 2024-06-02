<div class="modal animated zoomIn" id="view-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-danger">Driver Details</h3>
                <input readonly class="d-none" id="viewID" />

                <div class="container">
                    <div class="row">
                        <div class="col-6 p-1">
                            <label class="form-label">Full Name : </label>
                            <span id="view_full_name" class="text-white px-3"></span>
                            <input readonly class="d-none" id="updateID">
                        </div>
                        <div class="col-6 p-1">
                            <label class="form-label">Phone : </label>
                            <span id="view_phone" class="text-white px-3"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 p-1">
                            <label class="form-label">Email : </label>
                            <span id="view_email" class="text-white px-3"></span>

                        </div>
                        <div class="col-6 p-1">
                            <label class="form-label">Date of Birth : </label>
                            <span id="view_date_of_birth" class="text-white px-3"></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 p-1">
                            <label class="form-label">License Number : </label>
                            <span id="view_license_number" class="text-white px-3"></span>

                        </div>
                        <div class="col-6 p-1">
                            <label class="form-label">License Expiry Date : </label>
                            <span id="view_license_expiry_date" class="text-white px-3"></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-1">
                            <label class="form-label">Address : </label>
                            <span id="view_address" class="text-white px-3"></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-1">
                            <label class="form-label">Driving History : </label>
                            <span id="view_driving_history" class="text-white px-3"></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 p-1">
                            <label class="form-label">Medical Clearance Status :</label>
                            <span id="view_medical_clearance_status" class="text-white px-3"></span>

                        </div>
                        <div class="col-6 p-1">
                            <label class="form-label"> Status </label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-1">
                            <br />
                            <input readonly class="d-none" id="image_url" />
                            <img class="w-15" id="view_newImg" />
                            <br />
                        </div>
                        <div class="col-8 p-1">
                            <label class="form-label">Image </label>
                            <input readonly oninput="view_newImg.src=window.URL.createObjectURL(this.files[0])"
                                type="file" class="form-select form_input" id="view_image">

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    async function showDriverDetails(id) {
        try {
            document.getElementById('viewID').value = id;
            showLoader();
            let res = await axios.post("/driver-by-id", {
                id: id.toString()
            }, HeaderToken());
            hideLoader();

            let data = res.data.rows;
            document.getElementById('view_full_name').innerText = data.full_name;
            document.getElementById('view_phone').innerText = data.phone;
            document.getElementById('view_email').innerText = data.email;
            document.getElementById('view_address').innerText = data.address;
            document.getElementById('view_full_name').innerText = data.full_name;
            document.getElementById('view_full_name').innerText = data.full_name;
            document.getElementById('view_full_name').innerText = data.full_name;



        } catch (e) {
            unauthorized(e.response.status);
        }
    }
</script>
