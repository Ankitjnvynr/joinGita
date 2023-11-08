
let smarried = document.querySelector('#married');
let aniversry = document.querySelector('#aniversry');
function aniver() {
    let Svalue = smarried.value;
    if (Svalue === "Married") {
        let AniverDate = document.createElement('input');
        AniverDate.type = 'date';
        AniverDate.name='AniverDate';
        
        console.log(AniverDate)
        console.log(aniversry)
        aniversry.appendChild(AniverDate)
    }
}