document.querySelectorAll('.btn-minus').forEach(button => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('.cantidad-input');
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        });
    });

    document.querySelectorAll('.btn-plus').forEach(button => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('.cantidad-input');
            let currentValue = parseInt(input.value);
            input.value = currentValue + 1;
        });
    });