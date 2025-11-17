import './bootstrap';

//a disparut eroarea dupa ce am eliminat astea

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector("#phone");
    const hiddenInput = document.querySelector("#phone_normalized");
    let selectedFlag = localStorage.getItem("flag") ? localStorage.getItem("flag") : 'ro';

    const iti = window.intlTelInput(input, {
        initialCountry: selectedFlag ? selectedFlag : "ro",
        preferredCountries: ["ro", "us", "gb"],
        separateDialCode: false,
        nationalMode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // La submit, salvează numărul în format internațional
    input.form.addEventListener("submit", function () {
        let flagContainer = document.getElementsByClassName('iti__flag')[0];
        let fullClass = flagContainer.className;
        let flagPart = fullClass.split(" ")[1];
        selectedFlag = flagPart.slice(5);
        localStorage.setItem("flag", selectedFlag);
        if (iti.isValidNumber()) {
            hiddenInput.value = iti.getNumber(); // ex: +40729626513
        }
    });
});

