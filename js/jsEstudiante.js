function listarLecturasGrado ( id_grado ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/'+id_grado+'/actividades',
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){

        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            if ( data.nota == null ){

            html += "<tr>";
            html += "<td>" + data.titulo + "</td>";
            html += "<td>" + data.fecha+ "</td>";
            html += "<td>" + data.nombres + "</td>";
            html += "<td>";
            html += "<a href ='index.php?controller=actividades&accion=realizar&id=" + data.id_lectura +"'class='btn btn-primary'>Realizar</a>";
            html += "</td>";
            html += "</tr>"

            }
        });

        document.getElementById("datos").innerHTML = html; 
    
    }).fail(function(response){
            console.log(response);
    });

}

function listarNotasEstudiante ( id_estudiante ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/notas_estudiante/'+id_estudiante,
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){

        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            nota = parseFloat(data.nota);

            html += "<tr>";
            html += "<td>" + data.titulo + "</td>";
            html += "<td>" + data.fecha+ "</td>";
            html += "<td>" + data.nombres + "</td>";
            html += "<td><b>" + nota.toFixed(1) + "</b></td>";
            html += "<td>";
            html += "<a href ='index.php?controller=actividades&accion=respuestas&id=" + data.id_lectura +"'class='btn btn-primary'>Revisión</a>";
            html += "</td>";
            html += "</tr>"

        });

        document.getElementById("datos").innerHTML = html; 
    
    }).fail(function(response){
            console.log(response);
    });

}


function obtenerLecturaEstudiante( id_lectura ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura,
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        if (response != null){
            
            console.log(response);
            document.querySelector('#titulo_lectura').innerHTML = "<h4>"+ response.titulo +"</h4>";
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

function obtenerPreguntas ( id_lectura ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura+'/preguntas',
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            html += "<label>"+data.numero_pregunta+". "+data.pregunta+"</label><br>";
            html += "<input type='radio' id='a' name="+data.numero_pregunta+" value='a' required>";
            html += "<label for='a'> &nbsp a. "+data['respuesta_a']+"</label><br>";
            html += "<input type='radio' id='b' name="+data.numero_pregunta+" value='b' required>";
            html += "<label for='b'> &nbsp b. "+data.respuesta_b+"</label><br>";
            html += "<input type='radio' id='c' name="+data.numero_pregunta+" value='c' required>";
            html += "<label for='c'> &nbsp c. "+data.respuesta_c+"</label><br>";
            html += "<input type='radio' id='d' name="+data.numero_pregunta+" value='d' required>";
            html += "<label for='d'> &nbsp d. "+data.respuesta_d+"</label><br>";
            html += "<hr class='my-4'>"

        });

        document.getElementById("datos").innerHTML = html; 

        
    }).fail(function(response){
            console.log(response);
            
    });
}


function obtenerResultados ( id_lectura, id_estudiante ){

    $.ajax({

        url: 'http://localhost/projects/projectfinal/api/lecturas/'+id_lectura+'/estudiante/'+id_estudiante+'/respuestas',
        type: 'GET',
        dataType: 'json' 

    }).done(function(response){
        
        console.log(response);
        var html = "";

        $.each(response, function (index, data){

            html += "<label>"+data.numero_pregunta+". "+data.pregunta+"</label>";
            html += "<br>"

            if (data.respuesta == 'a'){
                html += "<input type='radio' id='a' name="+data.numero_pregunta+" value='a' checked disabled>";
                html += "<label for='a'> &nbsp a. "+data.respuesta_a+"</label><br>";
            }
            if (data.respuesta == 'b'){
                html += "<input type='radio' id='b' name="+data.numero_pregunta+" value='b' checked disabled>";
                html += "<label for='b'> &nbsp b. "+data.respuesta_b+"</label><br>";
            }
            if (data.respuesta == 'c'){
                html += "<input type='radio' id='c' name="+data.numero_pregunta+" value='c' checked disabled>";
                html += "<label for='c'> &nbsp c. "+data.respuesta_c+"</label><br>";
            }
            if (data.respuesta == 'd'){
                html += "<input type='radio' id='d' name="+data.numero_pregunta+" value='d' checked disabled>";
                html += "<label for='d'> &nbsp d. "+data.respuesta_d+"</label><br>";
            }

            
            if (data.status == 0){
                html += "<label class = 'text-danger'>&nbsp INCORRECTA </label>";
            } else
            if(data.status == 1) {
                html += "<label class = 'text-success'>&nbsp CORRECTA </label>";
            }
        
                html += "<hr class='my-4'>"

        });

        document.getElementById("datos").innerHTML = html; 

        
    }).fail(function(response){
            console.log(response);
            
    });
}


