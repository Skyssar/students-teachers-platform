// JS CON LAS ACCIONES DEL DOCENTE

function listarLecturas ( id_profesor ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/'+id_profesor+'/lecturas',
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){

        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            html += "<tr>";
            html += "<td>" + data.id_lectura + "</td>";
            html += "<td>" + data.titulo+ "</td>";
            html += "<td style= 'max-width:400px'>" + data.contenido + "</td>";
            html += "<td>" + data.fecha + "</td>";
            html += "<td>" + data.code + "</td>";
            html += "<td>";
            html += "<a href ='index.php?controller=lecturas&accion=editar&id=" + data.id_lectura +"'class='btn btn-primary'>Detalles</a>";
            html +=  " ";
            html += "<button class = 'btn btn-danger' onclick ='deleteLectura(" + data.id_lectura +", " + id_profesor + ");'class=>Eliminar</button>";
            html += "</td>";
            html += "</tr>"
        });

        document.getElementById("datos").innerHTML = html; 
    
    }).fail(function(response){
            console.log(response);
    });

}

function obtenerLectura ( id_lectura ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura,
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        if (response != null){
            
            console.log(response);
            document.querySelector('#titulo_lectura').innerHTML = "<h4>"+ response.titulo +"</h4>";
            
        } 
        else{
                
            alert("La id solicitada no existe");
            window.location.replace("index.php");

        }
        
    }).fail(function(response){
            console.log(response);
            
    });
        
}

function editarLectura ( id_lectura ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura,
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        if (response != null){
            
            console.log(response);
            document.getElementById('titulo_lectura').value = response.titulo;
            document.getElementById('id_grado').value = response.id_grado;
            document.getElementById('contenido').innerText = response.contenido;
        } 
        else{
                
            alert("La id solicitada no existe");
            window.location.replace("index.php");
        }
        
    }).fail(function(response){
            console.log(response);
            
    });
}

function editarPregunta ( id_pregunta ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/preguntas/'+id_pregunta,
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        if (response != null){
            
            console.log(response);

            document.getElementById('numpre').value = response.numero_pregunta;
            document.getElementById('pregunta').innerText = response.pregunta;
            document.getElementById('a').value = response.respuesta_a;
            document.getElementById('b').value = response.respuesta_b;
            document.getElementById('c').value = response.respuesta_c;
            document.getElementById('d').value = response.respuesta_d;
            document.getElementById('correcta').value = response.correcta;
        } 
        else{
                
            alert("La id solicitada no existe");
            window.location.replace("index.php");
        }
        
    }).fail(function(response){
            console.log(response);
            
    });
}

function obtenerPreguntas ( id_lectura ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura+'/preguntas',
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            html += "<tr>";
            html += "<td>" + data.numero_pregunta + "</td>";
            html += "<td style= 'max-width:150px'>" + data.pregunta+ "</td>";
            html += "<td style= 'max-width:80px'>";
            html += "<a href ='index.php?controller=preguntas&accion=editar&id_lectura="+id_lectura+ "&id=" + data.id_pregunta +"'class='btn btn-primary'>Detalles</a>";
            html +=  " ";
            html += "<button class = 'btn btn-danger' onclick ='deletePregunta(" +data.id_lectura+ "," +data.id_pregunta +");'class=>Eliminar</button>";
            html += "</td>";
            html += "</tr>"
        });

        document.getElementById("datos").innerHTML = html; 
        
    }).fail(function(response){
            console.log(response);
            
    });
}


function deleteLectura ( id_lectura, id_profesor ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura,
        type: 'DELETE',
        dataType: 'json' 

    }).done(function(response){

        alert("eliminada la lectura "+ id_lectura);
        listarLecturas(id_profesor);
        
    }).fail(function(response){
            console.log(response);
            alert ("no se pudo eliminar");
            
    });
        
}

function deletePregunta ( id_lectura, id_pregunta ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura+'/preguntas/'+id_pregunta,
        type: 'DELETE',
        dataType: 'json' 

    }).done(function(response){

        console.log(response);
        alert("eliminada la pregunta "+ id_pregunta);
        obtenerPreguntas( id_lectura );
        
    }).fail(function(response){
            console.log(response);
            alert ("no se pudo eliminar");
            
    });
        
}

function obtenerNotas ( id_docente ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/notas/'+id_docente,
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            nota = parseFloat(data.nota);

            html += "<tr>";
            html += "<td>" + data.titulo + "</td>";
            html += "<td>" + data.nombres+ "</td>";
            html += "<td>" + nota.toFixed(1) + "</td>";
            html += "</tr>"
        });

        document.getElementById("datos").innerHTML = html; 
        
    }).fail(function(response){
            console.log(response);
            
    });
}




