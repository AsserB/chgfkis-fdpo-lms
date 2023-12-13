document.addEventListener('DOMContentLoaded', function () {
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
};

function checkCookies() {
    let cookieDate = localStorage.getItem('cookieDate');
    let cookieNotification = document.getElementById('cookie_notification');
    let cookieBtn = cookieNotification.querySelector('.cookie_accept');

    // Если записи про кукисы нет или она просрочена на 1 год, то показываем информацию про кукисы
    if (!cookieDate || (+cookieDate + 31536000000) < Date.now()) {
        cookieNotification.classList.add('show');
    }

    // При клике на кнопку, в локальное хранилище записывается текущая дата в системе UNIX
    cookieBtn.addEventListener('click', function () {
        localStorage.setItem('cookieDate', Date.now());
        cookieNotification.classList.remove('show');
    })
}
checkCookies();