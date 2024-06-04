<div class="modal animated zoomIn" id="view-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-danger">Driver Details</h3>
                <input readonly class="d-none" id="viewID" />

                <div class="container mt-5">
                    <div class="row">
                        <!-- Repeat this section for each driver -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="" class="card-img-top" alt="Driver Image" id="view_image">
                                <div class="card-body">
                                    <h5 class="card-title">John Doe</h5>
                                    <p class="card-text"><strong>License Number:</strong> ABC123456</p>
                                    <p class="card-text"><strong>Phone:</strong> +1 (555) 123-4567</p>
                                    <p class="card-text"><strong>Email:</strong> johndoe@example.com</p>
                                    <p class="card-text"><strong>Address:</strong> 1234 Main St, Anytown, USA</p>
                                    <p class="card-text"><strong>Date of Birth:</strong> 1990-01-01</p>
                                    <p class="card-text"><strong>License Expiry Date:</strong> 2025-12-31</p>
                                    <p class="card-text"><strong>Medical Clearance Status:</strong> Yes</p>
                                    <p class="card-text"><strong>Driving History:</strong> 10 years of accident-free
                                        driving.</p>
                                    <p class="card-text"><strong>Status:</strong> Active</p>
                                </div>
                            </div>
                        </div>
                        <!-- End repeat -->
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    async function showDriverDetails(id) {
        try {
            document.getElementById('viewID').value = id;
            showLoader();
            let res = await axios.post("/driver-by-id", {
                id: id.toString()
            }, HeaderToken());
            hideLoader();




        } catch (e) {
            unauthorized(e.response.status);
        }
    }
</script>
