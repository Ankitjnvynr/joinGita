



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

function convertToLowercase(input) {
  input.value = input.value.toLowerCase();
}

function blockNumbers(event) {
  // Get the keycode of the pressed key
  var keyCode = event.keyCode || event.which;

  // Allow only alphabetic characters (A-Z, a-z), backspace, and space
  if ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode === 8 || keyCode === 32) {
    return true;
  } else {
    event.preventDefault();
    return false;
  }
}
function blockChars(event) {
  // Get the keycode of the pressed key
  var keyCode = event.keyCode || event.which;

  // Allow only number 
  if ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (keyCode >= 106 && keyCode <= 109) || keyCode === 8 || keyCode === 46 || keyCode === 32) {
    event.preventDefault();
    return false;
  } else {
    return true;
  }
}






