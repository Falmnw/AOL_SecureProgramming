class ElegantPortfolioRegisterForm {
    constructor() {
        this.form = document.getElementById('registerForm');
        this.nimInput = document.getElementById('nim');
        this.namaInput = document.getElementById('nama');
        this.daerahInput = document.getElementById('daerah');
        this.organisasiInput = document.getElementById('organisasi');
        this.emailInput = document.getElementById('email');
        this.passwordInput = document.getElementById('password');
        this.passwordToggle = document.getElementById('passwordToggle');
        this.submitButton = this.form.querySelector('.signin-button');
        this.successMessage = document.getElementById('successMessage');
        this.socialButtons = document.querySelectorAll('.social-button');

        this.init();
    }

    init() {
        this.bindEvents();
        this.setupPasswordToggle();
        this.setupSocialButtons();
    }

    bindEvents() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        [this.nimInput, this.namaInput, this.daerahInput, this.organisasiInput, this.emailInput, this.passwordInput].forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.clearError(input.id));
            input.setAttribute('placeholder', ' '); // untuk animasi label
        });
    }

    setupPasswordToggle() {
        this.passwordToggle.addEventListener('click', () => {
            const type = this.passwordInput.type === 'password' ? 'text' : 'password';
            this.passwordInput.type = type;
            this.passwordToggle.classList.toggle('reveal-active', type === 'text');
        });
    }

    setupSocialButtons() {
        this.socialButtons.forEach(button => {
            button.addEventListener('click', async (e) => {
                const provider = button.textContent.trim();
                await this.handleSocialLogin(provider, button);
            });
        });
    }

    validateField(input) {
        const value = input.value.trim();
        let errorMessage = '';

        if (!value) {
            errorMessage = `${input.name} is required`;
        } else {
            if (input.id === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    errorMessage = 'Please enter a valid email address';
                }
            }
            if (input.id === 'password' && value.length < 6) {
                errorMessage = 'Password must be at least 6 characters long';
            }
        }

        if (errorMessage) {
            this.showError(input.id, errorMessage);
            return false;
        }

        this.clearError(input.id);
        return true;
    }

    showError(fieldId, message) {
        const formField = document.getElementById(fieldId).closest('.form-field');
        const errorElement = document.getElementById(`${fieldId}Error`);

        formField.classList.add('error');
        errorElement.textContent = message;
        errorElement.classList.add('show');
    }

    clearError(fieldId) {
        const formField = document.getElementById(fieldId).closest('.form-field');
        const errorElement = document.getElementById(`${fieldId}Error`);

        formField.classList.remove('error');
        errorElement.classList.remove('show');
        setTimeout(() => {
            errorElement.textContent = '';
        }, 200);
    }

    async handleSubmit(e) {
        e.preventDefault();

        const inputs = [this.nimInput, this.namaInput, this.daerahInput, this.organisasiInput, this.emailInput, this.passwordInput];
        let allValid = true;

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                allValid = false;
            }
        });

        if (!allValid) return;

        this.setLoading(true);

        try {
            // Simulasi register
            await new Promise(resolve => setTimeout(resolve, 2200));
            this.showSuccess();
        } catch (error) {
            this.showError('password', 'Registration failed. Please try again.');
        } finally {
            this.setLoading(false);
        }
    }

    async handleSocialLogin(provider, button) {
        console.log(`Signing up with ${provider}...`);

        const originalHTML = button.innerHTML;
        button.style.pointerEvents = 'none';
        button.style.opacity = '0.7';
        button.innerHTML = `<div style="width:16px;height:16px;border:2px solid #cbd5e0;border-top:2px solid #4a5568;border-radius:50%;animation:spin 1s linear infinite;"></div> Connecting...`;

        try {
            await new Promise(resolve => setTimeout(resolve, 1800));
            console.log(`Redirecting to ${provider} registration...`);
        } finally {
            button.style.pointerEvents = 'auto';
            button.style.opacity = '1';
            button.innerHTML = originalHTML;
        }
    }

    setLoading(loading) {
        this.submitButton.classList.toggle('loading', loading);
        this.submitButton.disabled = loading;
        this.socialButtons.forEach(button => {
            button.style.pointerEvents = loading ? 'none' : 'auto';
            button.style.opacity = loading ? '0.6' : '1';
        });
    }

    showSuccess() {
        this.form.style.transform = 'scale(0.95)';
        this.form.style.opacity = '0';

        setTimeout(() => {
            this.form.style.display = 'none';
            document.querySelector('.social-auth').style.display = 'none';
            document.querySelector('.signup-prompt').style.display = 'none';
            document.querySelector('.auth-divider').style.display = 'none';

            this.successMessage.classList.add('show');
        }, 300);

        setTimeout(() => {
            console.log('Redirecting to dashboard...');
            // window.location.href = '/dashboard';
        }, 3000);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ElegantPortfolioRegisterForm();
});
