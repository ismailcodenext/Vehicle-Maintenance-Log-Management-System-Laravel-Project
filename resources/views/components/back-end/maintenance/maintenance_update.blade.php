<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Maintenance Record</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label">Vehicle ID <span class="text-danger">*</span></label>
                                <select class="form-control form_input" id="update_vehicle_id">
                                    <option value="">Select Vehicle</option>
                                </select>

                                <label class="form-label">Date of Service <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="update_date_of_service">

                                <label class="form-label">Mileage at Service <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="update_mileage_at_service">

                                <label class="form-label">Service Type ID</label>
                                <select class="form-control form_input" id="update_service_type_id">
                                    <option value="">Select Service Type</option>
                                </select>

                                <label class="form-label">Service Provider ID</label>
                                <select class="form-control form_input" id="update_service_provider_id">
                                    <option value="">Select Service Provider</option>
                                </select>

                                <label class="form-label">Description of Service <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_description_of_service">

                                <label class="form-label">Cost <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="update_cost">

                                <label class="form-label">Image Upload</label>
                                <input type="file" class="form-control form_input" id="update_image_upload">
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
document.addEventListener('DOMContentLoaded', function () {
    getVehicleList();
    getServiceTypeList();
    getServiceProviderList();
});

async function getVehicleList() {
    try {
        showLoader();
        let res = await axios.get("/list-vehicles", HeaderToken());
        hideLoader();
        const vehicles = res.data;
        const select = document.getElementById('update_vehicle_id');
        vehicles.forEach(function (vehicle) {
            const option = document.createElement('option');
            option.value = vehicle.id;
            option.textContent = vehicle.name;
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
        const serviceTypes = res.data;
        const select = document.getElementById('update_service_type_id');
        serviceTypes.forEach(function (type) {
            const option = document.createElement('option');
            option.value = type.id;
            option.textContent = type.name;
            select.appendChild(option);
        });
    } catch (e) {
        unauthorized(e.response.status);
    }
}

async function getServiceProviderList() {
    try {
        showLoader();
        let res = await axios.get("/list-service-provider", HeaderToken());
        hideLoader();
        const serviceProviders = res.data;
        const select = document.getElementById('update_service_provider_id');
        serviceProviders.forEach(function (provider) {
            const option = document.createElement('option');
            option.value = provider.id;
            option.textContent = provider.name;
            select.appendChild(option);
        });
    } catch (e) {
        unauthorized(e.response.status);
    }
}

async function FillUpUpdateForm(id) {
    try {
        showLoader();
        let res = await axios.post("/maintenance-by-id", { id: id.toString() }, HeaderToken());
        hideLoader();

        let data = res.data.rows;
        document.getElementById('updateID').value = data.id;
        document.getElementById('update_vehicle_id').value = data.vehicle_id;
        document.getElementById('update_date_of_service').value = data.date_of_service;
        document.getElementById('update_mileage_at_service').value = data.mileage_at_service;
        document.getElementById('update_service_type_id').value = data.service_type_id;
        document.getElementById('update_service_provider_id').value = data.service_provider_id;
        document.getElementById('update_description_of_service').value = data.description_of_service;
        document.getElementById('update_cost').value = data.cost;
    } catch (e) {
        unauthorized(e.response.status);
    }
}

async function Update() {
    try {
        let id = document.getElementById('updateID').value;
        let vehicle_id = document.getElementById('update_vehicle_id').value;
        let date_of_service = document.getElementById('update_date_of_service').value;
        let mileage_at_service = document.getElementById('update_mileage_at_service').value;
        let service_type_id = document.getElementById('update_service_type_id').value;
        let service_provider_id = document.getElementById('update_service_provider_id').value;
        let description_of_service = document.getElementById('update_description_of_service').value;
        let cost = document.getElementById('update_cost').value;
        let image_upload = document.getElementById('update_image_upload').files[0];

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
            formData.append('id', id);
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

            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-maintenance", formData, HeaderToken());
            hideLoader();

            if (res.data.status === "success") {
                successToast(res.data.message);
                let modal = new bootstrap.Modal(document.getElementById('update-modal'));
                modal.hide();
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
