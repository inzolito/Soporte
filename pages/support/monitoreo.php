<?php
require_once("../../build/controller/controller-functions.php");
require_once("../../build/controller/controller-faena.php");

$system = new systemClass();
$fenaCl = new faena();

$system->validarSesion();
$conn = $system->conectaDB();
$id_faena = $_REQUEST["id"];


//Falta validar cuando no existe la faena
$faenaDatos = $fenaCl->datos($id_faena);
$estadoCheckFaena = $fenaCl->estado($id_faena);
$checkDatos = $fenaCl->datosCheck($id_faena);



?>


<script>
    titulo(" Monitoreo <?php echo $faenaDatos->faena ?> <button class='btn btn-primary' onclick='cargaMonitoreo(<?php echo $id_faena ?>)'><i class='fas fa-sync-alt'></i></button>", "monitoreo");
</script>


<div class="row">

    <div class="col-md-4">
        <!-- Servidor 1 y 2  .... Server primario-->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Servidor primario</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <p class="text-sm  ">Nom. Server
                            <b class="d-block">mlccjig011 </b>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-sm  ">JAMSCluster
                            <b class="d-block"><i class="fa-solid fa-check"></i> mlccjig022 </b>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-sm  ">IP
                            <b class="d-block">10.16.42.240 </b>
                        </p>
                    </div>


                </div>


                <div class="row">
                    <div class="col-md-3">
                        <input type="text" value="85" class="GraficoAzul" data-width="150" data-height="150" data-fgcolor="#3c8dbc" data-readonly="true">
                        <div class="text-center">Disco Duro</div>
                    </div>
                    <div class="col-md-3">
                        <input type="text" value="85" class="GraficoRojo" data-width="150" data-height="150" data-fgcolor="#gtgtgt" data-readonly="true">
                        <div class="text-center">Memoria Ram</div>
                    </div>
                    <div class="col-md-6">
                        <canvas id="cpuServer1"></canvas>
                        <div class="text-center">CPU - Load Average</div>
                    </div>
                </div>


                
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Servidor secundario</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <p class="text-sm  ">Nom. Server
                            <b class="d-block">mlccjig022 </b>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-sm  ">JAMSCluster
                            <b class="d-block"><i class="fa-solid fa-check"></i> mlccjig011 </b>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-sm  ">IP
                            <b class="d-block">10.16.42.241 </b>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-sm  ">status
                            <b class="d-block">Standby </b>
                        </p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" value="63" class="GraficoAzul text-center" data-width="150" data-height="150" data-fgcolor="#3c8dbc" data-readonly="true">
                        <div class="text-center">Disco Duro</div>
                    </div>

                    <div class="col-md-3">
                        <input type="text" value="85" class="GraficoRojo" data-width="150" data-height="150" data-fgcolor="#gtgtgt" data-readonly="true">
                        <div class="text-center">Memoria Ram</div>
                    </div>

                    <div class="col-md-6">
                        <canvas id="cpuServer2"></canvas>
                        <div class="text-center">CPU - Load Average</div>
                    </div>
                </div>
            </div>


        </div>

    </div>


    <!-- Comparación dos server -->
    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Comparación</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Server 1</th>
                                <th>Server 2</th>
                                <th>Diff</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Disco</td>
                                <td>285 GB</td>
                                <td>478 GB</td>
                                <td><span class="badge bg-danger">193 GB</span></td>
                            </tr>
                            <tr>
                                <td>shift_loads</td>
                                <td>2.236.659</td>
                                <td>2.236.654</td>
                                <td><span class="badge bg-success">5</span></td>
                            </tr>
                            <tr>
                                <td>sift_dumps</td>
                                <td> 2.267.141</td>
                                <td> 2.267.135</td>
                                <td><span class="badge bg-success">6</span></td>
                            </tr>
                            <tr>
                                <td>shift_states</td>
                                <td>3.507.417</td>
                                <td>3.507.390</td>
                                <td><span class="badge bg-warning">27</span></td>
                            </tr>
                            <tr>
                                <td>shift_hauls</td>
                                <td>4.486.054</td>
                                <td>4.486.050</td>
                                <td><span class="badge bg-success">4</span></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>


        </div>

    </div>

</div>





