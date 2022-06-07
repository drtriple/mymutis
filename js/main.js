document.getElementById("docente").style.display = "none";
function roles(){

    var rol =  document.getElementById("rol").value;
    
    if(rol==2 || rol==4 || rol==5){
        document.getElementById("estudiante").style.display = "none";
        document.getElementById("docente").style.display = "none";
        document.getElementById("tipoDoc").value = "3";
        document.getElementById("tipoDoc").disabled;
    }
    if(rol==1){
        document.getElementById("docente").style.display = "none";
        document.getElementById("estudiante").style.display = "block";
        
    }
    if(rol==3){
        document.getElementById("estudiante").style.display = "none";
        document.getElementById("tipoDoc").value = "3";
        document.getElementById("tipoDoc").disabled;
        document.getElementById("docente").style.display = "block";
    }
               
}

function directorGrupo(){

    var gg =  document.getElementById("gxgDocente").value;
    
    if(gg == 1 || gg == 2){
        document.getElementById("ocultarGG1").style.display = "none";
        document.getElementById("ocultarGG2").style.display = "none";
    }
    else{
        document.getElementById("ocultarGG1").style.display = "block";
        document.getElementById("ocultarGG2").style.display = "block";
    }
               
}
