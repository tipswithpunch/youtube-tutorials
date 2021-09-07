// CODE FOR BACKEND GA
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

// create GA cookie value
function createGaCookieValue(){
   
    var O = window;
    var M = [];
    M.cookie = "cookieName=someValue";

    var hd = function() {
        return Math.round(2147483647 * Math.random())
    }

    function La(a) {
        var b = 1, c;
        if (a)
            for (b = 0,
            c = a.length - 1; 0 <= c; c--) {
                var d = a.charCodeAt(c);
                b = (b << 6 & 268435455) + d + (d << 14);
                d = b & 266338304;
                b = 0 != d ? b ^ d >> 21 : b
            }
        return b
    }

    var ra = function() {
        for (var a = O.navigator.userAgent + (M.cookie ? M.cookie : "") + (M.referrer ? M.referrer : ""), b = a.length, c = O.history.length; 0 < c; )
            a += c-- ^ b++;
        return [hd() ^ La(a) & 2147483647, Math.round((new Date).getTime() / 1E3)].join(".")
    }


    return ra();
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

// code to track if GA / GTM 
setTimeout(function(){      

    var eventCategory = 'Blocking';
    var eventAction = 'GA';
    var eventLabel = 'None';


    var fileDomain = '/wp-content/plugins/ga-blocker-detector/collect.php?';

    if(window.ga && ga.create) 
    {
        console.log('Google Analytics is loaded');
    } 
    else 
    {
        console.log('Google Analytics is not loaded');
        
        // check if cookie exists
        if(getCookie('gaNot') === null){

            var createGaId = createGaCookieValue();
            var userId = getRandomArbitrary(10000000, 999999999);
            var screenResolution = window.screen.availWidth +'x'+ window.screen.availHeight; //sr=
            var viewPort = window.innerWidth +'x'+ window.innerHeight ; //vp=
        
            var img = document.createElement('img');
            img.setAttribute('style','display:none;');
            img.src = fileDomain + 'v=1&_v=j83&aip=1&t=event&uid='+ userId +'&cid='+ createGaId +'&ec='+ eventCategory +'&ea='+ eventAction +'&el='+ eventLabel + '&sr=' + screenResolution + '&vp=' + viewPort;
            document.body.appendChild(img);  
            setCookie('gaNot',userId,30);
        }
    }
}, 1000);