<!-- Sumarizador , backup , Logs -->
<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Sumarizador</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">


                <div class="row">
                    <div class="col-md-4">
                        <p class="text-sm  ">Fecha sumarizando
                            <b class="d-block">14-01-2023 15:02 </b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm  ">Corriendo como :
                            <b class="d-block">Servicio</b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm  ">Corriendo Desde :
                            <b class="d-block"><i class="fa-regular fa-clock"></i> 01-01-2023</b>
                        </p>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="container-fluid bg-dark text-white p-3" style="border-radius: 5px;">
                            <b>month_material_loads</b> at 2023-01-01 08:00:00: 0 inserts, 2 updates, 0 deletes<br>
                            <b>month_shovel_idle</b> at 2023-01-01 08:00:00: 0 inserts, 4 updates, 0 deletes<br>
                            <b>month_shovel_loads</b> at 2023-01-01 08:00:00: 0 inserts, 2 updates, 0 deletes<br>
                            <b>Processing 85 summaries with interval 300 seconds.</b><br>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Backup</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">


                <div class="row">
                    <div class="col-md-4">
                        <p class="text-sm  ">Fecha loaded
                            <b class="d-block">14-01-2023 15:21 </b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm  ">Corriendo como :
                            <b class="d-block">Servicio</b>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm  ">último daily :
                            <b class="d-block"><i class="fa-regular fa-clock"></i> 4.4G - 01:33 jmineops-2023-01-14.tgz</b>
                        </p>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="container-fluid bg-dark text-white p-3" style="border-radius: 5px;">
                            loaded 0 rows in weighing<br>
                            loaded 0 rows in worker_qualifications<br>
                            loaded 0 rows in worker_vacations<br>
                            loaded 0 rows in workers<br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Procesos</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                <!-- Importadores -->

                <div class="row">
                    <div class="col-md-12">
                        <b class="d-block">Importadores </b>
                        <div class="container-fluid bg-dark text-white p-3" style="border-radius: 5px;">
                            jigsaw 33577 0.0 0.0 14224 968 pts/10 S+ 16:16 0:00 grep --color=auto impo
                        </div>
                    </div>
                </div>


                <!-- SqlServer -->

                <div class="row">
                    <div class="col-md-12">
                        <b class="d-block">SqlServer </b>

                        <div class="container-fluid bg-dark text-white p-3" style="border-radius: 5px;">
                            jigsaw 33621 0.0 0.0 14224 956 pts/10 S+ 16:17 0:00 grep --color=auto sqlserver </div>
                    </div>
                </div>



                <!-- sql_back -->

                <div class="row">
                    <div class="col-md-12">
                        <b class="d-block">sql_back </b>

                        <div class="container-fluid bg-dark text-white p-3" style="border-radius: 5px;">
                            jigsaw 33587 0.0 0.0 14224 1024 pts/10 S+ 16:16 0:00 grep --color=auto sql_back
                        </div>
                    </div>




                    <!-- Summarizador -->
                    <div class="row">
                        <div class="col-md-12">
                            <b class="d-block">Summarizador </b>

                            <div class="container-fluid bg-dark text-white p-3" style="border-radius: 5px;">
                                jigsaw 28594 0.0 0.0 148968 23888 ? SNl Jan04 3:40 /opt/local/bin/ruby /opt/Jigsaw/Services/JAMSSummarizer start -log summarizer,summarizer/debug,summarizer/debug/extra
                                jigsaw 28601 5.6 9.6 3711092 3159624 ? SNl Jan04 804:35 /opt/Jigsaw/Tools/Summarizer -log summarizer,summarizer/debug,summarizer/debug/extra -config /opt/Jigsaw/Services/config.jams -runAsService
                                jigsaw 33739 0.0 0.0 14224 960 pts/10 S+ 16:17 0:00 grep --color=auto Summ </div>
                        </div>



                    </div>
                </div>
            </div>


        </div>









        <script>
            // ---------------- GRAFICOS ---------------
            $('.GraficoAzul').knob({
                readOnly: true,
                rotation: 'anticlockwise',
                thickness: '.3',
                width: 90,
                height: 90,
                fgColor: '#3c8dbc'
            });
            $('.GraficoVerde').knob({
                readOnly: true,
                rotation: 'anticlockwise',
                thickness: '.3',
                width: 90,
                height: 90,
                fgColor: 'verde'
            });
            $('.GraficoRojo').knob({
                readOnly: true,
                rotation: 'anticlockwise',
                thickness: '.3',
                width: 90,
                height: 90,
                fgColor: 'red'
            });



            var ctx = document.getElementById("cpuServer1").getContext("2d");
            var ctx2 = document.getElementById("cpuServer2").getContext("2d");

            var dataS1 = {
                labels: ["7''", "6''", "5''", "4''", "3''", "2''", "1''"],
                datasets: [{
                    label: "Ventas",
                    backgroundColor: "rgba(60,141,188,0.9)",
                    borderColor: "rgba(60,141,188,0.8)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [1.2, 1.4, 1.3, 1.7, 1.4, 1.5, 1.46]
                }]
            };
            var dataS2 = {
                labels: ["7''", "6''", "5''", "4''", "3''", "2''", "1''"],
                datasets: [{
                    label: "Ventas",
                    backgroundColor: "rgba(60,141,188,0.9)",
                    borderColor: "rgba(60,141,188,0.8)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [0.4, 0.3, 0.4, 0.6, 0.5, 0.4, 0.5]
                }]
            };
            var myChart = new Chart(ctx, {
                type: "line",
                data: dataS1,
                options: {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            });

            var myChart2 = new Chart(ctx2, {
                type: "line",
                data: dataS2,
                options: {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            });
        </script>