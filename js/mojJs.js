$(document).ready(function () {
  //idi gore

  
  $("#updateForm").hide();
  $("#updateFormUser").hide();
  $("#idiGore").hide();
  $(document).on("scroll",function(){
    var vrednost = $(this).scrollTop();
    if (vrednost > 500) {
      $("#idiGore").slideDown();
    } else {
      $("#idiGore").slideUp();
    }
  });
  $('#idiGore a').click(function () {
    $.scrollTo(0, 'slow');
    return false;
  });
  $("#sendMessageButton").on("click",provera);
  $("#adminNav a").on("click",prikaziForme);


  $("#btnRegister").on("click",posalji);
  $("#btnInsert").on("click",insert);
  $("#btnInsertBook").on("click",insertKnjiga);
  $("#btnInsertGenre").on("click",insertZanr);
  
  $("#tbSearch").on("keyup",filtrirajPoUnosu);
  
  $(".stranica").on("click",prikazi);
  $("#btnSurvey").on("click",glasaj);
  $("#apply").on("click",sortIfilter);

  //hover strelice
  $("#idiGore a").hover(function () {
    $(this).animate({ backgroundColor: "#fff" }, 200);
    $("#idiGore a i").animate({ color: "#333e4f" }, 200);
  }, function () {
    $(this).animate({ backgroundColor: "#333e4f" }, 200);
    $("#idiGore a i").animate({ color: "#fff" }, 200);
  });
  
});
$("#insertForms").hide();
$("#updateDelete").hide();
$("#survey").hide();
$("#orders").hide();
$("#contactFormAdmin").hide();
$("#updateDeleteUser").hide();
$("#genres").hide();

function prikaziForme(){
  $("#insertForms").hide();
  $("#updateDelete").hide();
  $("#survey").hide();
  $("#orders").hide();
  $("#updateForm").hide();
  $("#contactFormAdmin").hide();
  $("#updateDeleteUser").hide();
  $("#genres").hide();
  
let href = $(this).attr('href');
  $("#contact "+href).fadeIn();

}



$("a[href='index.php?page=Logout']").on("click",function(){
    $.ajax({
    url:"logic/logout.php",
    method:"GET",
    dataType:"text",
    success:function(data){
        let daLiIma;
        if(localStorage.getItem("knjigeKorpa")==null || localStorage.getItem("knjigeKorpa")==undefined){
             daLiIma=0;
        }else{
            daLiIma = localStorage.getItem("knjigeKorpa").length;
        }
       
        if(daLiIma){
            localStorage.removeItem("knjigeKorpa");
        }
        
        location.replace("index.php?page=Home");

    }
    });
});





function insertZanr(){
  let podaciZaInsert = {
    zanr: $("#genreInsert").val()
  };
  $.ajax({
    url:"logic/insertGenre.php",
    data: podaciZaInsert,
    method:"post",
    dataType:"json",
    success:function(data){
      alert("Successfuly added to database!");
      location.reload();
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);

  
      switch(xhr.status){
          case 404:
              alert("You need to insert something.");
              break;
          case 500:
              alert("Server error please try again.")
              break;
          default:
              alert("Error: "+xhr.status+'-'+error); 
              break;     
          
      }
      
  
  }
  });
}











function insertKnjiga(){
  let podaciZaInsert = {
    naslov: $("#titleBook").val(),
    novaCena: $("#newPriceBook").val(),
    staraCena: $("#oldPriceBook").val(),
    opis: $("#messageInsertBook").val(),
    datumObjave: $("#dateInsertBook").val(),
    zanrId: $("#ddlGenreBook").val(),
    autor: $("#ddlAutorInsert").val(),
    src: $("#srcBook").val(),
    srcCart: $("#srcBookCart").val(),
    send : true
  };
  $.ajax({
    url:"logic/insertBook.php",
    data: podaciZaInsert,
    method:"post",
    dataType:"json",
    success:function(data){
      alert("Uspesno je dodato u bazu!");
      location.reload();
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);

  
      switch(xhr.status){
          case 404:
            alert("Page not found.");
            break;
          case 500:
              alert("Server error please try again.")
              break;
          default:
            alert("Error: "+xhr.status+'-'+error); 
            break;     
          
      }
      
  
  }
  });
}





















