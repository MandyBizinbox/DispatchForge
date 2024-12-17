// Tab Functionality
function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tabs button');
    tabs.forEach(tab => tab.classList.remove('active'));
    buttons.forEach(btn => btn.classList.remove('active'));

    document.getElementById(tabId).classList.add('active');
    document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
}

// Real-Time Validation
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    form.addEventListener('input', (e) => {
        const input = e.target;
        const errorSpan = document.getElementById(`error-${input.name}`);

        if (input.validity.valueMissing) {
            errorSpan.textContent = "This field is required.";
        } else if (input.validity.typeMismatch || input.validity.badInput) {
            errorSpan.textContent = "Please enter a valid value.";
        } else {
            errorSpan.textContent = "";
        }
    });

    // Loading Spinner on Submit
    form.addEventListener('submit', (e) => {
        const spinner = document.getElementById('loading-spinner');
        spinner.classList.remove('hidden');
    });
});
