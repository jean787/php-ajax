$(document).ready(function (){

    let editar = false;

    listar();

    $("#search").keyup(function (){
        let nombre = $("#search").val();

        if(nombre){

            let formData = new FormData();
            formData.append("nombre",nombre);

            $.ajax({
                url:"tarea.search.ajax.php",
                method: "POST",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta){

                    let template= "";
                    respuesta.forEach( (element)=> {
                        template += `<li> ${element.nombre} </li>`;
                    })

                    $("#container").html(template);
                }
            });
        }else{
            $("#container").html("");
        }
    });

    $(document).on("click","#btn-save",function (){

        let formData = new FormData();
        formData.append('nombre',$("#name").val());
        formData.append('descripcion',$("#description").val());
        formData.append("id",$("#taskId").val());

        let url = editar ? "tarea.edit.ajax.php" : "tarea.add.ajax.php" ;


        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta){
                listar();
                // limpia todo el formulario que se encuentra dentro
                $("#task-form").trigger('reset');

                console.log(respuesta);
            }
        })
    });

    $(document).on("click",".task-item",function (){
        const elemnent = $(this)[0].parentElement.parentElement;
        const id = $(elemnent).attr("idTarea");

        editar = true;

        $.post("tarea.byid.ajax.php", {id}, function (response){
            let jsonRes = JSON.parse(response);
            $("#name").val(jsonRes.nombre);
            $("#description").val(jsonRes.descripcion);
            $("#taskId").val(jsonRes.id);

        });
    });

    $(document).on("click",".task-delete",function (){
        if (confirm("Esta seguro de querer eliminarlo")) {
            const elemnent = $(this)[0].parentElement.parentElement;
            const id = $(elemnent).attr("idTarea");

            $.post("tarea.delete.ajax.php", {id}, function (response) {
                console.log(response);
                listar();
            });
        }
    });


});




function listar(){

    $.ajax({
        url:"tarea.list.ajax.php",
        method: "GET",
        dataType: "json",
        success: function (respuesta){

            let template = "";
            respuesta.forEach( (element)=>{
                template += `<tr idTarea=${element.id}>
                                    <td>${element.id}</td>
                                    <td><a class="task-item">${element.nombre}</a></td>
                                    <td>${element.descripcion}</td>
                                    <td> <button class="task-delete btn btn-danger">Eliminar</button> </td>
                                </tr>`;
            })

            $("#tasks").html(template);
        }
    })

}

