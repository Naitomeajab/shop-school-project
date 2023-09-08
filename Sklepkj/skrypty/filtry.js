var filtersProducent = document.getElementsByName("filterProducent");
var filtersCost = document.getElementsByName("filterCost");
var resultProducts = document.getElementsByName("resultProduct");
var listOfFilters = ["cena", "producent"];

// Funkcja uruchamia się za każdym razem kiedy filtry się zmienią, bądź też zostaną zrestartowane
//
// Funkcja przypisuje TYLKO wartości zaznaczonych filtrów, następnie uruchamia drugą funkcję
//
// Funckja "filterSelection" dostaje od poprzedniej funkcji listę filtrów, następnie dla każdego produktu sprawdza zgodność z filtrami.
// W przypadku kiedy produkt jest w wymaganym zakresie cenowym, oraz jego producent jest na liście zaznaczonych - produkt będzie widoczny dla użytkownika
// W przeciwnym przypadku staje się nie widoczny i zwalnia miejsce (display: none)
function filterCheck(reset = false) {
    if (reset) {
        for (let i = 0; i < resultProducts.length; i++) {
            resultProducts[i].style.display = "block";
        }
        return
    }
    listOfFilters[0] = [];
    listOfFilters[1] = [];
    let temp = 0;
    for (let i = 0; i < filtersCost.length; i++) {
        if(filtersCost[i].checked == true) {
            temp = parseInt(filtersCost[i].value);
            listOfFilters[0].push(temp)
        }
    }
    for (let i = 0; i < filtersProducent.length; i++) {
        if(filtersProducent[i].checked == true) {
            temp = parseInt(filtersProducent[i].value);
            listOfFilters[1].push(temp)
        }
    }
    for (let i = 0; i < listOfFilters[1].length; i++) {
        console.log("producent - ", listOfFilters[1][i])
    }
    filterSelection(listOfFilters);
}
function filterSelection(filters) {
    for (let i = 0; i < resultProducts.length; i++) {
        let points = 0;
        let cena = parseInt(resultProducts[i].getAttribute("data-cena"));
        let producent = parseInt(resultProducts[i].getAttribute("data-idProducenta")); 
        if (filters[0].length != 0) {
            if (cena > filters[0][0] && cena < filters[0][0]+250 || cena > filters[0][0] && filters[0][0] == 1000 ) {
                points += 1;
            }
        } else {
            points += 1;
        }
        if (filters[1].length != 0) {
            if (filters[1].includes(producent)) {
                points += 1;
            }
        } else {
            points += 1;
        }
        if (points == 2) {
            resultProducts[i].style.display = "block";
        } else {
            resultProducts[i].style.display = "none";
        }
    }
}