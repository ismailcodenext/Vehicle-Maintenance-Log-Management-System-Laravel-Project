<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Vehicles</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Vehicle</label>
                                <select class="form-control form_input" disabled id="update_vehicle">
                                    <option value="none">Select Vehicle</option>
                                </select>

                                <label class="form-label">Registration Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_registration_number">

                                <label class="form-label">Registration Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="update_registration_expiry_date">

                                <label class="form-label">Insurance Number</label>
                                <input type="text" class="form-control form_input" id="update_insurance_number">

                                <label class="form-label">Insurance Expiry Date</label>
                                <input type="date" class="form-control form_input" id="update_insurance_expiry_date">

                                <label class="form-label">Tax Token Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_tax_token_number">

                                <label class="form-label">Tax Token Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="update_tax_token_expiry_date">

                                <label class="form-label">Fitness Certificate Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_fitness_certificate_number">

                                <label class="form-label">Fitness Certificate Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="update_fitness_certificate_expiry_date">

                                <label class="form-label">Permit Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_permit_number">

                                <label class="form-label">Permit Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="update_permit_expiry_date">

                                <label class="form-label">Road Worthiness Certificate Number</label>
                                <input type="text" class="form-control form_input" id="update_road_worthiness_certificate_number">

                                <label class="form-label">Road Worthiness Certificate Expiry Date</label>
                                <input type="date" class="form-control form_input" id="update_road_worthiness_certificate_expiry_date">

                                <label class="form-label">Emission Test Certificate Number</label>
                                <input type="text" class="form-control form_input" id="update_emission_test_certificate_number">

                                <label class="form-label">Emission Test Certificate Expiry Date</label>
                                <input type="date" class="form-control form_input" id="update_emission_test_certificate_expiry_date">

                                <label class="form-label">Note</label>
                                <textarea class="form-control form_input" id="update_note"></textarea>

                                <label class="form-label">Status</label>
                                <select class="form-control form_input" id="update_status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
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
    document.addEventListener('DOMContentLoaded', fetchVehicles);
    async function fetchVehicles() {
        try {
            // Replace 'your-api-endpoint' with the actual endpoint URL
            const response = await fetch('/active-list-vehicles');
            const data = await response.json();

            if (data.status === "success") {
                const vehicles = data.Driver_data; // Corrected key to match your provided data structure
                const categorySelect = document.getElementById('update_vehicle');

                vehicles.forEach(vehicle => {
                    const option = document.createElement('option');
                    option.value = vehicle.id;
                    option.textContent = vehicle.brand+'  =>  '+vehicle.model; // Display the model as the option text
                    categorySelect.appendChild(option);
                });
            } else {
                console.error('Failed to fetch vehicle data:', data);
            }
        } catch (error) {
            console.error('Error fetching vehicle data:', error);
        }
    }
    async function FillUpUpdateForm(id) {
        try {
            // Set the updateID field with the provided id
            document.getElementById('updateID').value = id;

            // Show the loader (you might need to define these functions elsewhere)
            showLoader();

            // Send a POST request to fetch vehicle document details by ID
            let res = await axios.post("/vehicles-documents-by-id", { id: id.toString() }, HeaderToken());

            // Hide the loader after receiving the response
            hideLoader();

            // Get the data from the response
            let data = res.data.rows;

            // Fill up the form fields with the received data
            document.getElementById('update_vehicle').value = data.vehicle_id;
            document.getElementById('update_registration_number').value = data.registration_number;
            document.getElementById('update_registration_expiry_date').value = data.registration_expiry_date;
            document.getElementById('update_insurance_number').value = data.insurance_number;
            document.getElementById('update_insurance_expiry_date').value = data.insurance_expiry_date;
            document.getElementById('update_tax_token_number').value = data.tax_token_number;
            document.getElementById('update_tax_token_expiry_date').value = data.tax_token_expiry_date;
            document.getElementById('update_fitness_certificate_number').value = data.fitness_certificate_number;
            document.getElementById('update_fitness_certificate_expiry_date').value = data.fitness_certificate_expiry_date;
            document.getElementById('update_permit_number').value = data.permit_number;
            document.getElementById('update_permit_expiry_date').value = data.permit_expiry_date;
            document.getElementById('update_road_worthiness_certificate_number').value = data.road_worthiness_certificate_number;
            document.getElementById('update_road_worthiness_certificate_expiry_date').value = data.road_worthiness_certificate_expiry_date;
            document.getElementById('update_emission_test_certificate_number').value = data.emission_test_certificate_number;
            document.getElementById('update_emission_test_certificate_expiry_date').value = data.emission_test_certificate_expiry_date;
            document.getElementById('update_note').value = data.note;
            document.getElementById('update_status').value = data.status;
        } catch (e) {
            // Handle unauthorized error
            if (e.response && e.response.status === 401) {
                unauthorized(e.response.status);
            } else {
                console.error('Error fetching vehicle document data:', e);
            }
        }
    }



    async function Update() {
        try {
            let  vehicle       = document.getElementById('update_vehicle').value;
            let  registration_number         = document.getElementById('update_registration_number').value;
            let  registration_expiry_date          = document.getElementById('update_registration_expiry_date').value;
            let  insurance_number          = document.getElementById('update_insurance_number').value;
            let  insurance_expiry_date           = document.getElementById('update_insurance_expiry_date').value;
            let  tax_token_number            = document.getElementById('update_tax_token_number').value;
            let  tax_token_expiry_date        = document.getElementById('update_tax_token_expiry_date').value;
            let  fitness_certificate_number          = document.getElementById('update_fitness_certificate_number').value;
            let  fitness_certificate_expiry_date        = document.getElementById('update_fitness_certificate_expiry_date').value;
            let  permit_number  = document.getElementById('update_permit_number').value;
            let  permit_expiry_date        = document.getElementById('update_permit_expiry_date').value;
            let  road_worthiness_certificate_number         = document.getElementById('update_road_worthiness_certificate_number').value;
            let  road_worthiness_certificate_expiry_date         = document.getElementById('update_road_worthiness_certificate_expiry_date').value;
            let  emission_test_certificate_number         = document.getElementById('update_emission_test_certificate_number').value;
            let  emission_test_certificate_expiry_date         = document.getElementById('update_emission_test_certificate_expiry_date').value;
            let  note         = document.getElementById('update_note').value;
            let  status         = document.getElementById('update_status').value;
            let     updateID = document.getElementById('updateID').value;

            document.getElementById('update-modal-close').click();

            showLoader();

            let res = await axios.post("/update-vehicles-documents", {
                    id:updateID,
                    registration_number:registration_number,
                    registration_expiry_date:registration_expiry_date,
                    insurance_number:insurance_number,
                    insurance_expiry_date:insurance_expiry_date,
                    tax_token_number:tax_token_number,
                    tax_token_expiry_date:tax_token_expiry_date,
                    fitness_certificate_number:fitness_certificate_number,
                    fitness_certificate_expiry_date:fitness_certificate_expiry_date,
                    permit_number:permit_number,
                    permit_expiry_date:permit_expiry_date,
                    road_worthiness_certificate_number:road_worthiness_certificate_number,
                    road_worthiness_certificate_expiry_date:road_worthiness_certificate_expiry_date,
                    emission_test_certificate_number:emission_test_certificate_number,
                    emission_test_certificate_expiry_date:emission_test_certificate_expiry_date,
                    note:note,
                    status:status,
                },
                HeaderToken()
            );
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
