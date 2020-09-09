var animationNavBtn = bodymovin.loadAnimation({
    container: document.getElementById('navBtn'),
    renderer: 'svg',
    loop: 0,
    autoplay: false,
    path: 'navBtn/data.json'
});


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
