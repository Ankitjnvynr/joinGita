let hindiForm = [`
          <select name="dikshit" class="form-control" id="inputDistrict" aria-label="Default select example" required>
            <option value="" disabled="" selected="">--दीक्षित परिवार--</option>
            <option value="Yes" aria-selected="false">Yes</option>
            <option value="No" aria-selected="false">No</option>
            <option value="No, but interested" aria-selected="false">No, but interested</option>
          </select>
`, `
            <select name="intrest" class="form-control" data-testid="select-trigger" required="" aria-required="true" aria-invalid="false" required>
            <option value="" disabled="" selected="">Interested Field</option>
            <option value="श्री कृष्ण कृपा सेवा समिति" aria-selected="false">श्री कृष्ण कृपा सेवा समिति</option>
            <option value="जीओ गीता" aria-selected="false">जीओ गीता</option>
            <option value="सेवा समूह" aria-selected="false">सेवा समूह</option>
            <option value="सूचना समूह" aria-selected="false">सूचना समूह</option>
            <option value="सत्संग समूह" aria-selected="false">सत्संग समूह</option>
            <option value="प्रचार समूह" aria-selected="false">प्रचार समूह</option>
            <option value="पत्रिका समूह" aria-selected="false">पत्रिका समूह</option>
            <option value="यज्ञ समूह" aria-selected="false">यज्ञ समूह</option>
            <option value="शिक्षा समूह" aria-selected="false">शिक्षा समूह</option>
            <option value="चिकित्सा समूह" aria-selected="false">चिकित्सा समूह</option>
            <option value="अधिवक्ता समूह" aria-selected="false">अधिवक्ता समूह</option>
            <option value="युवा चेतना समूह" aria-selected="false">युवा चेतना समूह</option>
            <option value="ग्राम संपर्क समूह" aria-selected="false">ग्राम संपर्क समूह</option>
            <option value="विप्रजन समूह" aria-selected="false">विप्रजन समूह</option>
            <option value="मन्दिर सेवा समूह" aria-selected="false">मन्दिर सेवा समूह</option>
            <option value="महिला समूह" aria-selected="false">महिला समूह</option>
            <option value="समन्वय समूह" aria-selected="false">समन्वय समूह</option>
            <option value="सोशल मीडिया समूह" aria-selected="false">सोशल मीडिया समूह</option>
            <option value="निधि समूह" aria-selected="false">निधि समूह</option>
            <option value="गौ सेवा समूह" aria-selected="false">गौ सेवा समूह</option>
            </select>
`]

let englishForm = [`

  
    <select name="dikshit" class="form-control" id="inputDistrict" aria-label="Default select example" required>
      <option value="" disabled="" selected="">--Dikshit--</option>
      <option value="Yes" aria-selected="false">Yes</option>
      <option value="No" aria-selected="false">No</option>
      <option value="No, but interested" aria-selected="false">No, but interested</option>
    </select>
    ` , `
  
  
    <select name="intrest" class="form-control" data-testid="select-trigger" required="" aria-required="true" aria-invalid="false" required>
      <option value="" disabled="" selected="">Interested Field</option>
      <option value="Shri Krishn Kripa Seva Smiti" aria-selected="false">Shri Krishn Kripa Seva Smiti</option>
      <option value="GIEO Gita" aria-selected="false">GIEO Gita</option>
      <option value="Seva Group" aria-selected="false">Seva Group</option>
      <option value="Suchna Group" aria-selected="false">Suchna Group</option>
      <option value="Satsang Group" aria-selected="false">Satsang Group</option>
      <option value="Prachaar Group" aria-selected="false">Prachaar Group</option>
      <option value="Patrika Group" aria-selected="false">Patrika Group</option>
      <option value="Yagya Group" aria-selected="false">Yagya Group</option>
      <option value="Shiksha Group" aria-selected="false">Shiksha Group</option>
      <option value="Chikitsaha Group" aria-selected="false">Chikitsaha Group</option>
      <option value="Adhivakta Group" aria-selected="false">Adhivakta Group</option>
      <option value="Yuva Chetna Group" aria-selected="false">Yuva Chetna Group</option>
      <option value="Gram Sampark Group" aria-selected="false">Gram Sampark Group</option>
      <option value="Viprajan Group" aria-selected="false">Viprajan Group</option>
      <option value="Mandir Seva Group" aria-selected="false">Mandir Seva Group</option>
      <option value="Mahila Group" aria-selected="false">Mahila Group</option>
      <option value="Samvaya Group" aria-selected="false">Samvaya Group</option>
      <option value="Social Media Group" aria-selected="false">Social Media Group</option>
      <option value="Nidhi Group" aria-selected="false">Nidhi Group</option>
      <option value="Gau Seva Group" aria-selected="false">Gau Seva Group</option>
    </select>
`]


let fill = document.querySelectorAll('.fill')
var lang = document.getElementById("lang");
var hin = document.getElementById("hin");
var eng = document.getElementById("eng");
var joinForm = document.getElementById("joinForm");



if (lang.value == 'ENG') {
  fill[0].innerHTML = englishForm[0];
  fill[1].innerHTML = englishForm[1];

} else {
  fill[0].innerHTML = hindiForm[0];
  fill[1].innerHTML = hindiForm[1];

}
lang.addEventListener("change", () => {
  // console.log(lang.value)
  if (lang.value == 'ENG') {
    fill[0].innerHTML = englishForm[0];
    fill[1].innerHTML = englishForm[1];

  } else {
    fill[0].innerHTML = hindiForm[0];
    fill[1].innerHTML = hindiForm[1];

  }


})