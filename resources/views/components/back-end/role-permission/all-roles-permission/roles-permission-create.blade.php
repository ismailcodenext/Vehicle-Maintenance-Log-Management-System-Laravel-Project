<!-- Add Role in Permission Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addPermissionForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Permissions to Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-select" id="role_id" required>
                            <!-- Options will be loaded dynamically -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div id="permissionsList">
                            <!-- Permissions checkboxes will be loaded dynamically -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Permissions</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        async function loadRolesAndPermissions() {
            try {
                let rolesRes = await axios.get('/list-roles');
                let permissionsRes = await axios.get('/list-permissions-grouped');

                let roleSelect = document.getElementById('role_id');
                let permissionsList = document.getElementById('permissionsList');

                if (!roleSelect || !permissionsList) {
                    console.error('Required elements not found in the DOM');
                    return;
                }

                // console.log('Roles:', rolesRes.data);
                // console.log('Permissions:', permissionsRes.data);


                let roles = rolesRes.data.length ? rolesRes.data[0] : [];


                let permissions = permissionsRes.data[0]; // Unwraps the outer array

                roleSelect.innerHTML = '';
                permissionsList.innerHTML = '';

                // Populate roles dropdown
                roles.forEach(role => {
                    let option = new Option(role.name, role.id);
                    roleSelect.add(option);
                });

                // Populate permissions checkboxes
                Object.keys(permissions).forEach(group => {
                    let groupDiv = document.createElement('div');
                    groupDiv.className = 'mb-3';

                    let groupLabel = document.createElement('label');
                    groupLabel.className = 'form-label';
                    groupLabel.textContent = group;
                    groupDiv.appendChild(groupLabel);

                    let permissionsArray = permissions[group];
                    if (Array.isArray(permissionsArray)) {
                        permissionsArray.forEach(permission => {
                            let checkboxDiv = document.createElement('div');
                            checkboxDiv.className = 'form-check';

                            let checkbox = document.createElement('input');
                            checkbox.className = 'form-check-input';
                            checkbox.type = 'checkbox';
                            checkbox.name = 'permission_ids[]';
                            checkbox.value = permission.id;

                            let checkboxLabel = document.createElement('label');
                            checkboxLabel.className = 'form-check-label';
                            checkboxLabel.textContent = permission.name;

                            checkboxDiv.appendChild(checkbox);
                            checkboxDiv.appendChild(checkboxLabel);
                            groupDiv.appendChild(checkboxDiv);
                        });
                    } else {
                        console.error(`Permissions group ${group} is not an array:`, permissionsArray);
                    }

                    permissionsList.appendChild(groupDiv);
                });
            } catch (error) {
                console.error('Error loading roles and permissions:', error);
            }
        }

        let addPermissionForm = document.getElementById('addPermissionForm');
        if (addPermissionForm) {
            addPermissionForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                try {
                    let role_id = document.getElementById('role_id').value;
                    let permission_ids = Array.from(document.querySelectorAll('input[name="permission_ids[]"]:checked')).map(checkbox => checkbox.value);

                    let response = await axios.post('/add-permission-to-role', {
                        role_id: role_id,
                        permission_ids: permission_ids
                    });

                    if (response.data.success) {
                        let createModal = bootstrap.Modal.getInstance(document.getElementById('create-modal'));
                        createModal.hide();
                        await getList(); // Refresh the roles and permissions list
                    } else {
                        alert(response.data.message);
                    }
                } catch (error) {
                    console.error('Error adding permission:', error);
                }
            });
        } else {
            console.error('Form with ID "addPermissionForm" not found.');
        }

        async function getList() {
            try {
                showLoader();
                let res = await axios.get("/list-roles-permission");
                hideLoader();

                let tableList = document.getElementById('tableList');
                let tableData = document.getElementById('tableData');

                if (!tableList || !tableData) {
                    console.error('Table elements not found in the DOM');
                    return;
                }

                if ($.fn.DataTable.isDataTable('#tableData')) {
                    $('#tableData').DataTable().destroy();
                }
                tableList.innerHTML = '';

                res.data.roles.forEach(function(item, index) {
                    let permissions = item.permissions.map(permission => permission.name).join(', ');

                    let row = document.createElement('tr');
                    row.innerHTML = `<td>${index + 1}</td>
                                 <td>${item.name}</td>
                                 <td>${permissions}</td>
                                 <td>
                                     <div style="display: flex;" class="modelBtn">
                                         <button data-id="${item.id}" class="float-end editBtn btn btn-primary btn-sm"> <span><i class="fa-solid fa-pen-to-square"></i></span> Edit</button>
                                         <button data-id="${item.id}" class="float-end deleteBtn btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                                     </div>
                                 </td>`;
                    tableList.appendChild(row);
                });

                document.querySelectorAll('.editBtn').forEach(button => {
                    button.addEventListener('click', async function() {
                        let id = this.getAttribute('data-id');
                        await FillUpUpdateForm(id);
                        let updateModal = new bootstrap.Modal(document.getElementById('update-modal'));
                        updateModal.show();
                    });
                });

                document.querySelectorAll('.deleteBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id');
                        document.getElementById('deleteID').value = id;
                        let deleteModal = new bootstrap.Modal(document.getElementById('delete-modal'));
                        deleteModal.show();
                    });
                });

                new DataTable('#tableData', {
                    order: [[0, 'asc']],
                    lengthMenu: [5, 10, 15, 20, 30]
                });

            } catch (e) {
                unauthorized(e.response.status);
            }
        }

        getList();

        let createModalElement = document.getElementById('create-modal');
        if (createModalElement) {
            createModalElement.addEventListener('shown.bs.modal', loadRolesAndPermissions);
        } else {
            console.error('Element with ID "create-modal" not found.');
        }
    });
</script>

