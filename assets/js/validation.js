document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('#loginForm');
    if (loginForm) {
        const emailInput = loginForm.querySelector('input[name="email"]');
        const passwordInput = loginForm.querySelector('input[name="password"]');

        function showError(input, message) {
            const errorSpan = input.nextElementSibling;
            errorSpan.textContent = message;
            input.classList.add('error');
        }

        function clearError(input) {
            const errorSpan = input.nextElementSibling;
            errorSpan.textContent = '';
            input.classList.remove('error');
        }

        emailInput.addEventListener('input', function() {
            clearError(emailInput);
        });

        passwordInput.addEventListener('input', function() {
            clearError(passwordInput);
        });

        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                e.preventDefault();
                showError(emailInput, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Password validation
            if (passwordInput.value.length < 6) {
                e.preventDefault();
                showError(passwordInput, 'Password must be at least 6 characters long');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
}); 