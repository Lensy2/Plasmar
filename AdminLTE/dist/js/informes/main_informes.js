$(function () {               
  $("#ver-admin").click(function() {
    var a = $(".val-admin").val();
    window.location = "http://"+a+"/apps/administracion/dashboard.php";
    });
  
  $("#ver-infor").click(function() {
    var a = $(".val-infor").val();
    window.location = "http://"+a+"/apps/informes/dashboard.php";
    });
                       
   $("#gen").on("click", function(event) {
        event.preventDefault();
        var txtInicial = $('.txtInicial').val();
        var txtFinal = $('.txtFinal').val();
    var dataString = 'inicial='+txtInicial+'&final='+txtFinal;
        $.ajax({
            dataType: "json",
            type: "GET",
            url: "data_dispo_final.php",
            data: dataString,
            success: function(data) {
                  $( "#grafico" ).show( "slow", function() {
                        alert( "Informe Generado." );
                    });

                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {

                    type: 'bar',
                    data: {
                        labels: ["Concesión", "Re-proceso", "Desechar"],
                        datasets: [{
                            label: 'Destino Final',
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [data.total_concesion,data.total_reproceso,data.total_desechar]
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
        });
    }); 

   $("#gen2").on("click", function(event) {
        event.preventDefault();
        var txtInicial = $('.txtInicial').val();
        var txtFinal = $('.txtFinal').val();
    var dataString = 'inicial='+txtInicial+'&final='+txtFinal;
        $.ajax({
            dataType: "json",
            type: "GET",
            url: "data_procesos.php",
            data: dataString,
            success: function(data) {
                $( "#grafico" ).show( "slow", function() {
                        alert( "Informe Generado." );
                    });

                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {

                    type: 'bar',
                    data: {
                        labels: ["Extruder", "Impresión", "Laminación","Refilado","Sellado","Calidad","Desarrollo","Elaboración Orden","Enfuellado","Fotopolimero","Mantenimiento","Maquina","Premontaje","Proceso","Producción","Proveedor"],
                        datasets: [{
                            label: 'Procesos - SubProcesos',
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [data.ext_total,data.imp_total,data.lam_total, data.ref_total , data.sell_total, data.calidad_total , data.desarrollo_total ,data.elab_orden_total ,data.enfuellado_total ,data.fotopolimero_total ,data.mantenimiento_total,data.maquina_total,data.premontaje_total,data.proceso_total,data.produccion_total,data.proveedor_total]
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
        });
    });


});