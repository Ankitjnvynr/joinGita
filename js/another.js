
let smarried = document.querySelector('#married');
let aniversry = document.querySelector('#aniversry');
function aniver() {
    let Svalue = smarried.value;
    if (Svalue === "Married") {
        let AniverDate = document.createElement('input');
        AniverDate.type = 'date';
        AniverDate.name='AniverDate';
        AniverDate.id='AniverDate';
        AniverDate.classList.add('form-control')
        console.log(AniverDate)
        let AniverLabel = document.createElement('label');
        AniverLabel.innerText="Aniversary Date"
        AniverLabel.setAttribute('for','AniverDate')
        console.log(AniverLabel)
        aniversry.appendChild(AniverDate)
        aniversry.appendChild(AniverLabel)
    }
}