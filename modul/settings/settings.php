<div class="settings-container">
    <div class="page-header">
        <h2><i class="bi bi-gear me-2"></i> Settings</h2>
        <p>Kelola pengaturan aplikasi dan preferensi Anda</p>
    </div>

    <div class="row">
        <!-- General Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-sliders me-2"></i>General Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Application Name</label>
                        <input type="text" class="form-control" value="Aplikasi Sederhana">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Language</label>
                        <select class="form-select">
                            <option value="id">Bahasa Indonesia</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkMode">
                        <label class="form-check-label" for="darkMode">
                            Enable Dark Mode
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-bell me-2"></i>Notifications
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                        <label class="form-check-label" for="emailNotif">
                            Email Notifications
                        </label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="pushNotif">
                        <label class="form-check-label" for="pushNotif">
                            Push Notifications
                        </label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="smsNotif">
                        <label class="form-check-label" for="smsNotif">
                            SMS Notifications
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-lock me-2"></i>Security
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Session Timeout (minutes)</label>
                        <input type="number" class="form-control" value="30" min="5" max="120">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="twoFactor">
                        <label class="form-check-label" for="twoFactor">
                            Enable Two-Factor Authentication
                        </label>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-key me-1"></i>Change Password
                    </button>
                </div>
            </div>
        </div>

        <!-- System Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-cpu me-2"></i>System
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Items per page</label>
                        <select class="form-select">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="autoSave" checked>
                        <label class="form-check-label" for="autoSave">
                            Auto-save changes
                        </label>
                    </div>
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset to Default
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-end gap-2 mt-4">
        <button class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i>Cancel
        </button>
        <button class="btn btn-success">
            <i class="bi bi-check-circle me-1"></i>Save Changes
        </button>
    </div>
</div>

<style>
.settings-container {
    max-width: 1200px;
}

.page-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.page-header h2 {
    color: #495057;
    font-weight: 600;
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #dee2e6;
}

.card-title {
    color: #495057;
    font-weight: 600;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.btn {
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>