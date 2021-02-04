<?php if($personalinterno != null):?>
<div class="text-right"><b>Fecha: </b><?=date("d/m/Y");?></div>
<br>
<h2 class="text-center">Listado de Personal de Guardia</h2>
<div class="">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Personal</th>
                <th>Departamento</th>
                <th>Actividad</th>
                <th>F. Salida</th>
                <th>F. Retorno</th>
                <th>Tipo Guardia</th>
                <th>Sexo</th>
                <th>Alojamiento</th>
                <th>Status</th>
            </tr>
        </thead>
            <tbody>
                <?php
                    $conteo = 0;
                    foreach($personalinterno as $data):
                ?>
                    <tr>
                        <td><?=$data->getpers()->nombcompleto;?></td>
                        <td><?=$data->getdepart()->nombdepart;?></td>
                        <td><?=$data->actividad;?></td>
                        <td><?=$data->fsalida;?></td>
                        <td><?=$data->fretorno;?></td>
                        <td><?=$data->tippers;?></td>
                        <td><?=$data->getpers()->sexo == 'M' ? 'Hombre' : 'Mujer';?></td>
                        <td><?=$data->gethosp()['alojamiento'] == null ? 'SIN ASIGNAR' : $data->gethosp()['alojamiento'];?></td>
                        <td><?=$data->status == true ? 'Aceptado' : 'No aceptado';?></td>
                    </tr>
                <?php
                    $conteo+=$conteo;
                    endforeach;
                ?>
                <tr><td colspan="9" class="text-center">Total de personal:<?=$conteo ?></td></tr>
            </tbody>
    </table>
    <?php if ($personalexterno !== []){?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invitado</th>
                    <th>Ente</th>
                    <th>Actividad</th>
                    <th>F. Salida</th>
                    <th>F. Retorno</th>
                    <th>Tipo de Pers</th>
                    <th>Sexo</th>
                    <th>Alojamiento</th>
                    <th>Status</th>
                </tr>
            </thead>
                <tbody>
                    <?php
                        $conteope=0;
                        foreach($personalexterno as $data):
                    ?>
                        <tr>
                            <td><?=$data->nombcompleto;?></td>
                            <td><?=$data->ente;?></td>
                            <td><?=$data->actividad;?></td>
                            <td><?=$data->fsalida;?></td>
                            <td><?=$data->fretorno;?></td>
                            <td><?=$data->tippers;?></td>
                            <td><?=$data->sexo == 'M' ? 'Hombre' : 'Mujer';?></td>
                            <td><?=$data->gethosp()['alojamiento'] == null ? 'SIN ASIGNAR' : $data->gethosp()['alojamiento'];?></td>
                            <td><?=$data->status == true ? 'Aceptado' : 'No aceptado';?></td>
                        </tr>
                    <?php
                        $conteope+=$conteope;
                        endforeach;
                    ?>
                    <tr><td colspan="9" class="text-center">Total de personal:<?=$conteope ?></td></tr>
                </tbody>
        </table>
    <?php } ?>
</div>
<?php endif;?>
