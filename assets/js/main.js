const sr=ScrollReveal ( {
    distance: '60px',
    duration: 2500,
    delay: 400,
    reset: true
})
sr.reveal('.text',{delay:200, origin: 'top'})
sr.reveal('.formulaire',{delay:200, origin: 'top'})
sr.reveal('.ride',{delay:200, origin: 'top'})
sr.reveal('.pq',{delay:200, origin: 'top'})
sr.reveal('.about',{delay:200, origin: 'top'})





const form = document.querySelector("form");
eField = form.querySelector(".email"),
eInput = eField.querySelector("input"),
pField = form.querySelector(".password"),
pInput = pField.querySelector("input");

form.onsubmit = (e)=>{
  e.preventDefault(); //preventing from form submitting
  //if email and password is blank then add shake class in it else call specified function
  (eInput.value == "") ? eField.classList.add("shake", "error") : checkEmail();
  (pInput.value == "") ? pField.classList.add("shake", "error") : checkPass();

  setTimeout(()=>{ //remove shake class after 500ms
    eField.classList.remove("shake");
    pField.classList.remove("shake");
  }, 500);

  eInput.onkeyup = ()=>{checkEmail();} //calling checkEmail function on email input keyup
  pInput.onkeyup = ()=>{checkPass();} //calling checkPassword function on pass input keyup

  function checkEmail(){ //checkEmail function
    let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/; //pattern for validate email
    if(!eInput.value.match(pattern)){ //if pattern not matched then add error and remove valid class
      eField.classList.add("error");
      eField.classList.remove("valid");
      let errorTxt = eField.querySelector(".error-txt");
      //if email value is not empty then show please enter valid email else show Email can't be blank
      (eInput.value != "") ? errorTxt.innerText = "Enter a valid email address" : errorTxt.innerText = "Email can't be blank";
    }else{ //if pattern matched then remove error and add valid class
      eField.classList.remove("error");
      eField.classList.add("valid");
    }
  }

  function checkPass(){ //checkPass function
    if(pInput.value == ""){ //if pass is empty then add error and remove valid class
      pField.classList.add("error");
      pField.classList.remove("valid");
    }else{ //if pass is empty then remove error and add valid class
      pField.classList.remove("error");
      pField.classList.add("valid");
    }
  }

  //if eField and pField doesn't contains error class that mean user filled details properly
  if(!eField.classList.contains("error") && !pField.classList.contains("error")){
    window.location.href = form.getAttribute("action"); //redirecting user to the specified url which is inside action attribute of form tag
  }
}

document.addEventListener("DOMContentLoaded", function() {
  var map, marker;
  const locationInput = document.getElementById('autolocation');
  const destinationInput = document.getElementById('destination');

  function initMap(latitude, longitude) {
      map = L.map('mapid').setView([latitude, longitude], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '© OpenStreetMap'
      }).addTo(map);

      marker = L.marker([latitude, longitude], {
          draggable: true
      }).addTo(map)
      .bindPopup('Your current location. Drag to change destination.')
      .openPopup()
      .on('dragend', function() {
          const position = marker.getLatLng();
          destinationInput.value = `${position.lat}, ${position.lng}`;
      });

      // Initially populate destination field
      destinationInput.value = `${latitude}, ${longitude}`;
  }

  function fetchLocation() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              const { latitude, longitude } = position.coords;
              locationInput.value = `${latitude}, ${longitude}`;
              initMap(latitude, longitude);
          }, function() {
              alert('Geolocation access denied. Enable location access and try again.');
          });
      } else {
          alert('Geolocation is not supported by this browser.');
      }
  }

  fetchLocation();
});