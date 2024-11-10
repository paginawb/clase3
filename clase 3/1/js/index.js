$(document).ready(function() {
    cargarEstados();

    function cargarEstados() {
        $.ajax({
            url: "crud/estados.php",
            type: "POST",
            data: { 'lista': 'todos' },
            dataType: "json",
            success: function(estados) {
                $("#estados").empty().append("<option value=''>Seleccione una opción</option>");
                $.each(estados, function(i, estado) {
                    $("#estados").append("<option value='" + estado.idestado + "'>" + estado.nombre + "</option>");
                });
            },
            error: function() {
                alert("Error en la petición AJAX");
            }
        });
    }

    $("#agregar").click(function() {
        var nombreEstado = $("#estado").val();
        if (!nombreEstado) {
            alert("Por favor, ingrese el nombre del estado.");
            return;
        }
        $.ajax({
            url: "crud/estados.php",
            type: "POST",
            data: { 'ADD': 'estado', 'nombre': nombreEstado },
            dataType: "json",
            success: function(data) {
                alert(data.estado);
                $("#estado").val("");
                cargarEstados();
            },
            error: function() {
                alert("Error en la petición AJAX");
            }
        });
    });

    $("#eliminar").click(function() {
        var nombreEliminar = $("#estadoEliminar").val();
        if (!nombreEliminar) {
            alert("Por favor, ingrese el nombre del estado a eliminar.");
            return;
        }
        $.ajax({
            url: "crud/estados.php",
            type: "POST",
            data: { 'DELETE': 'estado', 'nombre': nombreEliminar },
            dataType: "json",
            success: function(data) {
                alert(data.estado);
                $("#estadoEliminar").val("");
                cargarEstados();
            },
            error: function() {
                alert("Error en la petición AJAX");
            }
        });
    });

    $("#Actualizar").click(function() {
        var idEstado = $("#estados").val();
        var nombreEstado = $("#estadoActualizar").val();
        if (!idEstado || !nombreEstado) {
            alert("Seleccione un estado y proporcione un nuevo nombre.");
            return;
        }
        $.ajax({
            url: "crud/estados.php",
            type: "POST",
            data: { 'UPDATE': 'estado', 'idEstado': idEstado, 'nombre': nombreEstado },
            dataType: "json",
            success: function(data) {
                alert(data.estado);
                $("#estadoActualizar").val("");
                cargarEstados();
            },
            error: function() {
                alert("Error en la petición AJAX");
            }
        });
    });

    $("#btAgregar").click(function() {
        $("#divAgregar").toggle();
    });

    $("#btEliminar").click(function() {
        $("#divEliminar").toggle();
    });

    $("#btActualizar").click(function() {
        $("#divActualizar").toggle();
        $("#estadoActualizar").val($("#estados option:selected").text());
    });
});
