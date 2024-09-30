var selectElement = document.getElementById('select-profil');

selectElement.addEventListener('change', function() {
    var selectedValue = selectElement.value;
    var url = new URL(window.location.href);
    url.searchParams.set('profil', selectedValue);
    window.location.href = url.toString();
});
