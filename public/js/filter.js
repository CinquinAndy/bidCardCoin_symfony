function checkValue() {
    if ((document.getElementById('dateInf').value) && (document.getElementById('dateSupp').value)) {
        return (window.location.href = '/date/' + document.getElementById('dateInf').value + '/' + document.getElementById('dateSupp').value)
    } else {
        console.log("Date non valides");
    }
}

var list_getNom = new List('listeFuzzy', {
    valueNames: ['getNom', 'getDescription', 'getArtiste', 'getLieuVenteLot', 'getIdLot', 'getIdProduits'],
    fuzzySearch: {
        searchClass: "fuzzy_search_getNom",
        location: 0,
        distance: 100,
        threshold: 0.6,
    }
})

function filterResultPrix() {
    let valueInf = document.getElementById('filter_priceInf').value;
    let valueSupp = document.getElementById('filter_priceSupp').value;

    if (valueInf === '' && valueSupp === '') {
        // les deux valeurs sont nules
        // on ne fais rien dans ce cas (on pourras géré un selection par 'défaut' de base, plus tard)
    } else if (valueInf === '' || valueSupp === '') {
        // l'une des deux valeurs est nule
        if (valueInf === '') {
            valueInf = 0;
        }
        if (valueSupp === '') {
            valueSupp = 2147483647;
        }
    }
    if (valueInf > valueSupp) {
        let valueTemp = valueInf;
        valueInf = valueSupp;
        valueSupp = valueTemp;
    }
    for (const key of data) {
        if ((parseInt(key.prix) < valueInf) || (parseInt(key.prix) > valueSupp)) {
            let current = document.getElementById(("lot[" + key.id + "]"));
            current.classList.add('hidden');
        }
    }
}

function dateFormat(stringDate){
    let tab=(stringDate).split('/');
    return `${(tab[2].split(' '))[0]}-${tab[1]}-${tab[0]}T${(tab[2].split(' '))[1]}`
}

function filterResultDate() {
    let valueInfDate = document.getElementById('filter_dateTimeInf').value;
    let valueSuppDate = document.getElementById('filter_dateTimeSupp').value;

    valueInfDate=(new Date(valueInfDate).getTime());
    valueSuppDate=(new Date(valueSuppDate).getTime());

    for (const key of data) {
        let date=new Date(dateFormat(key.date));
        date=date.getTime();

        if ((valueInfDate > date) || (valueSuppDate < date)) {
            let current = document.getElementById(("lot[" + key.id + "]"));
            current.classList.add('hidden');
        }
    }
}

function resetFilterAjax(){
    for (const key of data) {
        let current = document.getElementById(("lot[" + key.id + "]"));
        current.classList.remove('hidden');
    }
}