document.addEventListener("DOMContentLoaded", function () {
    const incrementButton = document.querySelector('[data-action="inc"]');
    const decrementButton = document.querySelector('[data-action="dec"]');
    const quantityInput = document.querySelector('.form-input--incrementTotal');

    incrementButton.addEventListener("click", function () {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    decrementButton.addEventListener("click", function () {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });
});