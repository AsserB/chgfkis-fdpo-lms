document.addEventListener('DOMContentLoaded', function() {
    let snilsInput = document.getElementById('snils');
    snilsInput.addEventListener('input', formatSnils);
 });
 
 function formatSnils() {
    var snilsFormat = /^\d{3}-\d{3}-\d{3} \d{2}$/;
    var snils = this.value;
    
    if (snilsFormat.test(snils)) {
        // СНИЛС введен в правильном формате
    } else {
        // СНИЛС введен в неправильном формате
        snils = snils.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1-$2-$3 $4");
        this.value = snils;
    }
 }