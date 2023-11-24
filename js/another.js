
    


let smarried = document.querySelector('#married');
let aniversry = document.querySelector('#aniversry');
function aniver() {
    let Svalue = smarried.value;
    var AniverLabel = document.createElement('label');
    var AniverDate = document.createElement('input');
    if (Svalue === "Married") {
        let AniverDate = '<input name="aniver_date" id="anniversary" type="date" class="form-control" required> <label for="anniversary">Anniversary Date</label>';
        aniversry.innerHTML = AniverDate;
    }else{
        aniversry.innerHTML = "";
    }
}


