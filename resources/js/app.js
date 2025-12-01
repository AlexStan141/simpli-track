import './bootstrap';

//a disparut eroarea dupa ce am eliminat astea

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector("#phone");

    const iti = window.intlTelInput(input, {
        initialCountry: localStorage.getItem('flag') ? localStorage.getItem('flag') : "ro",
        preferredCountries: ["ro", "us", "gb"],
        separateDialCode: false,
        nationalMode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    input.form.addEventListener("submit", function () {
        const countryData = iti.getSelectedCountryData();
        localStorage.setItem("flag", countryData.iso2);
        input.value = iti.getNumber();
    });
});


