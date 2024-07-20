document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const emailInput = document.getElementById('email');
    
    // Load data from local storage
    emailInput.value = localStorage.getItem('email') || '';
    passwordInput.value = localStorage.getItem('password') || '';
    confirmPasswordInput.value = localStorage.getItem('confirm_password') || '';

    form.addEventListener('submit', (event) => {
        // Clear previous errors
        document.querySelectorAll('.text-red-500').forEach(el => el.textContent = '');

        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        let valid = true;

        // Strong password validation
        const passwordError = [];
        if (password.length < 8) {
            passwordError.push('Password must be at least 8 characters long.');
        }
        if (!/[A-Z]/.test(password)) {
            passwordError.push('Password must contain at least one uppercase letter.');
        }
        if (!/[a-z]/.test(password)) {
            passwordError.push('Password must contain at least one lowercase letter.');
        }
        if (!/[0-9]/.test(password)) {
            passwordError.push('Password must contain at least one number.');
        }
        if (!/[!@#$%^&*]/.test(password)) {
            passwordError.push('Password must contain at least one special character (!@#$%^&*).');
        }
        if (password !== confirmPassword) {
            passwordError.push('Passwords do not match.');
        }

        if (passwordError.length > 0) {
            valid = false;
            document.querySelector('#password ~ .text-red-500').textContent = passwordError.join(' ');
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission
        } else {
            // Save data to local storage
            localStorage.setItem('email', emailInput.value);
            localStorage.setItem('password', passwordInput.value);
            localStorage.setItem('confirm_password', confirmPasswordInput.value);
        }
    });
});