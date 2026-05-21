(function () {
    const tips = [
        'Пейте воду до и после тренировки.',
        'Сон 7–8 часов ускоряет восстановление мышц.',
        'Чередуйте силовые и кардио для баланса нагрузки.',
        'Разминка 5–10 минут снижает риск травм.',
        'Белок 1.6–2 г на кг веса поддерживает рост мышц.',
    ];

    const promoBtn = document.getElementById('promo-btn');
    const promoText = document.getElementById('promo-text');
    const promoCard = document.getElementById('promo-card');

    if (promoBtn && promoText) {
        promoBtn.addEventListener('click', function () {
            const index = Math.floor(Math.random() * tips.length);
            promoText.textContent = tips[index];
            if (promoCard) {
                promoCard.style.borderColor = '#5b9dff';
                setTimeout(function () {
                    promoCard.style.borderColor = '';
                }, 400);
            }
        });
    }

    const navToggle = document.getElementById('nav-toggle');
    const mainNav = document.getElementById('main-nav');
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            mainNav.classList.toggle('is-open');
        });
    }

    const calcAjaxBtn = document.getElementById('calc-ajax');
    const calcForm = document.getElementById('calc-form');
    const calcResult = document.getElementById('calc-result');

    if (calcAjaxBtn && calcForm && calcResult) {
        calcAjaxBtn.addEventListener('click', function () {
            const params = new URLSearchParams(new FormData(calcForm));
            fetch('/calculator/calculate?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            })
                .then(function (r) {
                    return r.json();
                })
                .then(function (data) {
                    if (data.error) {
                        calcResult.innerHTML =
                            '<p class="alert alert-error">' + escapeHtml(data.error) + '</p>';
                        return;
                    }
                    if (!data.result) {
                        return;
                    }
                    const r = data.result;
                    calcResult.innerHTML =
                        '<h2>Результат (динамически)</h2>' +
                        '<p>ИМТ: <strong>' +
                        r.bmi +
                        '</strong> - ' +
                        escapeHtml(r.bmi_category) +
                        '</p>' +
                        '<p>Базовый обмен: ' +
                        r.bmr +
                        ' ккал/сутки</p>' +
                        '<p>Суточная норма: <strong>' +
                        r.calories +
                        ' ккал</strong></p>';
                })
                .catch(function () {
                    calcResult.innerHTML =
                        '<p class="alert alert-error">Ошибка запроса. Запустите сайт через PHP-сервер.</p>';
                });
        });
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
})();
