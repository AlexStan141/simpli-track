import './bootstrap';

//a disparut eroarea dupa ce am eliminat astea

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector("#phone");
    let selectedFlag = localStorage.getItem("flag") ? localStorage.getItem("flag") : 'ro';

    const iti = window.intlTelInput(input, {
        initialCountry: selectedFlag ? selectedFlag : "ro",
        preferredCountries: ["ro", "us", "gb"],
        separateDialCode: false,
        nationalMode: true
    });

    input.form.addEventListener("submit", function () {
        const countryData = iti.getSelectedCountryData();
        localStorage.setItem("flag", countryData.iso2);
        input.value = input.value;
    });
});

