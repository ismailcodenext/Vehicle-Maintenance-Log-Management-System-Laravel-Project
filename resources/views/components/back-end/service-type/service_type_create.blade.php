<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Service Type Create</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Service Type Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="service_name">

                                <label class="form-label">Service Provider<span class="text-danger">*</span></label>
                                <select class="form-control form_input" id="service_provider_id">
                                    <option value="">Select Service Provider</option>
                                </select>

                                <label class="form-label">Service Interval</label>
                                <input type="number" class="form-control form_input" id="service_interval">

                                <label class="form-label">Service Description</label>
                                <textarea class="form-control form_input" id="service_description"></textarea>
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
// document.addEventListener('DOMContentLoaded', function () {
//     getServiceProviderList();
// });

// document.addEventListener('DOMContentLoaded', getServiceProviderList);
getServiceProviderList()
async function getServiceProviderList() {
    try {
        const response = await fetch('/list-service-provider');
        const data = await response.json();
        if (data.status === "success") {
            const vehicles = data.ServiceProvider_data; // Corrected key to match your provided data structure
            const serviceProviderSelect = document.getElementById('service_provider_id');

            vehicles.forEach(service_provider_id => {
                const option = document.createElement('option');
                option.value = service_provider_id.id;
                option.textContent = service_provider_id.name; // Display the model as the option text
                serviceProviderSelect.appendChild(option);
            });
        } else {
            console.error('Failed to Service Provider data:', data);
        }
    } catch (error) {
        console.error('Error fetching vehicle data:', error);
    }

}



async function Save() {
    try {

        let service_name = document.getElementById('service_name').value;
        let service_provider_id = document.getElementById('service_provider_id').value;
        let service_interval = document.getElementById('service_interval').value;
        let service_description = document.getElementById('service_description').value;



       if (service_name.length === 0) {
            errorToast("Service Name Required!");
        } else if (service_provider_id.length === 0) {
            errorToast("Service Provider ID Required!");
        } else {
            let formData = new FormData();

            formData.append('service_name', service_name);
            formData.append('service_provider_id', service_provider_id);
            formData.append('service_interval', service_interval);
            formData.append('service_description', service_description);


            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post("/create-service-type", formData, HeaderToken());
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
