var nizKnjige = []
var knjigeIzLs = dohvatiKnjigeIzlocalStorageKorpa();
if(knjigeIzLs == null)knjigeIzLs=0;
if (knjigeIzLs.length) {
    ispisKnjigaKrozTabelu();
} else {
    $("#drziTabelu").html("<h1>Cart is empty!</h1>");
    
}
console.log(knjigeIzLs.length);
console.log(nizKnjige);



function ispisKnjigaKrozTabelu() {
    $.ajax({
        url:"logic/getAllBooks.php",
        method:"post",
        dataType:"json",
        success:function(data,status,jqXHR){

            data = data.filter(k => {
                for (let knjiga of knjigeIzLs) {
                    if (k.idNaslov == knjiga.id) {
                        k.kolicina = knjiga.kolicina;
                        return true;
                    }
    
                }
                return false;
            });
            tabela(data);
        },
        error: function(xhr,status,error){
      
          console.log(xhr.responseText);
          var poruka = "Ckivre 6.";
      
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
      
      }
      });
        
   


    function tabela(knjige) {
        let ispis = `
<thead>
    <th>Picutre</th>
    <th>Title</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Remove</th>
</thead>
<tbody>`;
        for (let k of knjige) {
            ispis += `
        <tr>
            <td><img src="${k.srcKorpa}"/></td>
            <td class="align-middle">${k.naslov}</td>
            <td class="align-middle"><input type="number" data-id="${k.idNaslov}" class="nmbKolicina" value="${k.kolicina}" min="1"/></td>
            <td class="align-middle">$${k.novaCena * k.kolicina}</td>
            <td class="align-middle"><button class="izbrisi" class="btn btn-light" onclick="izbirsiIzKorpe(${k.idNaslov})" data-idknjige="${k.idNaslov}">Remove</button></td>
        </tr>
    `;
        }
        ispis += `</tbody>
`;
        $("#tabela").html(ispis);
        $("#tabela").append("<td colspan='5'><button id='kupi' class='btn btn-success btn-lg'>Buy</button></td>");
        $(".nmbKolicina").change(function(){
            var vred = Number($(this).val());
            var id = $(this).data('id');

            knjigeIzLs = knjigeIzLs.filter(knjiga => {
                for (let k of knjigeIzLs) {
                    if (k.id == id) {
                        k.kolicina = vred;
                        return true;
                    }
    
                }
                return false;
            });

            ubaciKnjigeUlocalStorageKorpa(knjigeIzLs);

            ispisKnjigaKrozTabelu();
        });
        $("#kupi").on("click",function(){
            localStorage.removeItem("knjigeKorpa");

            $.ajax({
                url:"logic/order.php",
                method:"post",
                dataType:"json",
                data:{
                    idNaslovaIkolicina:knjigeIzLs,
                    send:true
                },
                success:function(data,status,jqXHR){
                    console.log(data);
                    alert("You successfuly made an order!");
                },
                error: function(xhr,status,error){
              
                  console.log(xhr.responseText);

              
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
              
              }
              });
              location.reload();
        });
    }
}
function izbirsiIzKorpe(id){
    let knjigeBezKliknute = knjigeIzLs.filter(k => k.id != id);

    ubaciKnjigeUlocalStorageKorpa(knjigeBezKliknute);

    ispisKnjigaKrozTabelu();

    location.reload();
  
}


function ubaciKnjigeUlocalStorageKorpa(knjiga) {
    localStorage.setItem("knjigeKorpa", JSON.stringify(knjiga));
}
function dohvatiKnjigeIzlocalStorageKorpa() {
    return JSON.parse(localStorage.getItem("knjigeKorpa"));
}

