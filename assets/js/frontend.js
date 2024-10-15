window.onload = function () {
    // Show the popup after 10 seconds
    setTimeout(function () {
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('videoPopup').style.display = 'block';
    }, 1);

    // Close the popup
    document.getElementById('closePopup').onclick = function () {
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('videoPopup').style.display = 'none';
        // Pause the video
        document.getElementById('popupVideo').src = document.getElementById('popupVideo').src;
    };
};