$(".delete").on("click",function(e){
  e.preventDefault();
  let idK = $(this).data('id');

  $.ajax({
    url:"logic/delete.php",
    data: {
      id:idK
    },
    method:"post",
    dataType:"json",
    success:function(data,status,jqXHR){
      

      console.log(jqXHR.status);
      console.log(data);
      alert("Successfuly deleted!");
      location.reload();
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);
  
      switch(xhr.status){
          case 404:
              alert("Page not found.");
              break;
          case 500:
              alert("Delete denied,book is already ordered.")
              break;
          default:
            alert("Error: "+xhr.status+'-'+error); 
            break;       
          
      }

  
  }
  });

});
















$(".deleteUser").on("click",function(e){
  e.preventDefault();
  let idKorisnik = $(this).data('idkor');

  $.ajax({
    url:"logic/deleteUser.php",
    data: {
      id:idKorisnik
    },
    method:"post",
    success:function(data,status,jqXHR){
      

      console.log(jqXHR.status);
      console.log(data);
      alert("Successfuly deleted!");
      location.reload();
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);
  
      switch(xhr.status){
          case 404:
              alert("Page not found.");
              break;
          case 500:
              alert("Server error please try again.")
              break;
          default:
            alert("Error: "+xhr.status+'-'+error); 
            break;       
          
      }

  
  }
  });

});











function glasaj(){
  let idIzbor = $("input[name='rbZanr']:checked").data('id');


  $.ajax({
    url:"logic/survey.php",
    data: {
      id:idIzbor
    },
    method:"post",
    dataType:"json",
    success:function(data,status,jqXHR){
      
      alert("You successfuly voted!");
      console.log(jqXHR.status);
      console.log(data);

    },
    error: function(xhr,status,error){
  
      
     
      console.log(xhr.responseText);
  
      switch(xhr.status){
          case 404:
              alert("You need to check something.");
              break;
          case 500:
              alert("You have already voted!")
              break;
          default:
              alert("Error: "+xhr.status+'-'+error); 
              break;       
          
      }

  
  }
  });
}









$(".update").on("click",function (e){
  $("#updateForm").show();
  e.preventDefault();
  var el = $(this).attr('href');
  var position = $(el).offset().top;
  $(window).animate({ scrollTop: position }, 1000);

 
  let idK = $(this).data('idk');
  let idA = $(this).data('ida');

  $.ajax({
    url:"logic/getAllDataAjax.php",
    data: {
      idK:idK,
      idA:idA,
      send:true
    },
    method:"post",
    dataType:"json",
    success:function(data,status,jqXHR){
      $("#idNaslovHidden").val(data.idNaslov);
      $("#idNaslovAutorHidden").val(data.idNaslovAutor);
      $("#titleUpd").val(data.naslov);
      $("#newPriceUpd").val(data.novaCena);
      $("#oldPriceUpd").val(data.staraCena);
      $("#messageUpd").val(data.opis);
      $("#dateUpd").val(data.datumObjave);
      $("#ddlGenreUpd").val(data.idZanr);
      $("#ddlAutorUpd").val(data.idAutor);


      console.log(jqXHR.status);
      console.log(data);
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);
      var poruka = "Error";
  
      switch(xhr.status){
          case 404:
              poruka = "Page not found";
              break;
          case 500:
              poruka = "Server error please try again";
              break;
          
      }
      alert(poruka);
  
  }
  });
});













$(".updateUser").on("click",function (e){
  $("#updateFormUser").show();
  e.preventDefault();
  var el = $(this).attr('href');
  var position = $(el).offset().top;
  $(window).animate({ scrollTop: position }, 1000);

 
  let idKorisnik = $(this).data('idkor');


  $.ajax({
    url:"logic/getAllUsersAjax.php",
    data: {
      idK:idKorisnik,
      send:true
    },
    method:"post",
    dataType:"json",
    success:function(data,status,jqXHR){
      $("#idKorisnikHidden").val(data.idKorisnik);
      $("#emailUpd").val(data.email);
      $("#usernameUpd").val(data.username);



      console.log(jqXHR.status);
      console.log(data);
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);
      var poruka = "Error occured.";
  
      switch(xhr.status){
          case 404:
              poruka = "Page not found";
              break;
          case 500:
              poruka = "Server error please try again";
              break;
          
      }
      alert(poruka);
  
  }
  });
});





















