<div class="modal animated zoomIn" style="z-index: 99999999 !important;"  id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vehicle Document & Registration Create</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Vehicle</label>
                                <select class="form-control form_input" id="vehicle">
                                    <option value="none">Select Vehicle</option>
                                </select>

                                <label class="form-label">Registration Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="registration_number">

                                <label class="form-label">Registration Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="registration_expiry_date">

                                <label class="form-label">Insurance Number</label>
                                <input type="text" class="form-control form_input" id="insurance_number">

                                <label class="form-label">Insurance Expiry Date</label>
                                <input type="date" class="form-control form_input" id="insurance_expiry_date">

                                <label class="form-label">Tax Token Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="tax_token_number">

                                <label class="form-label">Tax Token Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="tax_token_expiry_date">

                                <label class="form-label">Fitness Certificate Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="fitness_certificate_number">

                                <label class="form-label">Fitness Certificate Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="fitness_certificate_expiry_date">

                                <label class="form-label">Permit Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="permit_number">

                                <label class="form-label">Permit Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="permit_expiry_date">

                                <label class="form-label">Road Worthiness Certificate Number</label>
                                <input type="text" class="form-control form_input" id="road_worthiness_certificate_number">

                                <label class="form-label">Road Worthiness Certificate Expiry Date</label>
                                <input type="date" class="form-control form_input" id="road_worthiness_certificate_expiry_date">

                                <label class="form-label">Emission Test Certificate Number</label>
                                <input type="text" class="form-control form_input" id="emission_test_certificate_number">

                                <label class="form-label">Emission Test Certificate Expiry Date</label>
                                <input type="date" class="form-control form_input" id="emission_test_certificate_expiry_date">

                                <label class="form-label">Note</label>
                                <textarea class="form-control form_input" id="note"></textarea>

                                <label class="form-label">Status</label>
                                <select class="form-control form_input" id="status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
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
    document.addEventListener('DOMContentLoaded', fetchVehicles);
    async function fetchVehicles() {
        try {
            // Replace 'your-api-endpoint' with the actual endpoint URL
            const response = await fetch('/active-list-vehicles');
            const data = await response.json();

            if (data.status === "success") {
                const vehicles = data.Driver_data; // Corrected key to match your provided data structure
                const categorySelect = document.getElementById('vehicle');

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
    async function Save() {
        try {
            let  vehicle                                    = document.getElementById('vehicle').value;
            let  registration_number                        = document.getElementById('registration_number').value;
            let  registration_expiry_date                   = document.getElementById('registration_expiry_date').value;
            let  insurance_number                           = document.getElementById('insurance_number').value;
            let  insurance_expiry_date                      = document.getElementById('insurance_expiry_date').value;
            let  tax_token_number                           = document.getElementById('tax_token_number').value;
            let  tax_token_expiry_date                      = document.getElementById('tax_token_expiry_date').value;
            let  fitness_certificate_number                 = document.getElementById('fitness_certificate_number').value;
            let  fitness_certificate_expiry_date            = document.getElementById('fitness_certificate_expiry_date').value;
            let  permit_number                              = document.getElementById('permit_number').value;
            let  permit_expiry_date                         = document.getElementById('permit_expiry_date').value;
            let  road_worthiness_certificate_number         = document.getElementById('road_worthiness_certificate_number').value;
            let  road_worthiness_certificate_expiry_date    = document.getElementById('road_worthiness_certificate_expiry_date').value;
            let  emission_test_certificate_number           = document.getElementById('emission_test_certificate_number').value;
            let  emission_test_certificate_expiry_date      = document.getElementById('emission_test_certificate_expiry_date').value;
            let  note                                       = document.getElementById('note').value;
            let  status                                     = document.getElementById('status').value;
            if(vehicle === 'none'){
                errorToast("vehicle Required !");
            }else if(registration_number.length === 0){
                errorToast("Registration Number Required !");
            }else if(registration_expiry_date.length === 0){
                errorToast("Registration Expiry Date Required !");
            }else if(tax_token_number.length === 0){
                errorToast("Tax Token Number Required !");
            }else if(tax_token_expiry_date.length === 0){
                errorToast("Tax Token Expiry Date Required !");
            }else if(fitness_certificate_number.length === 0){
                errorToast("Fitness Certificate Number Required !");
            }else if(fitness_certificate_expiry_date.length === 0){
                errorToast("Fitness Certificate Expiry Date Required !");
            }else if(permit_number.length === 0){
                errorToast("Permit Number Required !");
            }else if(permit_expiry_date.length === 0){
                errorToast("Permit Expiry Date Required !");
            }else {
                document.getElementById('modal-close').click();
                showLoader();
                let res = await axios.post("/create-vehicles-documents",
                {
                    vehicle:vehicle,
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
                }, HeaderToken());
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
