function estAlphabetique(chaine) {
    // Utiliser une expression régulière pour vérifier les lettres et espaces
    const regex = /^[a-zA-Z\s]+$/;
    return regex.test(chaine);
}
function estNumerique(chaine) {
    // Utiliser une expression régulière pour vérifier uniquement les chiffres
    const regex = /^[0-9]+$/;
    return regex.test(chaine);
}
function estNumeriqueAlphabetique(chaine) {
    // Utiliser une expression régulière pour vérifier les lettres, chiffres et espaces
    const regex = /^[a-zA-Z0-9\s]+$/;
    return regex.test(chaine);
}
function verif1(){
    tel=f.tel.value
    email=f.email.value
    pass=f.pass.value
    
    nom=f.nom.value
    pre=f.pre.value
    gen=f.check1
    date=f.date.value
    add=f.add.value
    add2=f.add2.value
    stat=f.stat.selectedIndex
    zip=f.zip.value
    type=f.check2
    ver=f.check3
    if(tel=="" || tel.length!=8 || estNumerique(tel)==false){
        alert("verfie votre telephone ! ")
        return false
    }
    if(email==""|| email.indexOf('@')==-1 || email.indexOf('.')==-1){
        alert("verfie votre email ! ");
        return false
    }
    if(pass=="" || pass.length!=8 || estNumeriqueAlphabetique(pass)==false){
        alert("verfie votre password ! ")
        return false
    }
    if(nom=="" || nom.length<2 || estAlphabetique(nom)==false){
        alert("verfie votre nom ! ")
        return false
    }
    if(pre=="" || pre.length<2 || estAlphabetique(pre)==false){
        alert("verfie votre prenom ! ")
        return false
    }
    if(!gen[0].checked && !gen[1].checked){
        alert("verfie votre gender ! ")
        return false
    }
    if(date==""){
        alert("verfie votre date de naissance ! ")
        return false
    }
    if(add=="" || add.length<7){
        alert("verfie votre address 1 !")
        return false
    }
    if(add2=="" || add2.length<7 ){
        alert("verfie votre address 2 !")
        return false
    }
    if(stat==0){
        alert("verfie votre state ! ")
        return false
    }
    if(zip=="" || estNumerique(zip)==false){
        alert("verfie votre zip ! ")
        return false
    }
    if(!type[0].checked && !type[1].checked){
        alert("verfie qui un pharmacien ou pasient  ! ")
        return false
    }
    nomphar=f.nomphar.value;
    if(type[0].checked && nomphar==""){
        alert("verfie votre nom de pharmacie");
        return false
    }
    if(!ver[0].checked){
        alert("verfie votre check me out ! ")
        return false
    }
    return true
}
function verif2(){
    tel=f.tel.value;
    pass=f.pass.value;
    rol=f.rol;
    if(tel==""||estNumerique(tel)==false||tel.length!=8){
        alert("verfie votre némero de téléphone ! ");
        return false;
    }
    if(pass=="" || pass.length!=8 || estNumeriqueAlphabetique(pass)==false){
        alert("verfie votre password ! ")
        return false
    }
    if(!rol[0].checked && !rol[1].checked){
        alert("verfie qui un pharmacien ou pasient  ! ")
        return false;
    }

}
