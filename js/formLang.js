let hindiForm = `


<h2 class="text-center text-danger mb-4">Join GIEO Gita</h2>
<div class="form-group col-md mb-3 d-flex justify-content-center ">
  <select max-width="600px" id="countrySelect" name="country" class='form-control'>
    <option value="">-- Country --</option>
  </select>
</div>
<div class="row">
  <div class="form-floating mb-3 col-md ">
    <input type="text" class="form-control" name="name" placeholder="name@example.com" required>
    <label for="floatingInput">Name</label>
  </div>



  <div class="form-floating mb-3 col-md ">
    <input type="number" class="form-control" id="phone" name="phone" maxlength="20" placeholder="name@example.com" required>
    <label for="floatingInput">Phone No(without country code)</label>
  </div>

</div>
<div class="row">
  <div class="form-floating mb-3 col-md">
    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
    <label for="floatingInput">Email </label>
  </div>
  <div class="form-floating mb-3 col-md">
    <input type="number" class="form-control" name="whatsapp" placeholder="name@example.com" required>
    <label for="floatingInput">WhatsApp Number</label>
  </div>
</div>
<div class="row">
  <div class="form-group col-md mb-3">
    <select name="dikshit" class="form-control" id="inputDistrict" aria-label="Default select example" required>
      <option value="" disabled="" selected="">--दीक्षित परिवार--</option>
      <option value="Yes" aria-selected="false">Yes</option>
      <option value="No" aria-selected="false">No</option>
      <option value="No, but interested" aria-selected="false">No, but interested</option>
    </select>
  </div>
  <div class="form-group col-md mb-3">
    <select name="married" id="married" class="form-control" onchange="aniver()" required>
      <option value="">-- select Marital Status --</option>
      <option value="Married" aria-selected="false">Married</option>
      <option value="Unmarried" aria-selected="false">Unmarried</option>
    </select>
  </div>
</div>
<div class="row">
  <div class=" mb-3 col-md">
    <select id="stateSelect" name="state" class='form-control' required>
      <option value="">-- Region --</option>
    </select>

  </div>
  <div class=" mb-3 col-md">
    <select id="citySelect" name="district" class='form-control' required>
      <option value="">-- City --</option>
    </select>

  </div>
</div>



<div class="row">

  <div class="form-floating mb-3 col-md">
    <input name="tehsil" type="text" class="form-control" placeholder="name@example.com" required>
    <label for="floatingInput">Tehsil</label>
  </div>
  <div class="form-floating mb-3 col-md">
    <input name="address" type="text" class="form-control" id="Village" placeholder="name@example.com" required>
    <label for="Village">Address</label>
  </div>
</div>

<div class="row">
  <div class="form-group col-md mb-3">
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
  </div>
  <div class="form-group col-md mb-3">

    <select name="occupation" class="form-control" data-testid="select-trigger" required="" aria-required="true" aria-invalid="false" required>
      <option value="" disabled="" selected="">Occupation</option>
      <option value="Business" aria-selected="false">Business</option>
      <option value="Home Maker" aria-selected="false">Home Maker</option>
      <option value="Private Job" aria-selected="false">Private Job</option>
      <option value="Govt. Job" aria-selected="false">Govt. Job</option>
      <option value="Student" aria-selected="false">Student</option>
      <option value="Politician" aria-selected="false">Politician</option>
      <option value="Farmer" aria-selected="false">Farmer</option>
      <option value="Teacher" aria-selected="false">Teacher</option>
      <option value="Doctor" aria-selected="false">Doctor</option>
      <option value="Govt. Job, Retired" aria-selected="false">Govt. Job, Retired</option>
      <option value="Retired" aria-selected="false">Retired</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-md mb-3">
    <select name="education" class="form-control" data-testid="select-trigger" required="" aria-required="true" aria-invalid="false" required>
      <option value="" disabled="" class="F8vzy2 HDqSrI" selected="">Education</option>
      <option value="B.Com" aria-selected="false">B.Com</option>
      <option value="M.Com" aria-selected="false">M.Com</option>
      <option value="LLB" aria-selected="false">LLB</option>
      <option value="MBBS" aria-selected="false">MBBS</option>
      <option value="CA" aria-selected="false">CA</option>
      <option value="CS" aria-selected="false">CS</option>
      <option value="Post Graduation" aria-selected="false">Post Graduation</option>
      <option value="Graduation" aria-selected="false">Graduation</option>
      <option value="12th Pass" aria-selected="false">12th Pass</option>
      <option value="10th Pass" aria-selected="false">10th Pass</option>
      <option value="Others" aria-selected="false">Others</option>
    </select>
  </div>
  <div class="form-floating mb-3 col-md ">
    <input name="dob" type="date" class="form-control" required>
    <label for="dob">Birth Date</label>
  </div>
</div>
<div class="row">

  <div id="aniversry" class="form-floating mb-3 col-md">

  </div>
  <div class="form-floating mb-3 col-md">

  </div>
</div>
<div class="form-floating mb-3 col-md ">
  <textarea name="message" class="form-control" name="message" id="" col-mds="30" rows="30"></textarea>
  <label for="floatingInput">Message(if any)</label>
</div>
<div class="d-flex justify-content-center"><button name="submit" type="submit" class="btn btn-danger p-4 py-2 p"><b>Join Now</b></button></div>
</div>


`

