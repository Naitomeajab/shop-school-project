var newItemState = 0;
var scrollforce = 400;
//Zebranie wszystkich przedmiotów do array'u
var items = [];
for(let i = 1; i < 9; i++) {
    let temp = "newItem"+i;
    items.push(document.getElementById(temp));
}

// Skrypt aktywuje się po naciśnieciu jeden z dwóch przycisków w index.php, każdy przycisk rozpoczyna tą funckję podająć do tego swoj odpowiedni argument,
// który odpowiada za kierunek przesunięcia
//
// początkowo skrypt sprawdza czy jest możliwość/sens przesuniącią w danym kierunku. Skrypt nie uruchomi się na przykład kiedy przesunięcie spowoduje,
// że żaden produkt nie pozostanie widoczny. Skrypt pobiera aktualne położenie jednego produkty względem głownego kontenera,
// przetwarzą tą wartość na liczbę, dodaje/odejmuje do niej wartość przesunięcia (zmienna "scrollforce"), następnie aplikuje zmiany 
// kończąc na edycji aktualnego stanu kontenera (możliwość/sens przesunięcia)
//
// Klasa .all-transitions w pliku main.css wymusza płynny ruch zamiast natychmiastowej zmiany położenia, powodując przyjmną dla oczu zmianę grafiki
// Podobny skrypt jest w pliku banner.js
function scrollNewItems(direction) { //0 = z lewej do prawej, 1 = z prawej do lewej
    var scrollf = scrollforce;
    if (direction == 0 && newItemState > 0) {
        for (let i = 0; i < items.length; i++) {
            let currentPos = items[i].style.left;
            currentPos = currentPos.replace("px", "");
            currentPos = parseInt(currentPos);
            scrollf = currentPos + scrollforce;
            items[i].style.left = scrollf + "px";
        }
        newItemState--;
    } else if (direction == 1 && newItemState < 7) {
        for (let i = 0; i < items.length; i++) {
            let currentPos = items[i].style.left;
            currentPos = currentPos.replace("px", "");
            currentPos = parseInt(currentPos);
            scrollf = currentPos - scrollforce;
            items[i].style.left = scrollf + "px";
        }
        newItemState++;
    }
    if (newItemState == 0) {document.getElementById('new-button-left').style.opacity = "0.2";} else {document.getElementById('new-button-left').style.opacity = "1";}
    if (newItemState == 7) {document.getElementById('new-button-right').style.opacity = "0.2";} else {document.getElementById('new-button-right').style.opacity = "1";}
}