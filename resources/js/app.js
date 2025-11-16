import './bootstrap';

//a disparut eroarea dupa ce am eliminat astea

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector("#phone");
    const hiddenInput = document.querySelector("#phone_normalized");
    const dialCodeInput = document.querySelector("#dial_code");

    const iti = window.intlTelInput(input, {
        initialCountry: "ro",
        preferredCountries: ["ro", "us", "gb"],
        separateDialCode: false,
        nationalMode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // La submit, salvează numărul în format internațional
    input.form.addEventListener("submit", function () {
        if (iti.isValidNumber()) {
            hiddenInput.value = iti.getNumber(); // ex: +40729626513
        }
    });
});

