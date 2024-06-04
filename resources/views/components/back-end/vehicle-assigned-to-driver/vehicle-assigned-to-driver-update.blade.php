<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="update-modal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Test</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">

                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">vehicles <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="edit_vehicle">
                                </select>
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Drivers <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="edit_driver">
                                </select>
                            </div>
                            <input class="d-none" id="updateID">
                        </div>
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Assigned Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="edit_date">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label"> Status <span class="text-danger">*</span></label>
                                <select class="form-select form_input" id="edit_status">
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn modal_close_btn" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update(event)" id="update-btn" class="btn modal_update_btn"
                    style="width: auto;">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function fetchVehiclesUpdate() {
        try {

            const response = await fetch('/active-list-vehicles');
            const data = await response.json();
            if (data.status === "success") {
                const vehicles = data.Driver_data;
                const categorySelect = document.getElementById('edit_vehicle');

                vehicles.forEach(vehicle => {
                    const option = document.createElement('option');
                    option.value = vehicle.id;
                    option.textContent = vehicle.brand + '  =>  ' + vehicle.model;
                    categorySelect.appendChild(option);
                });

            } else {
                console.error('Failed to fetch vehicle data:', data);
            }

        } catch (error) {
            console.error('Error fetching vehicle data:', error);
        }
    }
    async function fetchDriversUpdate() {
        try {

            const response = await fetch('/list-driver');
            const data = await response.json();
            if (data.status === "success") {
                const drivers = data.Driver_data;
                const driverSelect = document.getElementById('edit_driver');

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
            let res = await axios.post("/vehicle-assigned-to-driver-by-id", {
                id: id.toString()
            }, HeaderToken());
            hideLoader();

            let data = res.data.rows;
            document.getElementById('edit_vehicle').value = data.vehicle_id;
            document.getElementById('edit_driver').value = data.driver_id;
            document.getElementById('edit_date').value = data.date;
            document.getElementById('edit_status').value = data.status;
            // console.log(data.medical_clearance_status);

        } catch (e) {
            unauthorized(e.response.status);
        }
    }

    async function Update() {
        try {
            let vehicle_id = document.getElementById('edit_vehicle').value;
            let driver_id = document.getElementById('edit_driver').value;
            let date = document.getElementById('edit_date').value;
            let status = document.getElementById('edit_status').value;
            let id = document.getElementById('updateID').value;

            document.getElementById('update-modal-close').click();

            let formData = new FormData();
            formData.append('vehicle_id', vehicle_id);
            formData.append('driver_id', driver_id);
            formData.append('date', date);
            formData.append('status', status);
            formData.append('id', id);
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    ...HeaderToken().headers
                }
            };
            // console.log(formData.get('status'));

            showLoader();

            let res = await axios.post("/update-vehicle-assigned-to-driver", formData, config);
            hideLoader();

            if (res.data.status === "success") {
                successToast(res.data.message);
                let modal = new bootstrap.Modal(document.getElementById('update-modal'));
                document.getElementById('update-form').reset();
                modal.hide();
                await getList();
            } else {
                console.log(res.data.message);
                errorToast(res.data.message);

            }

        } catch (e) {
            console.log(e);
            unauthorized(e.response.status);
        }
    }
</script>
