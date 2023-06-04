$(document).ready(function(){
    $(function(){
        $("#header").load("../header/navbar.html"); 
    });
    
});

const btnAccepted = document.querySelector('.accepted') ?? '';

btnAccepted.onclick = function () {
    console.log(btnAccepted.value)
    var result = confirm(btnAccepted.value == 'rh' ? 'Tem certeza que quer contratar esse programador?' : 'Tem certeza que quer aceitar esse convite?')
    if(result){
        window.location.reload();
    }
  };

  const btnDenied = document.querySelector('.denied') ?? '';

  btnDenied.onclick = function () {
      var result = confirm(btnDenied.value == 'rh' ? 'Tem certeza que quer recusar esse programador?' : 'Tem certeza que quer recusar esse convite?')
      if(result){
          window.location.reload();
      }
    };

const btnInvite = document.querySelector('.invite') ?? '';

btnInvite.onclick = function () {
        var result = confirm('Tem certeza que quer convidar esse programador?')
        if(result){
            window.location.reload();
        }
      };