function insert(){
  let podaciZaInsert = {
    naslov: $("#title").val(),
    novaCena: $("#newPrice").val(),
    staraCena: $("#oldPrice").val(),
    opis: $("#messageInsert").val(),
    datumObjave: $("#dateInsert").val(),
    zanrId: $("#ddlGenre").val(),
    imeAutora: $("#autorName").val(),
    prezimeAutora: $("#autorSurname").val(),
    src: $("#src").val(),
    srcCart: $("#srcCart").val(),
    send : true
  };
  $.ajax({
    url:"logic/insert.php",
    data: podaciZaInsert,
    method:"post",
    dataType:"json",
    success:function(data){
      alert("Uspesno je dodato u bazu!");
      location.reload();
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);

  
      switch(xhr.status){
          case 404:
            alert("Page not found.");
            break;
          case 500:
              alert("Server error please try again.")
              break;
          default:
            alert("Error: "+xhr.status+'-'+error); 
            break;     
          
      }
      
  
  }
  });
}

var knjige = [];




function korpaZaSve(knjige) {
  let korpeDugme = document.getElementsByClassName("korpa");
  for (let k of korpeDugme) {
    k.addEventListener("click", dodajUkorpu);
  }

  function dodajUkorpu() {
   
    if( $(".korisnikJeUlogovan").length > 0){
      var id = this.dataset.idknjige;

      var nizKnjige = [];
  
      var knjigeIzLs = dohvatiKnjigeIzlocalStorageKorpa();
  
      if (knjigeIzLs !== null) {
        if (knjigeIzLs.filter(p => p.id == id).length) {
          let knjigeIzLs = dohvatiKnjigeIzlocalStorageKorpa();
          for (let i in knjigeIzLs) {
            if (knjigeIzLs[i].id == id) {
              knjigeIzLs[i].kolicina++;
              break;
            }
          }
          ubaciKnjigeUlocalStorageKorpa(knjigeIzLs);
        } else {
          for (let k of knjigeIzLs) {
            nizKnjige.push(k);
          }
          let novaKnjiga = knjige.find(k => k.idNaslov == id);
  
          nizKnjige.push({
            id: novaKnjiga.idNaslov,
            kolicina: 1
          });
          ubaciKnjigeUlocalStorageKorpa(nizKnjige);
        }
      } else {
        let knjiga = knjige.find(k => {
          return k.idNaslov == id;
        });
        nizKnjige[0] = {
          id: knjiga.idNaslov,
          kolicina: 1
        };
        ubaciKnjigeUlocalStorageKorpa(nizKnjige)
      }
      alert("Successfuly added to cart!");
  }else{
    alert("You need to be logged in to be able to buy!");
  }
  }
}

function ubaciKnjigeUlocalStorageKorpa(knjiga) {
  localStorage.setItem("knjigeKorpa", JSON.stringify(knjiga));
}
function dohvatiKnjigeIzlocalStorageKorpa() {
  return JSON.parse(localStorage.getItem("knjigeKorpa"));
}



























$.ajax({
url:"logic/fourBooks.php",
dataType:"json",
success:function(data){
    console.log(data);
    ispisKnjiga(data);
    korpaZaSve(data)
    knjige = data;
},
error: function(xhr,status,error){

    console.log(xhr.responseText);
    console.log(xhr.status);
    console.log(status);
    console.log(error);
    var poruka = "NO SENSE";

    switch(xhr.status){
        case 404:
            poruka = "Page not found";
            break;
        case 500:
            poruka = "Server error please try again";
            break;
        
    }
    alert(poruka);

}
});












function sortIfilter() {
  console.log(knjige);
  let id = parseInt($("#ddlGenre").val());
  let ddlSortBy = $("#ddlSortBy").val();

  console.log(id);
  if(id!=0){
    var filter = knjige.filter(k => {
      let ids = [];
      if(k.idZanrovi.indexOf("_") != -1){
        let nizIdeva = k.idZanrovi.split("_");
        for (let item of nizIdeva) {
          ids.push(Number.parseInt(item));
        }
      }else{
        ids.push(Number.parseInt(k.idZanr));
      }
      return ids.indexOf(id) != -1;
    });
    console.log(knjige);
    console.log(filter);
  }else{
    filter = knjige;
  }
  


  if (ddlSortBy == "LtH") { ceniRastuce(filter); }
  else if (ddlSortBy == "HtL") { ceniOpadajuce(filter); }
  else if (ddlSortBy == "AZ") { naslovuOdAdoZ(filter); }
  else if (ddlSortBy == "ZA") { naslovuOdZdoA(filter); }
  else if (ddlSortBy == "New") { datumuNajnoviji(filter); }
  else if (ddlSortBy == "Old") { datumuNajstariji(filter); }
  else if (ddlSortBy == "0") { ispisKnjiga(filter) }
  else { brojuKomentara(filter); }

  ispisKnjiga(filter);
  
}









