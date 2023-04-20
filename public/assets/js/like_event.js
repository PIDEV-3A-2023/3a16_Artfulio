
//on cree une fonction pour gérer le click sur nos lien
function onClickBtnLike(event){
    //on annule le caractere par défaut qui est d'aller sur une autre page
    event.preventDefault();

    //on recupere le lien ou on a cliqué
    const url = this.href;

    //on recupere le nombre de jaime
    const spanCount = this.querySelector('span.js-likes');
    const icone = this.querySelector('i');

    //on entre ici si le user est connecté
    //on le passe a axios une APi pour faire du ajax
    axios.get(url).then(function (response){
        //on met a jour le nombre de jaime
        spanCount.textContent = response.data.likes;

        //on change d'icone en cas de click
        if(icone.classList.contains('fa-solid')){
            icone.classList.replace('fa-solid','fa-regular');
        }else{
            icone.classList.replace('fa-regular','fa-solid');
        }
    }).catch(function(error){
        //on entre ici si on est pas connecté
        if(error.response.status === 403) {
            window.alert("vous ne pouvez pas liker un évenement si vous n'etes pas connecté! ");
        }else{
            //si il y'a un probleme avec le lien
            window.alert("une érreur c'est produite veuillez réessayer plus tard! ");
        }
    })

}


//on selectionne tout les a.js-like de la page
document.querySelectorAll('a.js-like').forEach(function(link){
    //on parcour tout ce de type link
    link.addEventListener('click', onClickBtnLike)
})