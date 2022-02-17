var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function changeForm(number) {
    var format = document.getElementsByClassName('forms');
    if (number == 0) {
      format[0].classList.remove("hidden");
      format[0].classList.add("form-style");
      format[1].classList.add("hidden");
      format[1].classList.remove("form-style");
    } else {
      format[1].classList.remove("hidden");
      format[1].classList.add("form-style");
      format[0].classList.add("hidden");
      format[0].classList.remove("form-style");
    }
  }
  document.addEventListener("DOMContentLoaded",
  function(validimi) {
  const BtnSubmit = document.getElementById('submit');
  const validate = (validimi) => {
  validimi.preventDefault();
  
  const emailin = document.getElementsByName('email');
  
  
       const emailValid = (email) => {
      const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\- .])+\.([A-Za-z]{2,4})$/;
      return emailRegex.test(email.toLowerCase());
      }
      BtnSubmit.addEventListener('click', validate);
      }
    }
       ) ;

//        var divElemnts = document.getElementsByClassName('Maincontent');
// var sliderIndex=0;

// document.getElementsByClassName('slider')[0].addEventListener('click', function(event){
//   divElemnts[sliderIndex].classList.remove('acitive');
//   divElemnts[sliderIndex].classList.add('not-active');

//   sliderIndex++;
//   if(sliderIndex == divElemnts.length)sliderIndex=0;

//   divElemnts[sliderIndex].classList.add('active');
//   divElemnts[sliderIndex].classList.remove('not-active');