var predhodna = $("a[data-str='1']").addClass("aktivan");
function prikazi(e){

  e.preventDefault();
  let str = $(this).data('str');
  var trenutna = $(this);
  trenutna.addClass("aktivan");
  predhodna.removeClass("aktivan");
  predhodna = trenutna;

  $.ajax({
    url:"logic/fourBooks.php",
    data:{
      str:str
    },
    dataType:"json",
    success:function(data){
      console.log(data);
      ispisKnjiga(data);
      korpaZaSve(data);
      knjige = data;
      console.log(knjige);
    },
    error: function(xhr,status,error){
  
      console.log(xhr.responseText);
    console.log(xhr.status);
    console.log(status);
    console.log(error);
      
      var poruka = "Error occured.";
  
      switch(xhr.status){
          case 404:
              poruka = "Page not found";
              break;
          case 500:
              poruka = "Server error please try again";
              break;
          
      }
      alert(poruka);
  
  }
  });
}



function ceniRastuce(knjige) {
  let sortirano = knjige.sort((a, b) => {
    let cena1 = a.novaCena;
    let cena2 = b.novaCena;

    return cena1 - cena2;
  });
  ispisKnjiga(sortirano);
}
function ceniOpadajuce(knjige) {
  let sortirano = knjige.sort((a, b) => {
    let cena1 = a.novaCena;
    let cena2 = b.novaCena;

    return cena2 - cena1;
  });
  ispisKnjiga(sortirano);
}
function naslovuOdAdoZ(knjige) {
  let sortirano = knjige.sort((a, b) => {
    let naslov1 = a.naslov;
    let naslov2 = b.naslov;

    return naslov1 > naslov2 ? 1 : -1;
  });
  ispisKnjiga(sortirano);
}
function naslovuOdZdoA(knjige) {
  let sortirano = knjige.sort((a, b) => {
    let naslov1 = a.naslov;
    let naslov2 = b.naslov;

    return naslov1 < naslov2 ? 1 : -1;
  });
  ispisKnjiga(sortirano);
}
function datumuNajnoviji(knjige) {
  let sortirano = knjige.sort((a, b) => {
    let datum1 = new Date(a.datumObjave);
    let datum2 = new Date(b.datumObjave);

    return Date.UTC(datum2.getFullYear(), datum2.getMonth(), datum2.getDate()) - Date.UTC(datum1.getFullYear(), datum1.getMonth(), datum1.getDate());
  });
  ispisKnjiga(sortirano);
}
function datumuNajstariji(knjige) {
  let sortirano = knjige.sort((a, b) => {
    let datum1 = new Date(a.datumObjave);
    let datum2 = new Date(b.datumObjave);

    return Date.UTC(datum1.getFullYear(), datum1.getMonth(), datum1.getDate()) - Date.UTC(datum2.getFullYear(), datum2.getMonth(), datum2.getDate());
  });
  ispisKnjiga(sortirano);
}




function filtrirajPoUnosu(){
  var unos = $(this).val();
  
      data = knjige.filter(k=>{
        return k.naslov.toLowerCase().indexOf(unos) != -1;
      });
      ispisKnjiga(data);
   
}

(function (){
  $.ajax({
    url:"logic/genres.php",
    dataType:"json",
    success:function(data){
    //   console.log(data);
      ispisZanrova(data);
    
    }
  });
})();

(function (){
  $.ajax({
    url:"logic/autors.php",
    dataType:"json",
    success:function(data){
    //   console.log(data);
      ispisAutora(data);
    
    }
  });
})();

(function ispisSortBy(){
  let niz = ["Price Low to High","Price High to Low","Title A-Z","Title Z-A","Newest","Oldest"];
  let values = ["LtH","HtL","AZ","ZA","New","Old"];
  let ispis =``;
  for (let i in niz) {
    ispis+=`<option value="${values[i]}">${niz[i]}</option>`;
  }
  $("#ddlSortBy").append(ispis);
})();


function ispisAutora(autori){
  let ispis = ``;
  for (let a of autori) {
    ispis+=`<option value="${a.idAutor}">${a.ime +' '+ a.prezime}</option>`;
  }
  $("#ddlAutorUpd").append(ispis);
  $("#ddlAutorInsert").append(ispis);
}


function ispisZanrova(zanrovi){
  let ispis = ``;
  for (let z of zanrovi) {
    ispis+=`<option value="${z.idZanr}">${z.naziv}</option>`;
  }
  $("#ddlGenre").append(ispis);
  $("#ddlGenreUpd").append(ispis);
  $("#ddlGenreBook").append(ispis);
}

