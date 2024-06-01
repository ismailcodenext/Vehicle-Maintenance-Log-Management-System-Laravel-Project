<div class="modal animated zoomIn" style="z-index: 99999999 !important;"  id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vehicles Create</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Vehicle Category</label>
                                <select class="form-control form_input" id="category">
                                    <option value="none">Select Vehicle Category</option>
                                </select>

{{--                                <label class="form-label">Driver</label>--}}
{{--                                <select class="form-control form_input" id="driver">--}}
{{--                                    <option value="none">Select Driver</option>--}}
{{--                                </select>--}}

                                <label class="form-label"> Brand Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="brand">

                                <label class="form-label">Model <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="model">

                                <label class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="year">

                                <label class="form-label">VIN (Vehicle Identification Number) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="vin">

                                <label class="form-label">License Plate Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="license">

                                <label class="form-label">Color <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="color">

                                <label class="form-label">Mileage <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form_input" id="mileage">

                                <label class="form-label">Purchase Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form_input" id="purchase_date">

                                <label class="form-label">History</label>
                                <textarea class="form-control form_input" id="history"></textarea>

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
    document.addEventListener('DOMContentLoaded', fetchCategories);
    // document.addEventListener('DOMContentLoaded', fetchActiveDrivers);
    async function fetchCategories() {
        try {
            // Replace 'your-api-endpoint' with the actual endpoint URL
            const response = await fetch('/list-vehicles-category');
            const data = await response.json();

            if (data.status === "success") {
                const vehicles = data.vehicles_data;
                const categorySelect = document.getElementById('category');

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
    // async function fetchActiveDrivers() {
    //     try {
    //         // Replace 'your-api-endpoint' with the actual endpoint URL
    //         const response = await fetch('active-list-driver');
    //         const data = await response.json();
    //
    //         if (data.status === "success") {
    //             const drivers = data.Driver_data;
    //             const driverSelect = document.getElementById('driver');
    //
    //             drivers.forEach(driver => {
    //                 const option = document.createElement('option');
    //                 option.value = driver.id;
    //                 option.textContent = driver.full_name;
    //                 driverSelect.appendChild(option);
    //             });
    //         } else {
    //             console.error('Failed to fetch driver data:', data);
    //         }
    //     } catch (error) {
    //         console.error('Error fetching driver data:', error);
    //     }
    // }


    async function Save() {
        try {
            let  category       = document.getElementById('category').value;
            // let  driver         = document.getElementById('driver').value;
            let  brand          = document.getElementById('brand').value;
            let  model          = document.getElementById('model').value;
            let  year           = document.getElementById('year').value;
            let  vin            = document.getElementById('vin').value;
            let  license        = document.getElementById('license').value;
            let  color          = document.getElementById('color').value;
            let  mileage        = document.getElementById('mileage').value;
            let  purchase_date  = document.getElementById('purchase_date').value;
            let  history        = document.getElementById('history').value;
            let  status         = document.getElementById('status').value;
            if(brand.length === 0){
                errorToast("Brand Required !");
            }else if(model.length === 0){
                errorToast("Model Required !");
            }else if(year.length === 0){
                errorToast("Year Required !");
            }else if(vin.length === 0){
                errorToast("VIN Required !");
            }else if(isNaN(year)){
                errorToast("Year Should Be Number !");
            }else if(license.length === 0){
                errorToast("License Required !");
            }else if(color.length === 0){
                errorToast("Color Required !");
            }else if(license.length === 0){
                errorToast("License Required !");
            }else if(mileage.length === 0){
                errorToast("Mileage Required !");
            }else if(purchase_date.length === 0){
                errorToast("purchase Date Required !");
            }else {
                document.getElementById('modal-close').click();
                showLoader();
                let res = await axios.post("/create-vehicles",
                {
                    category:category,
                    // driver:driver,
                    brand:brand,
                    model:model,
                    year:year,
                    vin:vin,
                    license_plate:license,
                    color:color,
                    mileage:mileage,
                    purchase_date:purchase_date,
                    history:history,
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
