<?php
require_once("../../build/controller/controller-functions.php");
require_once("../../build/controller/controller-faena.php");

$system=new systemClass();
$system->validarSesion(); 
$conn=$system->conectaDB();
$faenaCl=new faena();

$firstday = date('Y-m-d', strtotime("this week"));
$lastday = date("Y-m-d",strtotime($firstday."+ 6 days"));



?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa-solid fa-shovel"></i>Faenas</h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Faena</th>
                    <th>Fecha ultimo check</th>
                    <th>Esta semana</th>
                    <th >progreso</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $faenasSql=$conn->query("select * from faenas order by faena asc");
                
                while($faenaDatos=$faenasSql->fetch_assoc())
                {
                    $faenaCheckDatos=$faenaCl->datosCheck($faenaDatos["id"]);
                    $fechaCheck="-";
                    $estaSemanaCheck="-";
                    if(isset($faenaCheckDatos->fecha)) $fechaCheck= $faenaCheckDatos->fecha;
                    if($fechaCheck!="-") $fechaCheck=$system->formatoFecha($fechaCheck,"vista");
                    
                    // $datosCheckFaenaEstaSemana=$faenaCl->datosCheck($faenaDatos["id"],$firstday,$lastday);
                    
                    if(isset($faenaCheckDatos->fecha))
                    {
                        if($faenaCheckDatos->fecha <=$firstday )
                        {
                        
                        }else{
                            if($faenaCheckDatos->estado=="finalizado")
                            {
                                $estaSemanaCheck='<p class="text-success"><i class="fa-solid fa-check"></i> Finalizado</p>';

                            }else{
                                $estaSemanaCheck= '<p class="text-warning"><i class="fa-solid fa-clock"></i> En proceso</p>';
                                
                            }
                            
                        }
                    }
                    echo "   
                        <tr>
                            <td>".$faenaDatos["id"]."</td>
                            <td>".$faenaDatos["faena"]." (".$faenaDatos["alias"].")</td>
                            <td>".$fechaCheck."</td>
                            <td>".$estaSemanaCheck."</td>
                            <td >
                                        <button 
                                            type='button' 
                                            onclick ='cargaMonitoreo(".$faenaDatos["id"].")' 
                                            id='btn-".$faenaDatos["id"]."' 
                                            style='min-width:95px;'
                                            class='btn btn-sm d-inline-block bg-gradient-info mb-1'>
                                            <i class='fa-regular fa-play'></i> Monitoreo
                                        </button>
                            
                                        <button 
                                            type='button' 
                                            onclick ='cargaFaena(".$faenaDatos["id"].")' 
                                            id='btn-".$faenaDatos["id"]."' 
                                            style='min-width:95px;'
                                            class='btn btn-sm  d-inline-block bg-gradient-info mb-1'>
                                            <i class='fa-solid fa-pen-to-square'></i> check
                                        </button>
                             
                                
                            </td>
                        </tr>
                        ";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>



<script>
function cargaMonitoreo(id){
        $("#div-container").load("pages/support/monitoreo.php?id="+id);
        titulo("","faena");

    }
</script>