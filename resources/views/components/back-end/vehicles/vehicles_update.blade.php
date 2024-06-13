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
                                <label class="form-label">Vehicle Category</label>
                                <select class="form-control form_input" id="update_category">
                                    <option value="none">Select Vehicle Category</option>
                                </select>


                                <label class="form-label"> Brand Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_brand">

                                <label class="form-label">Model <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_model">

                                <label class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="update_year">

                                <label class="form-label">VIN (Vehicle Identification Number) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_vin">

                                <label class="form-label">License Plate Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_license">

                                <label class="form-label">Color <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="update_color">

                                <label class="form-label">Mileage <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="update_mileage">

                                <label class="form-label">Purchase Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="update_purchase_date">

                                <label class="form-label">History</label>
                                <textarea class="form-control form_input" id="update_history"></textarea>

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
    document.addEventListener('DOMContentLoaded', fetchCategories);
    document.addEventListener('DOMContentLoaded', fetchActiveDrivers);
    async function fetchCategories() {
        try {
            // Replace 'your-api-endpoint' with the actual endpoint URL
            const response = await fetch('/list-vehicles-category');
            const data = await response.json();

            if (data.status === "success") {
                const vehicles = data.vehicles_data;
                const categorySelect = document.getElementById('update_category');

                vehicles.forEach(vehicle => {
                    const option = document.createElement('option');
                    option.value = vehicle.id;
                    option.textContent = vehicle.category_name;
                    categorySelect.appendChild(option);
                });
            } else {
                console.error('Failed to fetch vehicle data:', data);
            }
        } catch (error) {
            console.error('Error fetching vehicle data:', error);
        }
    }
    async function fetchActiveDrivers() {
        try {
            // Replace 'your-api-endpoint' with the actual endpoint URL
            const response = await fetch('active-list-driver');
            const data = await response.json();

            if (data.status === "success") {
                const drivers = data.Driver_data;
                const driverSelect = document.getElementById('update_driver');

                drivers.forEach(driver => {
                    const option = document.createElement('option');
                    option.value = driver.id;
                    option.textContent = driver.full_name;
                    driverSelect.appendChild(option);
                });
            } else {
                console.error('Failed to fetch driver data:', data);
            }
        } catch (error) {
            console.error('Error fetching driver data:', error);
        }
    }
    async function FillUpUpdateForm(id) {
        try {
            document.getElementById('updateID').value = id;
            showLoader();
            let res = await axios.post("/vehicles-by-id", { id: id.toString() }, HeaderToken());
            hideLoader();

            let data = res.data.rows;
            document.getElementById('update_category').value = data.vehicle_category_id;
            document.getElementById('update_brand').value = data.brand;
            document.getElementById('update_model').value = data.model;
            document.getElementById('update_year').value = data.year;
            document.getElementById('update_vin').value = data.vin;
            document.getElementById('update_license').value = data.license_plate;
            document.getElementById('update_color').value = data.color;
            document.getElementById('update_mileage').value = data.mileage;
            document.getElementById('update_purchase_date').value = data.purchase_date;
            document.getElementById('update_history').value = data.history;
            document.getElementById('update_status').value = data.status;
        } catch (e) {
            unauthorized(e.response.status);
        }
    }


    async function Update() {
        try {
            let  category       = document.getElementById('update_category').value;
            let  brand          = document.getElementById('update_brand').value;
            let  model          = document.getElementById('update_model').value;
            let  year           = document.getElementById('update_year').value;
            let  vin            = document.getElementById('update_vin').value;
            let  license        = document.getElementById('update_license').value;
            let  color          = document.getElementById('update_color').value;
            let  mileage        = document.getElementById('update_mileage').value;
            let  purchase_date  = document.getElementById('update_purchase_date').value;
            let  history        = document.getElementById('update_history').value;
            let  status         = document.getElementById('update_status').value;
            let updateID = document.getElementById('updateID').value;

            document.getElementById('update-modal-close').click();

            showLoader();

            let res = await axios.post("/update-vehicles", {
                id: updateID,
                category: category,
                brand: brand,
                model: model,
                year: year,
                vin: vin,
                license_plate: license,
                color: color,
                mileage: mileage,
                purchase_date: purchase_date,
                history: history,
                status: status,
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
