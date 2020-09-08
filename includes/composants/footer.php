<footer>
    <!--    todo liens pour le footer -->
    <a href="">
        Mon profil
    </a>
    <a href="">
        Règlements
    </a>
    <a href="">
        Nous contacter
    </a>
</footer>
<!-- Script Lottie & bodymovin ae -->
<script src="/ressources/js/lottie.js"></script>
<script src="/ressources/js/navBtn.js"></script>
<script>
    var navBarBtn = 0;

    function clickNavBtn() {
        animationNavBtn.play();
        if (navBarBtn === 0) {
            document.getElementById("navHidden").style.zIndex = '2';
            document.getElementById("navHidden").style.opacity = '100%';
        } else {
            document.getElementById("navHidden").style.opacity = '0%';
        }
        setTimeout(swapingAnimation, 350)
    }

    function swapingAnimation() {
        if (navBarBtn === 0) {
            animationNavBtn.pause();
            animationNavBtn.setDirection(-1);
            navBarBtn = 1;
        } else {
            animationNavBtn.pause();
            document.getElementById("navHidden").style.zIndex = '-1';
            animationNavBtn.setDirection(1);
            navBarBtn = 0;
        }
    }
</script>

</body>
</html>
