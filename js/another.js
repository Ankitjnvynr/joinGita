


let smarried = document.querySelector('#married');
let aniversry = document.querySelector('#aniversry');
function aniver() {
    let Svalue = smarried.value;
    var AniverLabel = document.createElement('label');
    var AniverDate = document.createElement('input');
    if (Svalue === "Married") {
        
        AniverDate.type = 'date';
        AniverDate.name='AniverDate';
        AniverDate.id='AniverDate';
        AniverDate.classList.add('form-control')
        console.log(AniverDate)
        
        AniverLabel.innerText="Aniversary Date"
        AniverLabel.setAttribute('for','AniverDate')
        console.log(AniverLabel)
        aniversry.appendChild(AniverDate)
        aniversry.appendChild(AniverLabel)
    }else{
        
        aniversry.removeChild(AniverLabel)
        aniversry.removeChild(AniverDate)

        
    }
}

