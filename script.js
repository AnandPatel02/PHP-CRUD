    function validateForm() {
        var checkboxes = document.getElementsByName("hobbies[]");
        var isChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        var countrySelect = document.getElementById("countrySelect");
        var selectedCountry = countrySelect.options[countrySelect.selectedIndex].value;

        if (!isChecked && selectedCountry === "Select Country") {
            alert("Please select at least one hobby and a country other than 'Select Country'.");
            return false;
        } else if (!isChecked) {
            alert("Please select at least one hobby.");
            return false;
        } else if (selectedCountry === "Select Country") {
            alert("Please select a country other than 'Select Country'.");
            return false;
        }

        return true;
    }

