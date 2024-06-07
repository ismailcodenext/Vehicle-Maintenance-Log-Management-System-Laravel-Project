<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Service Type</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="update_id" readonly>
                                <label class="form-label">Service Type ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="update_service_type_id" readonly>
                                <label class="form-label">Service Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_service_name">

                                <label class="form-label">Service Provider ID <span class="text-danger">*</span></label>
                                <select class="form-control form_input" id="update_service_provider_id">
                                    <option value="">Select Service Provider</option>
                                </select>

                                <label class="form-label">Service Interval</label>
                                <input type="number" class="form-control form_input" id="update_service_interval">

                                <label class="form-label">Service Description</label>
                                <textarea class="form-control form_input" id="update_service_description"></textarea>

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
    getServiceProviderList();
});

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
        let res = await axios.post("/service-type-by-id", { id: id.toString(), service_type_id: service_type_id.toString() }, HeaderToken());
        hideLoader();

        let data = res.data.rows;
        document.getElementById('updateID').value = data.id;
        document.getElementById('update_service_type_id').value = data.service_type_id;
        document.getElementById('update_service_name').value = data.service_name;
        document.getElementById('update_service_provider_id').value = data.service_provider_id;
        document.getElementById('update_service_interval').value = data.service_interval;
        document.getElementById('update_service_description').value = data.service_description;
    } catch (e) {
        unauthorized(e.response.status);
    }
}

async function Update() {
    try {
        let id = document.getElementById('updateID').value;
        let service_type_id = document.getElementById('update_service_type_id').value;
        let service_name = document.getElementById('update_service_name').value;
        let service_provider_id = document.getElementById('update_service_provider_id').value;
        let service_interval = document.getElementById('update_service_interval').value;
        let service_description = document.getElementById('update_service_description').value;
        let user_id = document.getElementById('update_user_id').value;

        if (service_type_id.length === 0) {
            errorToast("Service Type ID Required!");
        } else if (service_name.length === 0) {
            errorToast("Service Name Required!");
        } else if (service_provider_id.length === 0) {
            errorToast("Service Provider ID Required!");
        } else {
            let formData = new FormData();
            formData.append('id', id);
            formData.append('service_type_id', service_type_id);
            formData.append('service_name', service_name);
            formData.append('service_provider_id', service_provider_id);
            formData.append('service_interval', service_interval);
            formData.append('service_description', service_description);


            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-service-type", formData, HeaderToken());
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
