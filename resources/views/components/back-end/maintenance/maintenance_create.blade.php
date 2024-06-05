
<div class="modal animated zoomIn" style="z-index: 99999999 !important;"  id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Maintenance Create</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Vehicle ID</label>
                                <select class="form-control form_input" id="vehicle_id">
                                    <option value="">Vehicle ID</option>
                                </select>

                                <label class="form-label">Date of Service <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="date_of_service">

                                <label class="form-label">Mileage at Service <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="mileage_at_service">
                                <label class="form-label">Service Type ID</label>
                                <select class="form-control form_input" id="service_type_id">
                                    <option value="">Service Type ID</option>
                                </select>
                                <label class="form-label">Service Provider ID</label>
                                <select class="form-control form_input" id="service_provider_id">
                                    <option value="">Select Service Provider</option>
                                </select>

                                <label class="form-label">Description of Service<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="description_of_service">

                                <label class="form-label">Cost <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="cost">

                                <label class="form-label">Image Upload</label>
                                <input type="file" class="form-control form_input" id="image_upload">

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
document.addEventListener('DOMContentLoaded', function () {
    getServiceProviderList();
    getVicleList();
    getServiceTypeList();
});

async function getServiceProviderList() {
    try {
        showLoader();
        let res = await axios.get("/list-service-provider", HeaderToken());
        hideLoader();
        const serviceProviders = res.data;
        const select = document.getElementById('service_provider_id');
        serviceProviders.forEach(function (provider) {
            const option = document.createElement('option');
            option.value = provider.id; // Assuming service provider has a 'name' attribute
            option.textContent = provider.name;
            select.appendChild(option);
        });
    } catch (e) {
        unauthorized(e.response.status);
    }
}
async function getVicleList() {
    try {
        showLoader();
        let res = await axios.get("/list-vehicles", HeaderToken());
        hideLoader();
        const vehicles = res.data;
        const select = document.getElementById('vehicle_id');
        vehicles.forEach(function (provider) {
            const option = document.createElement('option');
            option.value = provider.id; // Assuming service provider has a 'name' attribute
            option.textContent = provider.name;
            select.appendChild(option);
        });
    } catch (e) {
        unauthorized(e.response.status);
    }
}
async function getServiceTypeList() {
    try {
        showLoader();
        let res = await axios.get("/list-service-type", HeaderToken());
        hideLoader();
        const ServiceType = res.data;
        const select = document.getElementById('service_type_id');
        ServiceType.forEach(function (provider) {
            const option = document.createElement('option');
            option.value = provider.id; // Assuming service provider has a 'name' attribute
            option.textContent = provider.name;
            select.appendChild(option);
        });
    } catch (e) {
        unauthorized(e.response.status);
    }
}

async function Save() {
    try {
        let vehicle_id = document.getElementById('vehicle_id').value;
        let date_of_service = document.getElementById('date_of_service').value;
        let mileage_at_service = document.getElementById('mileage_at_service').value;
        let service_type_id = document.getElementById('service_type_id').value;
        let service_provider_id = document.getElementById('service_provider_id').value;
        let description_of_service = document.getElementById('description_of_service').value;
        let cost = document.getElementById('cost').value;
        let image_upload = document.getElementById('image_upload').files[0];
        let user_id = document.getElementById('user_id').value;

        if (vehicle_id.length === 0) {
            errorToast("Vehicle ID Required!");
        } else if (date_of_service.length === 0) {
            errorToast("Date of Service Required!");
        } else if (mileage_at_service.length === 0) {
            errorToast("Mileage at Service Required!");
        } else if (service_type_id.length === 0) {
            errorToast("Service Type ID Required!");
        } else if (description_of_service.length === 0) {
            errorToast("Description of Service Required!");
        } else if (cost.length === 0) {
            errorToast("Cost Required!");
        } else {
            let formData = new FormData();
            formData.append('vehicle_id', vehicle_id);
            formData.append('date_of_service', date_of_service);
            formData.append('mileage_at_service', mileage_at_service);
            formData.append('service_type_id', service_type_id);
            formData.append('service_provider_id', service_provider_id);
            formData.append('description_of_service', description_of_service);
            formData.append('cost', cost);
            if (image_upload) {
                formData.append('image_upload', image_upload);
            }

            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post("/create-maintance", formData, HeaderToken());
            hideLoader();

            if (res.data.status === "success") {
                successToast(res.data.message);
                document.getElementById("save-form").reset();
                await getList();
            } else {
                errorToast(res.data.message);
            }
        }
    } catch (e) {
        unauthorized(e.response.status);
    }
}

</script>
