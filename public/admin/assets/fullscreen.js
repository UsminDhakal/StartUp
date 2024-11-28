function toggleFullscreen(elementId) {
    const element = document.getElementById(elementId);

    if (!document.fullscreenElement) {
        // If no element is fullscreen, make the target element fullscreen
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
            // Firefox
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
            // Chrome, Safari and Opera
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) {
            // IE/Edge
            element.msRequestFullscreen();
        }
    } else {
        // If an element is already fullscreen, exit fullscreen mode
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}

// Add event listener for fullscreen change
document.addEventListener("fullscreenchange", handleFullscreenChange);
document.addEventListener("webkitfullscreenchange", handleFullscreenChange);
document.addEventListener("mozfullscreenchange", handleFullscreenChange);
document.addEventListener("MSFullscreenChange", handleFullscreenChange);

function handleFullscreenChange() {
    const fullscreenDiv = document.getElementById("fullscreenDiv");
    if (
        document.fullscreenElement ||
        document.webkitFullscreenElement ||
        document.mozFullScreenElement ||
        document.msFullscreenElement
    ) {
        $("#fullscreenDiv").addClass("bg-secondary m-2 d-flex align-items-center justify-content-center container");
        $("#fullscreenDiv").css({
            "height": "100vh"
        });
    } else {
        $("#fullscreenDiv").removeClass("bg-secondary m-2 d-flex align-items-center justify-content-center container");
        $("#fullscreenDiv").css({
            "height": "auto"
        });
    }
}
