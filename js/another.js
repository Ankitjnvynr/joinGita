
let smarried = document.querySelector('#married');
let aniversry = document.querySelector('#aniversry');
function aniver() {
    let Svalue = smarried.value;
    if (Svalue === "Married") {
        let AniverDate = '<input name="ani-date" id="anniversary" type="date" class="form-control" required> <label for="anniversary">Anniversary Date</label>';
        aniversry.innerHTML = AniverDate;
    }else{
        aniversry.innerHTML = "";
    }
}