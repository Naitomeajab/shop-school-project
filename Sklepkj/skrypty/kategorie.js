//Strona search.php odbiera dane w formie GET, co umożliwia przekazać danę każdym sposobem, którym można edytować/przekirowywać na inne strony
//W przypadku formy POST, taki zabieg nie jest możliwy
function category(choice) {
    switch (choice) {
        case 0:
            window.open("podstrony/search.php?search=monitor", "_self")
            break;
        case 1:
            window.open("podstrony/search.php?search=myszka", "_self")
            break;
        case 2:
            window.open("podstrony/search.php?search=klawiatura", "_self")
            break;
        case 3:
            window.open("podstrony/search.php?search=głosniki", "_self")
            break;
        case 4:
            window.open("podstrony/search.php?search=kamera+internetowa", "_self")
            break;
        case 5:
            window.open("podstrony/search.php?search=mikrofon", "_self")
            break;
        case 6:
            window.open("podstrony/search.php?search=słuchawki", "_self")
            break;
        case 7:
            window.open("podstrony/search.php?search=pendrive", "_self")
            break;
        case 8:
            window.open("podstrony/search.php?search=dysk+zewnetrzny", "_self")
            break;
        case 9:
            window.open("podstrony/search.php?search=kierownica+do+gier", "_self")
            break;
    }
}