function ispisKnjiga(knjige) {
  let ispisKnjiga = ``;
  let ispisDDLknjige = ``;

  for (let k of knjige) {
    ispisKnjiga += `<div class="col-lg-4 col-md-6 col-sm-12 portfolio-item ">
            <a class="portfolio-link" href="index.php?page=Summary&id=${k.idNaslov}">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                </div>
              </div>
              <img class="img-fluid" src="${k.src}" alt="${k.alt}">
            </a>
            <div class="portfolio-caption">
              <h4>${k.naslov}</h4>
              <div class="bodyKnjiga">
                <div class="autor">
                    <p>Author: <span class="text-muted">${k.ime + ' '+ k.prezime}</span></p>
                </div>
                <div class="kategoija">
                  <p>Genre: <span class="text-muted">${obradaZanrovi(k.zanrovi)}</span></p>
                </div>
                <div class="datum">
                  <p>Publish date: <span class="text-muted">${k.datumObjave}</span></p>
                </div>
                <div class="cena">
                  <p>Price: <span class="text-muted novaCena">$${k.novaCena} </span><del class="staraCena">${obradaCene(k.staraCena)}</del>
                  </p>
                </div>
              </div>
              <button class="korpa btn btn-outline-warning" data-idknjige="${k.idNaslov}">Add to cart</button>
            </div>
          </div>`;
          function obradaZanrovi(zanrovi){
              if(zanrovi.indexOf("_") != -1){
                let niz = zanrovi.split("_");
                let rez = '';
                niz.filter((item,i) => {
                  i == 0 ? rez+=item : rez+=','+item;
                })
                return rez;
              }
              return zanrovi;
          }
          function obradaCene(cena){
            if(cena == undefined || cena == null || cena == 0){
              return ""
            }else{
              return "$"+cena;
            }
          }
  
    ispisDDLknjige+=`<option value="${k.naslov}">${k.naslov}</option>`;
  }
  $("#knjige").html(ispisKnjiga);
  $("#ddlBooks").append(ispisDDLknjige);
  
}

function posalji(){
  var formData = {
      ime : $("#nameReg").val(),
      prezime : $("#surnameReg").val(),
      email : $("#emailReg").val(),
      username : $("#userReg").val(),
      password : $("#passReg").val(),
      cpassword : $("#cpassReg").val(),
      send : true
  };
  $.ajax({
      url:"logic/register.php",
      method:"post",
      data: formData,
      success: function(data){
          alert("You successfuly registered!");
          location.replace("index.php?page=Login");
      },
      error : function(xhr,status,error){

         var poruka = "Error occured.";
      
          switch(xhr.status){
              case 404:
                  poruka = "Page not found";
                  break;
              case 409:
                  poruka = "Username or email already exists";
                  break;
              case 422:
                  poruka = "Data not valid";
                  break;
              case 500:
                  poruka = "Server error please try again";
                  break;
              
          }
          alert(poruka);

        var string= xhr.responseJSON;
        var json_object= string;
        console.log(json_object);
        let ispis = ``;
        for(let item of json_object){
            ispis += item+"<br/>";
        }
        $(".greske").html(ispis);
        
    }
 
  });
}
/* ------------------------VALIDACIJA FORME------------------------*/
function provera() {
  //prevent default zbog njihovog js-a


  let validno = true;

  let subject = document.getElementById("subject").value.trim();
  let email = document.getElementById("email").value.trim();


  let reSubject = /^[čćđšžчћшђљњж\w\s]{1,100}$/;
  let reEmail = /^[\w][\w\_\-\.\d]+\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/;

  if (subject == "") {
    document.getElementById("greskaIme").innerHTML = "Subject must not be blank.";
    validno = false;
  } else if (!reSubject.test(subject)) {
    document.getElementById("greskaIme").innerHTML = "Letters,underscore,and numbers allowed";
    validno = false;
  }
  else {
    document.getElementById("greskaIme").innerHTML = "";
  }

  if (email == "") {
    document.getElementById("greskaEmail").innerHTML = "Email must not be blank.";
    validno = false;
  } else if (!reEmail.test(email)) {
    document.getElementById("greskaEmail").innerHTML = "Email is not in good format.";
    validno = false;
  }
  else {
    document.getElementById("greskaEmail").innerHTML = "";
  }




  let poruka = document.getElementById("message").value.trim();
  if (poruka == "") {
    document.getElementById("greskaPoruka").innerHTML = "You need to fill in this field.";
    validno = false;
  } else {
    document.getElementById("greskaPoruka").innerHTML = "";
  }


  console.log(validno);
  return validno;
}




