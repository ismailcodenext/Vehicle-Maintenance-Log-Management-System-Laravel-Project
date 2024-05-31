<div class="modal animated zoomIn" style="z-index: 99999999 !important;" id="create-modal" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permission Create</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_input" id="name">
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
    async function Save() {
        try {
            let name = document.getElementById('name').value;

            if (name.length === 0) {
                errorToast("Name Required !");
            } else {
                document.getElementById('modal-close').click();
                let formData = new FormData();
                formData.append('name', name);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        ...HeaderToken().headers
                    }
                }

                showLoader();
                let res = await axios.post("/create-permission", formData, config);
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
