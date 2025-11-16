

<?php $__env->startSection('title', 'Manage Rules'); ?>

<?php $__env->startSection('content'); ?>
    <div class="admin-dashboard"
        style="display:flex; min-height:100vh; font-family:'Poppins',sans-serif; background:#f8fbff; overflow-x:hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style="
        width:250px; background:#004AAD; color:white; position:fixed; top:0; left:-250px;
        height:100%; padding:20px 0; box-shadow:4px 0 10px rgba(0,0,0,0.1); transition:left 0.3s ease;
        z-index:1000; display:flex; flex-direction:column; justify-content:space-between;">
            <div>
                <div style="text-align:center; margin-bottom:25px;">
                    <img src="<?php echo e(asset('images/uptm-logo.png')); ?>" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="font-size:16px; margin:0;">SISWI Management</h3>
                </div>

                <ul style="list-style:none; padding:0 20px; line-height:2;">
                    <li><a href="/admin/dashboard"
                            style="color:white; text-decoration:none; display:block; padding:8px 10px;"> Dashboard</a>
                    </li>
                    <li><a href="/admin/students"
                            style="color:white; text-decoration:none; display:block; padding:8px 10px;"> Students</a></li>
                    <li><a href="/admin/houses" style="color:white; text-decoration:none; display:block; padding:8px 10px;">
                            Houses</a></li>
                    <li><a href="/admin/forms" style="color:white; text-decoration:none; display:block; padding:8px 10px;">
                            Forms</a></li>
                    <li><a href="/admin/payments"
                            style="color:white; text-decoration:none; display:block; padding:8px 10px;"> Payments</a></li>
                    <li><a href="/admin/outings"
                            style="color:white; text-decoration:none; display:block; padding:8px 10px;"> Outing</a></li>
                    <li><a href="/admin/rules"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Rules</a></li>
                </ul>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <div id="main-content" style="flex-grow:1; width:100%; transition:margin-left 0.3s ease;">

            <!-- ===== TOP NAVBAR ===== -->
            <div
                style="display:flex; justify-content:space-between; align-items:center; background:white; padding:15px 25px;
            box-shadow:0 2px 6px rgba(0,0,0,0.1); position:sticky; top:0; z-index:999;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span id="menu-toggle" style="font-size:26px; cursor:pointer; color:#004AAD;">☰</span>
                    <h2 style="color:#004AAD; margin:0;">Manage Rules</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="<?php echo e(auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/admin-avatar.png')); ?>"
                        alt="Admin" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style=" display: none; position: absolute; right: 0; top: 55px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 220px; overflow: hidden; ">
                        <div style="padding: 15px; border-bottom: 1px solid #eee;">
                            <strong><?php echo e(Auth::user()->name ?? 'Admin'); ?></strong><br>
                            <small><?php echo e(Auth::user()->email ?? 'admin@uptm.edu.my'); ?></small>
                        </div>

                        <a href="/admin/profile"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="<?php echo e(asset('images/profile.png')); ?>" alt="Profile" style="width: 20px; height: 20px;">
                            Edit Profile
                        </a>

                        <a href="/admin/settings"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="<?php echo e(asset('images/setting-icon.png')); ?>" alt="Settings"
                                style="width: 20px; height: 20px;">
                            Setting
                        </a>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                style="background: none; border: none; width: 100%; text-align: left; padding: 10px 15px; color: red; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <img src="<?php echo e(asset('images/logout.png')); ?>" alt="Logout"
                                    style="width: 20px; height: 20px;">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ===== RULES CONTENT ===== -->
            <div style="padding:25px; width:100%; max-width:1200px; margin:auto;">

                <!-- ADD / EDIT RULE FORM -->
                <div
                    style="background:white; border-radius:16px; padding:25px; margin-bottom:30px; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
                    <h4 id="form-title" style="color:#004AAD; margin-bottom:15px;"> Add New Rule</h4>
                    <form id="ruleForm" method="POST" action="<?php echo e(route('admin.rules.store')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="rule_id" id="rule_id">
                        <div style="display:flex; flex-direction:column; gap:15px;">
                            <input type="text" name="title" id="title" placeholder="Rule Title" required
                                style="padding:10px; border-radius:8px; border:1px solid #ccc;">

                            <!-- REMOVED required attribute from textarea -->
                            <textarea id="editor" name="description" placeholder="Rule Description" rows="5"
                                style="padding:10px; border-radius:8px; border:1px solid #ccc;"></textarea>

                            <div>
                                <label style="color:#004AAD;">Upload Image (optional):</label><br>
                                <input type="file" name="image" accept="image/*" id="imageInput" style="padding:5px;">
                                <img id="previewImage"
                                    style="display:none; margin-top:10px; width:100px; border-radius:8px; border:1px solid #ddd;">
                            </div>

                            <div style="display:flex; gap:10px;">
                                <button type="submit" id="submitBtn"
                                    style="background:#004AAD; color:white; padding:10px 20px; border-radius:8px; border:none; cursor:pointer;">Add
                                    Rule</button>
                                <button type="button" id="cancelEdit"
                                    style="display:none; background:gray; color:white; padding:10px 20px; border-radius:8px; border:none; cursor:pointer;">Cancel
                                    Edit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- EXISTING RULES -->
                <div id="rulesList"
                    style="background:white; border-radius:16px; padding:25px; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
                    <h4 style="color:#004AAD; margin-bottom:20px;">📋 Existing Rules</h4>
                    <div id="rulesContainer">
                        <?php $__empty_1 = true; $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="rule-card" id="rule-<?php echo e($rule->id); ?>"
                                style="border:1px solid #ddd; border-radius:12px; margin-bottom:15px; overflow:hidden; background:#fdfdfd;">
                                <div onclick="toggleAccordion(<?php echo e($rule->id); ?>)"
                                    style="background:#e8f0ff; color:#004AAD; cursor:pointer; padding:15px; font-weight:600; display:flex; justify-content:space-between; align-items:center;">
                                    <span><?php echo e($rule->title); ?></span>
                                    <span id="icon-<?php echo e($rule->id); ?>">➕</span>
                                </div>

                                <div id="content-<?php echo e($rule->id); ?>"
                                    style="display:none; padding:15px; background:white;">
                                    <?php if($rule->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $rule->image)); ?>" alt="Rule Image"
                                            style="width:120px; border-radius:8px; margin-bottom:10px;">
                                    <?php endif; ?>
                                    <div style="color:#333; margin-bottom:10px; white-space: pre-wrap;">
                                        <?php echo $rule->description; ?>

                                    </div>

                                    <div style="display:flex; gap:10px;">
                                        <button type="button" class="editBtn" data-id="<?php echo e($rule->id); ?>"
                                            data-title="<?php echo e($rule->title); ?>" data-description="<?php echo e($rule->description); ?>"
                                            data-image="<?php echo e($rule->image ? asset('storage/' . $rule->image) : ''); ?>"
                                            style="background:#FFA500; color:white; padding:6px 12px; border-radius:6px; border:none; cursor:pointer;">Edit</button>

                                        <button type="button" class="deleteBtn" data-id="<?php echo e($rule->id); ?>"
                                            style="background:red; color:white; padding:6px 12px; border-radius:6px; border:none; cursor:pointer;">Delete</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p style="text-align:center; color:#666;">No rules found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SCRIPT ===== -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        let editorInstance;

        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar + Profile
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const menuToggle = document.getElementById('menu-toggle');
            const profileToggle = document.getElementById('profile-toggle');
            const profileDropdown = document.getElementById('profile-dropdown');

            menuToggle.addEventListener('click', () => {
                sidebar.style.left = (sidebar.style.left === '0px') ? '-250px' : '0';
                mainContent.style.marginLeft = (sidebar.style.left === '0px') ? '250px' : '0';
            });

            profileToggle.addEventListener('click', () => {
                profileDropdown.style.display = (profileDropdown.style.display === 'block') ? 'none' :
                    'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });

            // Accordion
            window.toggleAccordion = function(id) {
                const content = document.getElementById('content-' + id);
                const icon = document.getElementById('icon-' + id);
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                    icon.textContent = '➕';
                } else {
                    content.style.display = 'block';
                    icon.textContent = '➖';
                }
            };

            // CKEditor setup
            ClassicEditor.create(document.querySelector('#editor'), {
                toolbar: ['bold', 'italic', 'underline', 'bulletedList', 'numberedList', 'link']
            }).then(editor => {
                editorInstance = editor;

                // Add custom validation for CKEditor content
                editor.model.document.on('change:data', () => {
                    const description = editor.getData().trim();
                    // Remove any browser validation messages
                    document.getElementById('editor').setCustomValidity('');
                });
            }).catch(error => console.error(error));

            // Image preview
            const imageInput = document.getElementById('imageInput');
            const previewImage = document.getElementById('previewImage');
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    previewImage.src = URL.createObjectURL(file);
                    previewImage.style.display = 'block';
                }
            });

            // AJAX form submission - FIXED VERSION
            document.getElementById('ruleForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                // Manual validation
                const title = document.getElementById('title').value.trim();
                const description = editorInstance.getData().trim();

                if (!title) {
                    alert('❌ Please enter a rule title.');
                    document.getElementById('title').focus();
                    return;
                }

                if (!description) {
                    alert('❌ Please enter a rule description.');
                    editorInstance.editing.view.focus();
                    return;
                }

                const form = e.target;
                const formData = new FormData(form);
                formData.set('description', description);

                const submitBtn = document.getElementById('submitBtn');
                const originalBtnText = submitBtn.textContent;
                submitBtn.textContent = 'Saving...';
                submitBtn.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Accept': 'application/json',
                        }
                    });

                    const result = await response.json();

                    console.log('Server response:', result); // Debug log

                    if (response.ok && result.success) {
                        alert('✅ ' + result.message);

                        if (document.getElementById('rule_id').value) {
                            updateRuleCard(result.rule);
                        } else {
                            addNewRuleCard(result.rule);
                        }

                        resetForm();
                    } else {
                        alert('❌ Failed to save rule: ' + (result.message || 'Check your inputs.'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('❌ Network error. Please try again.');
                } finally {
                    submitBtn.textContent = originalBtnText;
                    submitBtn.disabled = false;
                }
            });

            // Function to add new rule card to the list
            function addNewRuleCard(rule) {
                const rulesContainer = document.getElementById('rulesContainer');
                const noRulesMessage = rulesContainer.querySelector('p');

                // Remove "No rules found" message if it exists
                if (noRulesMessage && noRulesMessage.textContent.includes('No rules found')) {
                    noRulesMessage.remove();
                }

                // Create new rule card HTML
                const ruleCard = createRuleCardHTML(rule);

                // Prepend the new rule (add to top)
                rulesContainer.insertAdjacentHTML('afterbegin', ruleCard);

                // Re-attach event listeners to the new buttons
                attachEventListeners();
            }

            // Function to update existing rule card
            function updateRuleCard(rule) {
                const existingRuleCard = document.getElementById('rule-' + rule.id);
                if (existingRuleCard) {
                    const newRuleCardHTML = createRuleCardHTML(rule);
                    existingRuleCard.outerHTML = newRuleCardHTML;
                    attachEventListeners();
                }
            }

            // Function to create rule card HTML
            function createRuleCardHTML(rule) {
                const imageHtml = rule.image ?
                    `<img src="<?php echo e(asset('storage/')); ?>/${rule.image}" alt="Rule Image" style="width:120px; border-radius:8px; margin-bottom:10px;">` :
                    '';

                return `
        <div class="rule-card" id="rule-${rule.id}" style="border:1px solid #ddd; border-radius:12px; margin-bottom:15px; overflow:hidden; background:#fdfdfd;">
            <div onclick="toggleAccordion(${rule.id})" 
                 style="background:#e8f0ff; color:#004AAD; cursor:pointer; padding:15px; font-weight:600; display:flex; justify-content:space-between; align-items:center;">
                <span>${rule.title}</span>
                <span id="icon-${rule.id}">➕</span>
            </div>

            <div id="content-${rule.id}" style="display:none; padding:15px; background:white;">
                ${imageHtml}
                <div style="color:#333; margin-bottom:10px; white-space: pre-wrap;">
                    ${rule.description}
                </div>

                <div style="display:flex; gap:10px;">
                    <button type="button" class="editBtn" 
                        data-id="${rule.id}" 
                        data-title="${rule.title}" 
                        data-description="${rule.description.replace(/"/g, '&quot;')}" 
                        data-image="${rule.image ? '<?php echo e(asset('storage/')); ?>/' + rule.image : ''}"
                        style="background:#FFA500; color:white; padding:6px 12px; border-radius:6px; border:none; cursor:pointer;">Edit</button>
                    
                    <button type="button" class="deleteBtn" data-id="${rule.id}" 
                        style="background:red; color:white; padding:6px 12px; border-radius:6px; border:none; cursor:pointer;">Delete</button>
                </div>
            </div>
        </div>
        `;
            }

            // Function to attach event listeners
            function attachEventListeners() {
                // Edit button listeners
                document.querySelectorAll('.editBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const title = this.dataset.title;
                        const desc = this.dataset.description;
                        const image = this.dataset.image;

                        document.getElementById('rule_id').value = id;
                        document.getElementById('title').value = title;
                        editorInstance.setData(desc);
                        document.getElementById('form-title').innerText = '✏️ Edit Rule';
                        document.getElementById('submitBtn').innerText = 'Update Rule';
                        document.getElementById('ruleForm').action =
                            '<?php echo e(route('admin.rules.update', '')); ?>/' + id;

                        if (image) {
                            previewImage.src = image;
                            previewImage.style.display = 'block';
                        } else {
                            previewImage.style.display = 'none';
                        }

                        document.getElementById('cancelEdit').style.display = 'inline-block';
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                });

                // Delete button listeners
                document.querySelectorAll('.deleteBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const ruleId = this.dataset.id;
                        deleteRule(ruleId);
                    });
                });
            }

            // Function to delete rule via AJAX
            async function deleteRule(ruleId) {
                if (!confirm('Are you sure you want to delete this rule?')) {
                    return;
                }

                try {
                    const response = await fetch('<?php echo e(route('admin.rules.delete', '')); ?>/' + ruleId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        }
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        document.getElementById('rule-' + ruleId).remove();
                        alert('✅ ' + result.message);

                        // Show "No rules found" message if all rules are deleted
                        const rulesContainer = document.getElementById('rulesContainer');
                        if (rulesContainer.children.length === 0) {
                            rulesContainer.innerHTML =
                                '<p style="text-align:center; color:#666;">No rules found.</p>';
                        }
                    } else {
                        alert('Failed to delete rule: ' + (result.message || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert(' Network error. Please try again.');
                }
            }

            // Function to reset form
            function resetForm() {
                document.getElementById('ruleForm').reset();
                editorInstance.setData('');
                document.getElementById('ruleForm').action = '<?php echo e(route('admin.rules.store')); ?>';
                document.getElementById('form-title').innerText = '➕ Add New Rule';
                document.getElementById('submitBtn').innerText = 'Add Rule';
                document.getElementById('cancelEdit').style.display = 'none';
                previewImage.style.display = 'none';
                document.getElementById('rule_id').value = '';
            }

            // Initial attachment of event listeners
            attachEventListeners();

            // Cancel Edit
            document.getElementById('cancelEdit').addEventListener('click', function() {
                resetForm();
            });

            // Fullscreen image modal for admin
            const adminModal = document.createElement('div');
            adminModal.id = 'adminImageModal';
            adminModal.style.cssText =
                'display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:2000;';
            const adminModalImg = document.createElement('img');
            adminModalImg.style.cssText = 'max-width:90%; max-height:90%; border-radius:8px;';
            adminModal.appendChild(adminModalImg);
            document.body.appendChild(adminModal);

            adminModal.addEventListener('click', () => {
                adminModal.style.display = 'none';
            });

            // Function to attach click events to all images
            function attachAdminImageClicks() {
                // Preview image in form
                if (previewImage) {
                    previewImage.style.cursor = 'pointer';
                    previewImage.onclick = () => {
                        adminModalImg.src = previewImage.src;
                        adminModal.style.display = 'flex';
                    };
                }

                // Existing rule images
                document.querySelectorAll('#rulesContainer img').forEach(img => {
                    img.style.cursor = 'pointer';
                    img.onclick = () => {
                        adminModalImg.src = img.src;
                        adminModal.style.display = 'flex';
                    };
                });
            }

            // Call it initially
            attachAdminImageClicks();

            // Re-call after adding/updating rules dynamically
            function updateRuleCard(rule) {
                const existingRuleCard = document.getElementById('rule-' + rule.id);
                if (existingRuleCard) {
                    const newRuleCardHTML = createRuleCardHTML(rule);
                    existingRuleCard.outerHTML = newRuleCardHTML;
                    attachEventListeners();
                    attachAdminImageClicks(); // <- important!
                }
            }

            function addNewRuleCard(rule) {
                const rulesContainer = document.getElementById('rulesContainer');
                const noRulesMessage = rulesContainer.querySelector('p');
                if (noRulesMessage && noRulesMessage.textContent.includes('No rules found')) {
                    noRulesMessage.remove();
                }
                const ruleCard = createRuleCardHTML(rule);
                rulesContainer.insertAdjacentHTML('afterbegin', ruleCard);
                attachEventListeners();
                attachAdminImageClicks(); // <- important!
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/rules.blade.php ENDPATH**/ ?>