let englishForm = `

<h2 class="text-center text-danger mb-4">Join GIEO Gita</h2>
<div class="form-group col-md mb-3 d-flex justify-content-center ">
  <select max-width="600px" id="countrySelect" name="country" class='form-control'>
    <option value="">-- Country --</option>
  </select>
</div>
<div class="row">
  <div class="form-floating mb-3 col-md ">
    <input type="text" class="form-control" name="name" placeholder="name@example.com" required>
    <label for="floatingInput">Name</label>
  </div>



  <div class="form-floating mb-3 col-md ">
    <input type="number" class="form-control" id="phone" name="phone" maxlength="20" placeholder="name@example.com" required>
    <label for="floatingInput">Phone No(without country code)</label>
  </div>

</div>
<div class="row">
  <div class="form-floating mb-3 col-md">
    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
    <label for="floatingInput">Email </label>
  </div>
  <div class="form-floating mb-3 col-md">
    <input type="number" class="form-control" name="whatsapp" placeholder="name@example.com" required>
    <label for="floatingInput">WhatsApp Number</label>
  </div>
</div>
<div class="row">
  <div class="form-group col-md mb-3">
    <select name="dikshit" class="form-control" id="inputDistrict" aria-label="Default select example" required>
      <option value="" disabled="" selected="">--Dikshit--</option>
      <option value="Yes" aria-selected="false">Yes</option>
      <option value="No" aria-selected="false">No</option>
      <option value="No, but interested" aria-selected="false">No, but interested</option>
    </select>
  </div>
  <div class="form-group col-md mb-3">
    <select name="married" id="married" class="form-control" onchange="aniver()" required>
      <option value="">-- select Marital Status --</option>
      <option value="Married" aria-selected="false">Married</option>
      <option value="Unmarried" aria-selected="false">Unmarried</option>
    </select>
  </div>
</div>
<div class="row">
  <div class=" mb-3 col-md">
    <select id="stateSelect" name="state" class='form-control' required>
      <option value="">-- Region --</option>
    </select>

  </div>
  <div class=" mb-3 col-md">
    <select id="citySelect" name="district" class='form-control' required>
      <option value="">-- City --</option>
    </select>

  </div>
</div>



<div class="row">

  <div class="form-floating mb-3 col-md">
    <input name="tehsil" type="text" class="form-control" placeholder="name@example.com" required>
    <label for="floatingInput">Tehsil</label>
  </div>
  <div class="form-floating mb-3 col-md">
    <input name="address" type="text" class="form-control" id="Village" placeholder="name@example.com" required>
    <label for="Village">Address</label>
  </div>
</div>

<div class="row">
  <div class="form-group col-md mb-3">
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
  </div>
  <div class="form-group col-md mb-3">

    <select name="occupation" class="form-control" data-testid="select-trigger" required="" aria-required="true" aria-invalid="false" required>
      <option value="" disabled="" selected="">Occupation</option>
      <option value="Business" aria-selected="false">Business</option>
      <option value="Home Maker" aria-selected="false">Home Maker</option>
      <option value="Private Job" aria-selected="false">Private Job</option>
      <option value="Govt. Job" aria-selected="false">Govt. Job</option>
      <option value="Student" aria-selected="false">Student</option>
      <option value="Politician" aria-selected="false">Politician</option>
      <option value="Farmer" aria-selected="false">Farmer</option>
      <option value="Teacher" aria-selected="false">Teacher</option>
      <option value="Doctor" aria-selected="false">Doctor</option>
      <option value="Govt. Job, Retired" aria-selected="false">Govt. Job, Retired</option>
      <option value="Retired" aria-selected="false">Retired</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-md mb-3">
    <select name="education" class="form-control" data-testid="select-trigger" required="" aria-required="true" aria-invalid="false" required>
      <option value="" disabled="" class="F8vzy2 HDqSrI" selected="">Education</option>
      <option value="B.Com" aria-selected="false">B.Com</option>
      <option value="M.Com" aria-selected="false">M.Com</option>
      <option value="LLB" aria-selected="false">LLB</option>
      <option value="MBBS" aria-selected="false">MBBS</option>
      <option value="CA" aria-selected="false">CA</option>
      <option value="CS" aria-selected="false">CS</option>
      <option value="Post Graduation" aria-selected="false">Post Graduation</option>
      <option value="Graduation" aria-selected="false">Graduation</option>
      <option value="12th Pass" aria-selected="false">12th Pass</option>
      <option value="10th Pass" aria-selected="false">10th Pass</option>
      <option value="Others" aria-selected="false">Others</option>
    </select>
  </div>
  <div class="form-floating mb-3 col-md ">
    <input name="dob" type="date" class="form-control" required>
    <label for="dob">Birth Date</label>
  </div>
</div>
<div class="row">

  <div id="aniversry" class="form-floating mb-3 col-md">

  </div>
  <div class="form-floating mb-3 col-md">

  </div>
</div>
<div class="form-floating mb-3 col-md ">
  <textarea name="message" class="form-control" name="message" id="" col-mds="30" rows="30"></textarea>
  <label for="floatingInput">Message(if any)</label>
</div>
<div class="d-flex justify-content-center"><button name="submit" type="submit" class="btn btn-danger p-4 py-2 p"><b>Join Now</b></button></div>
</div>

`

var lang = document.getElementById("lang");
var hin = document.getElementById("hin");
var eng = document.getElementById("eng");
var joinForm = document.getElementById("joinForm");
let body = document.body
if (lang.value == 'ENG') {
    joinForm.innerHTML = englishForm;
    scs();
    anotherJs();
} else {
    joinForm.innerHTML = hindiForm;
    scs();
    anotherJs();
}
lang.addEventListener("change", () => {
    console.log(lang.value)
    if (lang.value == 'ENG') {
        joinForm.innerHTML = englishForm;
        scs();
        anotherJs();
    } else {
        joinForm.innerHTML = hindiForm;
        scs();
        anotherJs();
    }

})