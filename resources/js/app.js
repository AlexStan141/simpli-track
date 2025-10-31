import './bootstrap';

//a disparut eroarea dupa ce am eliminat astea

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector("#phone");
    if (input) {
        const iti = window.intlTelInput(input, {
            initialCountry: "ro",
            preferredCountries: ["ro", "us", "gb"],
            nationalMode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
        const fullPhoneNumber = iti.getNumber();
    }
});

