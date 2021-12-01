
    // Original JavaScript code by Chirp Internet: www.chirp.com.au
    // Please acknowledge use of this code by including this header.

    window.addEventListener("DOMContentLoaded", function(e) {

        var stage = document.getElementById("stage");
        var fadeComplete = function(e) { stage.appendChild(arr[0]); };
        var arr = stage.getElementsByTagName("a");
        for(var i=0; i < arr.length; i++) {
            arr[i].addEventListener("animationend", fadeComplete, false);
        }

    }, false);


    window.addEventListener("DOMContentLoaded", function(e) {

        var maxW = 0;
        var maxH = 0;

        var stage = document.getElementById("stage");
        var fadeComplete = function(e) { stage.appendChild(arr[0]); };
        var arr = stage.getElementsByTagName("img");
        for(var i=0; i < arr.length; i++) {
            if(arr[i].width > maxW) maxW = arr[i].width;
            if(arr[i].height > maxH) maxH = arr[i].height;
        }
        for(var i=0; i < arr.length; i++) {
            if(arr[i].width < maxW) {
                arr[i].style.paddingLeft = 10 + (maxW - arr[i].width)/2 + "px";
                arr[i].style.paddingRight = 10 + (maxW - arr[i].width)/2 + "px";
            }
            if(arr[i].height < maxH) {
                arr[i].style.paddingTop = 10 + (maxH - arr[i].height)/2 + "px";
                arr[i].style.paddingBottom = 10 + (maxH - arr[i].height)/2 + "px";
            }
            arr[i].addEventListener("animationend", fadeComplete, false);
        }

    }, false);

