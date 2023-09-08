var bannerStatus = 1;
var bannerTimer = 3000; //3 sekundy
var bannerStart = setInterval(function() {
    bannerChangeLoop();
}, bannerTimer);


window.onload = function () {
    bannerChangeLoop();
}
// Funckja jest wywoływana automatycznie co 3 sekundy (wartość zmiennej "bannerTimer")
//
// Aby Banner'y mogły się "zapętlać", funckja ta w jednym z trzech stanów/układów grafik musi w przeciągu jednej rotacji przesunąć baner z lewej na prawą stronę, 
// robiąc go niewidzialnym (opacity: 0) i dając warstwę (zIndex) niższą niż pozostałe dwa. Skrypt porusza wszystkie bannery w lewo z wyjątkiem tego, 
// który już jest poza kontenerem (overflow: hidden), wtedy on jest przesuwany na przeciwną stronę, będąc następnym w kolejce do prezentacji
//
// Klasa .all-transitions w pliku main.css wymusza płynny ruch zamiast natychmiastowej zmiany położenia, powodując przyjmną dla oczu zmianę grafiki
// Każda przerwa czasowa (setTimeout, setInterval) jest wyrażana w [ms] (0.001 sekundy)
// Podobny skrypt jest w pliku new_products.js
function bannerChangeLoop() {
    var banner1 = document.getElementById("banner1");
    var banner2 = document.getElementById("banner2");
    var banner3 = document.getElementById("banner3");
    if (bannerStatus == 1) {
        banner2.style.opacity = "0";
        setTimeout(function() {
            banner1.style.right = "0px";
            banner2.style.right = "-1266px";
            banner3.style.right = "1266px";
            banner1.style.zIndex = "1000";
            banner2.style.zIndex = "1001";
            banner3.style.zIndex = "999";
        }, 500);
        setTimeout(function() {
            banner2.style.opacity = "1";
        }, 1000);
        bannerStatus = 2;
    } else if (bannerStatus == 2) {
        banner3.style.opacity = "0";
        setTimeout(function() {
            banner2.style.right = "0px";
            banner3.style.right = "-1266px";
            banner1.style.right = "1266px";
            banner2.style.zIndex = "1000";
            banner3.style.zIndex = "1001";
            banner1.style.zIndex = "999";
        }, 500);
        setTimeout(function() {
            banner3.style.opacity = "1";
        }, 1000);
        bannerStatus = 3;
    } else if (bannerStatus == 3) {
        banner1.style.opacity = "0";
        setTimeout(function() {
            banner3.style.right = "0px";
            banner1.style.right = "-1266px";
            banner2.style.right = "1266px";
            banner3.style.zIndex = "1000";
            banner1.style.zIndex = "1001";
            banner2.style.zIndex = "999";
        }, 500);
        setTimeout(function() {
            banner1.style.opacity = "1";
        }, 1000);
        bannerStatus = 1;
    }
}

//Strona search.php odbiera dane w formie GET, co umożliwia przekazać danę każdym sposobem, którym można edytować/przekirowywać na inne strony
//W przypadku formy POST, taki zabieg nie jest możliwy
function promotion(choice) {
    switch (choice) {
        case 1:
            window.open("podstrony/search.php?search=razer", "_self")
            break;
        case 2:
            window.open("podstrony/produkt.php?productName=Logitech+G413+Carbon", "_self")
            break;
        case 3:
            window.open("podstrony/produkt.php?productName=Logitech+G29", "_self")
            break;
    }
}