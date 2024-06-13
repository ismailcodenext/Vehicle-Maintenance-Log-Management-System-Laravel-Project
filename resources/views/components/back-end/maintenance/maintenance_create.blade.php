<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label class="form-label">Vehicle Name</label>
                                <select class="form-control form_input" id="vehicle_id">
                                    <option value="">Select Vehicle Name</option>
                                </select>

                                <label class="form-label">Date of Service <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="date_of_service">

                                <label class="form-label">Mileage at Service <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="mileage_at_service">

                                <label class="form-label">Service Type ID</label>
                                <select class="form-control form_input" id="service_type_id">
                                    <option value="none">Service Type ID</option>
                                </select>

                                <label class="form-label">Service Provider ID</label>
                                <select class="form-control form_input" id="service_provider_id">
                                    <option value="">Select Service Provider</option>
                                </select>

                                <label class="form-label">Description of Service <span class="text-danger">*</span></label>
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
    // Fetch and populate the dropdown lists for vehicles, service providers, and service types
    document.addEventListener('DOMContentLoaded', function() {
        getServiceProviderList();
        fetchVehiclesBrand();
        servicesTypeIDName();
    });

    async function getServiceProviderList() {
        try {
            const response = await fetch('/list-service-provider');
            const data = await response.json();
            if (data.status === "success") {
                const serviceProviders = data.ServiceProvider_data;
                const select = document.getElementById('service_provider_id');
                serviceProviders.forEach(function(provider) {
                    const option = document.createElement('option');
                    option.value = provider.id;
                    option.textContent = provider.name;
                    select.appendChild(option);
                });
            } else {
                console.error('Failed to fetch service provider data:', data);
            }
        } catch (error) {
            console.error('Error fetching service provider data:', error);
        }
    }

    async function fetchVehiclesBrand() {
        try {
            const response = await fetch('/list-vehicles');
            const data = await response.json();
            if (data.status === "success") {
                const vehicles = data.vehicles_data;
                const select = document.getElementById('vehicle_id');
                vehicles.forEach(vehicle => {
                    const option = document.createElement('option');
                    option.value = vehicle.id;
                    option.textContent = vehicle.brand + '  =>  ' + vehicle.model;
                    select.appendChild(option);
                });
            } else {
                console.error('Failed to fetch vehicle data:', data);
            }
        } catch (error) {
            console.error('Error fetching vehicle data:', error);
        }
    }

    async function servicesTypeIDName() {
        try {
            const response = await fetch('/list-service-type');
            const data = await response.json();
            if (data.status === "success") {
                const serviceTypes = data.servicetype_data;
                const select = document.getElementById('service_type_id');
                serviceTypes.forEach(type => {
                    const option = document.createElement('option');
                    option.value = type.id;
                    option.textContent = type.service_name;
                    select.appendChild(option);
                });
            } else {
                console.error('Failed to fetch service type data:', data);
            }
        } catch (error) {
            console.error('Error fetching service type data:', error);
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
            let imgInput = document.getElementById('image_upload');
            let imgFile = imgInput.files[0];

            if (!vehicle_id || !date_of_service || !mileage_at_service || !service_type_id || !service_provider_id || !description_of_service || !cost) {
                alert("All fields are required!"); // Or use your preferred method for showing errors
                return;
            }

            const formData = new FormData();
            formData.append('vehicle_id', vehicle_id);
            formData.append('date_of_service', date_of_service);
            formData.append('mileage_at_service', mileage_at_service);
            formData.append('service_type_id', service_type_id);
            formData.append('service_provider_id', service_provider_id);
            formData.append('description_of_service', description_of_service);
            formData.append('cost', cost);
            formData.append('img', imgFile);

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };

            let res = await axios.post("/create-maintenance", formData, config);
            if (res.data && res.data.status === "success") {
                alert(res.data.message); // Or use your preferred method for showing success
                document.getElementById("save-form").reset();
            } else {
                alert(res.data && res.data.message ? res.data.message : "Something went wrong!");
            }
        } catch (error) {
            alert("An unexpected error occurred.");
            console.error('Error:', error);
        }
    }
</script>
