function ajaxFunction(val,ajaxDiv,urlAjax){
    var ajaxRequest;  // The variable that makes Ajax possible!

    try{
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
    } catch (e){
            // Internet Explorer Browsers
            try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                    try{
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e){
                            // Something went wrong
                            alert("Your browser not supported!");
                            return false;
                    }
            }
    }

    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
                    var ajaxDisplay = document.getElementById(ajaxDiv);
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
                    redeclare();
            }
    }

    var n = urlAjax.indexOf("?");

    if(n=='-1')
    {
        var queryString = "?val=" + val;
    }
    else
    {
        var queryString = "&val=" + val;
    }
    ajaxRequest.open("GET", urlAjax + queryString, true);
    ajaxRequest.send(null); 
}
        
function ajaxCheckbox(name,val,thisval,ajaxDiv,urlAjax){
    var ajaxRequest;  // The variable that makes Ajax possible!

    try{
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
    } catch (e){
            // Internet Explorer Browsers
            try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                    try{
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e){
                            // Something went wrong
                            alert("Your browser not supported!");
                            return false;
                    }
            }
    }

    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
                    var ajaxDisplay = document.getElementById(ajaxDiv);
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
            }
    }

    if(thisval==val)
    {
        document.getElementById(name).value='';
        document.getElementById(name).checked = true;
    }
    else
    {
        document.getElementById(name).value=val;
        document.getElementById(name).checked = false;
    }

    var queryString = "?val=" + thisval;
    ajaxRequest.open("GET", urlAjax + queryString, true);
    ajaxRequest.send(null); 
}        
		
function hapusjs(form,id, msg) 
{
    resp = confirm('' + msg);
    if (resp) {
        grid.elements['idhapus'].value = id;
        grid.elements['hapus'].value = 1;
        
    }
	grid.submit();
}
			
function hantar(form)
{
        form.target = '';
        form.submit();
}

function cetak(form,val)
{
    var vallama = form.action;

    form.action = val;
    form.target = '_blank';
    form.submit();
    form.action = vallama;
    form.target = '';
}

// ===================== loading for ajax process ===========================
// ref : http://www.itgeared.com/articles/1506-how-to-display-image-spinner-ajax-request/
function openModal() {
        document.getElementById('modal_loading').style.display = 'block';
        document.getElementById('fade_loading').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal_loading').style.display = 'none';
    document.getElementById('fade_loading').style.display = 'none';
}
// ===================== loading for ajax process ===========================


function ajaxAll(formid,ajaxDiv,urlAjax) {
        //console.log("submit event");
        openModal();
        var fd = new FormData(document.getElementById(formid));
        $.ajax({
          url: urlAjax,
          type: "POST",
          data: fd,
          processData: false,  // tell jQuery not to process the data
          contentType: false   // tell jQuery not to set contentType
        }).done(function( data ) {
            //console.log("PHP Output:");
            //console.log( data );
            //$("#upload_sts").load("demo_test.txt");
            closeModal();
             $('#'+ajaxDiv).html(data);
             redeclare();
        });
        
        return false;
    }
    
function ajaxReadLS(lskey,ajaxDiv,urlAjax) {
        if (typeof(Storage) !== "undefined") {
        // Code for localStorage/sessionStorage.
            $.ajax({
              url: urlAjax,
              type: "POST",
              data: { lsvalue : localStorage.getItem(lskey)},
              success: function(data) {
            $('#'+ajaxDiv).html(data);
            }
            });

            return false;
        } else {
            // Sorry! No Web Storage support..
            alert('Sorry! No Web Storage support..');
        }
    }   
    
function ajaxSetLS(lskey,lsvalue,ajaxDiv,urlAjax) {
        if (typeof(Storage) !== "undefined") {
        // Code for localStorage/sessionStorage.
            var myvalue = document.getElementById(lsvalue).value;
            localStorage.setItem(lskey, myvalue);
            $.ajax({
              url: urlAjax,
              type: "POST",
              data: { lsvalue : localStorage.getItem(lskey)},
              success: function(data) {
            $('#'+ajaxDiv).html(data);
            }
            });

            return false;
        } else {
            // Sorry! No Web Storage support..
            alert('Sorry! No Web Storage support..');
        }
    }  
    
function ajaxRemoveLS(lskey,ajaxDiv,urlAjax) {
        if (typeof(Storage) !== "undefined") {
        // Code for localStorage/sessionStorage.
            localStorage.removeItem(lskey);
            $.ajax({
              url: urlAjax,
              type: "POST",
              data: { lsvalue : localStorage.getItem(lskey)},
              success: function(data) {
            $('#'+ajaxDiv).html(data);
            }
            });

            return false;
        } else {
            // Sorry! No Web Storage support..
            alert('Sorry! No Web Storage support..');
        }
    }     

function ajaxAllXML(form,ajaxDiv,urlAjax){
    //openModal();
    var ajaxRequest;  // The variable that makes Ajax possible!
    try{
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
    } catch (e){
            // Internet Explorer Browsers
            try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                    try{
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e){
                            // Something went wrong
                            alert("Your browser not supported!");
                            return false;
                    }
            }
    }

    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
                    var ajaxDisplay = document.getElementById(ajaxDiv);
                    //closeModal();
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
            
                    redeclare();
            }
    }

    var formName = form.name;
    var elem = document.getElementById(formName).elements;
    var str = '';
    for(var i = 0; i < elem.length; i++)
    {
        if(elem[i].type != 'checkbox')
        {
            if(elem[i].type != 'radio')
            {
                str += encodeURIComponent(elem[i].name) + "=" + encodeURIComponent(elem[i].value) + "&"; 
            }
            else if(elem[i].type == 'radio' && elem[i].checked == true)
            {
               str += encodeURIComponent(elem[i].name) + "=" + encodeURIComponent(elem[i].value) + "&"; 
            }
        }
        else if(elem[i].type == 'checkbox' && elem[i].checked == true)
        {
           str += encodeURIComponent(elem[i].name) + "=" + encodeURIComponent(elem[i].value) + "&"; 
        }
		
        /*
        if(elem[i].type=='file')
        {
            var blob = new Blob(['abc123'], {type: 'text/plain'});
            var fileList = this.files;
            var file = fileList[0];
            var r = new FileReader();
            r.readAsBinaryString(file);
            str += "gambar=" + r;
        }
        */
    }
    ajaxRequest.open("POST", urlAjax, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(str); 
}
    
function myFunction() {
    var x = document.getElementById("snackbar");
    if(x)
    {
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
}

function redeclare()
{                    
    myFunction();
    FormPlugins.init();
    Notification.init();
    EmailCompose.init();
}