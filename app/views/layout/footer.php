<footer>
    <a id="up" href="#preview">
      <img src="/assets/pic/logo-so/ic_baseline-double-arrow-2.svg" alt="up" title="Click to up" aria-label="Back to top">
    back to top
</a>
    <div class="soc-prev">
      <a href="#"><img class="git-prev" src="/assets/pic/logo-so/face-white.svg" alt="FaceBook" title="My FaceBook"></a>
      <a href="#"><img class="linkedin-prev" src="/assets/pic/logo-so/link-wite.svg" alt="LinkedIn" title="My LinkedIn"></a>
      <a href="#"><img class="git-prev" src="/assets/pic/logo-so/inst-white.svg" alt="Instagram" title="My Instagram"></a>
      <a href="#"><img class="mail-prev" src="/assets/pic/logo-so/mail-white.svg" alt="email" title="My email"></a>
    </div>
    <p>&copy;2024 Pasha <small>All Rights Reserved.</small></p>
</footer>
<script src="/assets/js/script.js"></script>
<script>
    // мобильная версия появляется меню и уберается при нажатие на кнопку меню
    function toggleElements() {
        const elements = document.querySelectorAll('.mob-see');
        elements.forEach(element => {
            element.classList.remove('mob-see');
            element.classList.add('mob-view');
        });
        const labelElement = document.querySelector('.menu-toggle-label');
        labelElement.classList.add('mob-see');
        labelElement.classList.remove('menu-toggle-label');
        const headerElement = document.querySelector('header');
        headerElement.style.justifyContent = 'space-between';
        // выпадаюшие меню
        const menuFlyout = document.querySelector('.menu-flyout');
        menuFlyout.classList.toggle('open');
    }
    // При нажатие на крестик, обновление страницы
    function reloadPage() {
        location.reload();
    }

    //Карусеот
    // По умолчанию скрываем второй блок
    document.querySelector('.prev-item.second').style.display = 'none';
    function toggleBlocks() {
        const firstBlock = document.querySelector('.prev-item.first');
        const secondBlock = document.querySelector('.prev-item.second');

        if (firstBlock.style.display !== 'none') {
            firstBlock.style.display = 'none';
            secondBlock.style.display = 'flex';
        } else {
            firstBlock.style.display = 'flex';
            secondBlock.style.display = 'none';
        }
    }

    setInterval(toggleBlocks, 30000); // Переключаем каждые 30 секунд (30000 миллисекунд)

</script>
</body>
</html>
