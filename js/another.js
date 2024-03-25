



let smarried = document.querySelector('#married');
let aniversry = document.querySelector('#aniversry');
function aniver() {
    let Svalue = smarried.value;
    var AniverLabel = document.createElement('label');
    var AniverDate = document.createElement('input');
    if (Svalue === "Married") {
        let AniverDate = '<div  class="bg-warning-subtle p-2 py-2 rounded"><label class="form-label " for="anniversary">Aniversary</label><input name="aniver_date" id="anniversary" type="date" class="form-control" required></div>';
        aniversry.innerHTML = AniverDate;
    } else {
        aniversry.innerHTML = "";
    }
}




