<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="create-modal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Driver</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">vehicles <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="vehicle">
                                </select>
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Drivers <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="driver">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Assigned Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="date">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label"> Status <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn modal_close_btn" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn" style="width: auto;">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchVehicles();
        fetchDrivers();
    });
    async function fetchVehicles() {
        try {

            const response = await fetch('/active-list-vehicles');
            const data = await response.json();
            if (data.status === "success") {
                const vehicles = data.Driver_data;
                const categorySelect = document.getElementById('vehicle');

                vehicles.forEach(vehicle => {
                    const option = document.createElement('option');
                    option.value = vehicle.id;
                    option.textContent = vehicle.brand + '  =>  ' + vehicle.model;
                    categorySelect.appendChild(option);
                });

            } else {
                console.error('Failed to fetch vehicle data:', data_vehicle);
            }

        } catch (error) {
            console.error('Error fetching vehicle data:', error);
        }
    }
    async function fetchDrivers() {
        try {

            const response = await fetch('/list-driver');
            const data = await response.json();
            if (data.status === "success") {
                const drivers = data.Driver_data;
                const driverSelect = document.getElementById('driver');

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
    async function Save() {
        try {
            let vehicle_id = document.getElementById('vehicle').value;
            let driver_id = document.getElementById('driver').value;
            let date = document.getElementById('date').value;
            let status = document.getElementById('status').value;

            if (vehicle_id.length === 0) {
                errorToast("vehicle Required !");
            } else if (driver_id.length === 0) {
                errorToast("Driver Required !");
            } else if (date.length === 0) {
                errorToast("Assigned Date Required !");
            } else if (status.length === 0) {
                errorToast("Status Required !");
            } else {
                document.getElementById('modal-close').click();
                let formData = new FormData();
                formData.append('vehicle_id', vehicle_id);
                formData.append('driver_id', driver_id);
                formData.append('date', date);
                formData.append('status', status);
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        ...HeaderToken().headers
                    }
                }

                showLoader();
                let res = await axios.post("/create-vehicle-assigned-to-driver", formData, config);
                hideLoader();

                if (res.data['status'] === "success") {
                    successToast(res.data['message']);
                    document.getElementById("save-form").reset();
                    await getList();
                } else {
                    console.log(res.data['message']);
                    errorToast(res.data['message'])
                }
            }

        } catch (e) {
            console.log(e.response.status);
            unauthorized(e.response.status)
        }
    }
</script>
