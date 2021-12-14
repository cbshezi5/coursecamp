    
const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

let validIdentityNumber = function(idNumber, error){

  idNumber = idNumber.toString()

  var correct = true;
  var message = ''

  //Ref: http://www.sadev.co.za/content/what-south-african-id-number-made
  // SA ID Number have to be 13 digits, so check the length
  console.log(idNumber)
  if (idNumber.length != 13/* || !isNumber(idNumber)*/) {
      /*error.append('<p>ID number does not appear to be authentic - input not a valid number</p>');*/
      message += '- ID is not of required length<br/>'
      el.html(error, message)
      correct = false;
  }

  // get first 6 digits as a valid date
  var tempDate = new Date(idNumber.substring(0, 2), idNumber.substring(2, 4) - 1, idNumber.substring(4, 6));

  console.log(tempDate)

  var id_date = tempDate.getDate();
  var id_month = tempDate.getMonth();
  var id_year = tempDate.getFullYear();

  var fullDate = id_date + "-" + (id_month + 1) + "-" + id_year;
  console.log(id_date)
  console.log(fullDate)
  if (!((tempDate.getYear() == idNumber.substring(0, 2)) && (id_month == idNumber.substring(2, 4)-1) && (id_date == idNumber.substring(4, 6)))) {
      
      message += '- The Date Part Does Not Add Up'
      el.html(error, message)
      correct = false;
  }

  // get the gender
  var genderCode = idNumber.substring(6, 10);
  var gender = parseInt(genderCode) < 5000 ? "Female" : "Male";

  // get country ID for citzenship
  var citzenship = parseInt(idNumber.substring(10, 11)) == 0 ? "Yes" : "No";

  return {
    valid : correct,
    gender : gender,
    citizenship : citzenship,
    date : fullDate,
    message : message
  }


}

let ontype = function(input){

  input.onkeyup = function(){

    if(input.value.toString().length == 0){

      el.html('.id-validator', ``)

    }else{

      let payload = validIdentityNumber(input.value, '.id-validator')

      if(payload.valid){

        el.html('.id-validator', `gender : ${payload.gender}, citizen : ${payload.citizenship}`)
        el.get('.id-validator').style.color = "green"

      }else{

        el.html('.id-validator', payload.message)
        el.get('.id-validator').style.color = "red"

      }

    }

  }


}

/*
   
   Javascript Frame To Make Coding In Javascript Easier
*/

  
  // Class To Handle All Network Connections
  class Http {

    // Define Class Constructor
    __constructor(){

      this.xhr = null;
      this.form = null;
      this.url = null;
      this.method = null;

    } // End OF Constructor


    // Method For Setting Class Variables
    set(method, url, form){

      this.method = method;
      this.url = url;
      this.form = form;
      this.xhr = new XMLHttpRequest();

    } // End Of Set

    progressbar(bar_props){

      var progress = 0;
      this.xhr.upload.onprogress = (e) => {

        var done = e.position || e.loaded, total = e.totalSize || e.total;
        progress =(Math.floor(done / total * 1000) / 10 );

        DOM.get(bar_props[0]).style.display = 'block';
        DOM.get(bar_props[1]).style.width = `${progress}%`;

        DOM.html(bar_props[2], `${progress}%`);

        if(progress == 100){

          DOM.html(bar_props[2],`${progress}% COMPLETE!!`);

        }

        console.log(progress);
          
      } // End Of Arrow Function

    } // End Of ProgressBar

    // Method For Sending The Actual Request, Accepts A Callback Function And A Tag For Progress Bar
    request(args, callback){

      var self = this;
      self.set(args.method, args.url, args.form)

      // Handle Error That May Arise
       try {
         
         self.xhr.onreadystatechange = () => {

            if(self.xhr.readyState == 4 && self.xhr.status == 200){

               callback(JSON.parse(self.xhr.responseText));

            } // End Of If

         } // End Of Arrow Function

         if(args.need_progress_bar){

           self.progressbar(args.bar);

         }

         self.xhr.open(self.method, self.url, true);
         self.xhr.send(self.form);

       } catch(e) {

         // statements
         console.log(e);

       } // End OF Try-Catch

    } // End Of Request Method

  } // End Of Class

  // Class To Easily Access And Create HTML Tags With Added Attributes In Javascript

  class Element{

    // Class Constructor
    __constructor(dom){

      this.dom = dom;

    } // End Of Constructor

    isMobile(){
      return screen.width < 700
    }

    // For Getting An Element
    get(identifiier){

      return document.querySelector(identifiier);

    } // End Of get()

    // For Getting Elements Of The Same Identifier
    gets(identifier){

       return document.querySelectorAll(identifier);

    } // End Of gets()

    // Gets Value Of A Field
    val(identifier){

       return document.get(identifier).value;

    } // End Of val()

    value(identifier, value){

      this.get(identifier).value = value

    }

    // For Writing Inside HTML tags
    html(identifier, content){
         
       this.get(identifier).innerHTML = content;

    } // End Of html()

      loader(){

      let center = this.create('center', '');
      let Loader = this.create('div', 'app-loader');

      center.appendChild(Loader);

      return center;

    } // End Of Loader

    toast(str){

      this.get('.toast-text').textContent = str;
      this.get('.app-toast').style.display = 'block';

      // Clear The Toast After 3000ms, 1000ms = 1s
      setTimeout(

        () => {

        this.get('.app-toast').style.display = 'none';
        
      }, 
      4000);

    } // End of toast()

    // For Creating Element And Its Class
    create(name, classes){

       let Tag = document.createElement(name);

       Tag.setAttribute('class', classes);

       return Tag;

    } // End Of element()

  } // End Of Class


  const http = new Http()
  const el = new Element(document)

