<div class="retangulo">
    <table class="tabela">
        <tr class="trTable">
           <td style="text-align: center;">Manhã</td>
            <td style="text-align: center;">Tarde</td>
            <?php foreach ($result as $results):?>
                <?php if($results):?>
                    <?php $contador = 7;?>
                    <?php if($contador == 7):?>
                        <tr>
                            <td style="text-align: center;"><?php echo $results->manha?></td>
                            <td style="text-align: center;"><?php echo $results->tarde?></td>
                        </tr>
                    <?php endif?>
                    <?php while($contador > 0):?>
                        <tr>
                                <?php $aux=1;?>
                                <?php if($contador == 7):?>
                                    <?php 
                                        $tempo = strtotime($results->tempo); 
                                        $horasLinha =  strftime('%H', $tempo);
                                        $minutosLinha =  strftime('%M', $tempo);
                                        $segundosLinha =  strftime('%S', $tempo);
                                        if($horasLinha > 0){
                                            $horasLinha = $horasLinha * 60;
                                        }
                                        if($segundosLinha > 0){
                                            $segundosLinha = $segundosLinha / 60;
                                        }
                                        $tempo = $minutosLinha + $horasLinha + $segundosLinha;
                                    ?>
                                    <?php $timestamp = strtotime($results->manha) + 60*$tempo; ?>
                                    <?php $dataHora = strftime('%H:%M:%S', $timestamp); ?>
                                    <td style="text-align: center;"><?php echo $dataHora?></td>
                                <?php else : ?>
                                    <?php $dataHora = strtotime($dataHora) + 60*$tempo; ?>
                                    <?php $dataHora = strftime('%H:%M:%S', $dataHora); ?>
                                    <td style="text-align: center;"><?php echo $dataHora?></td>
                                <?php endif?>
                                <?php if($contador > 1):?>
                                    <?php if($contador == 7):?>
                                        <?php $timestamp = strtotime($results->tarde) + 60*$tempo; ?>
                                        <?php $dataHoraTarde = strftime('%H:%M:%S', $timestamp); ?>
                                        <td style="text-align: center;"><?php echo $dataHoraTarde?></td>
                                    <?php else : ?>
                                        <?php $dataHoraTarde = strtotime($dataHoraTarde) + 60*$tempo; ?>
                                        <?php $dataHoraTarde = strftime('%H:%M:%S', $dataHoraTarde); ?>
                                        <td style="text-align: center;"><?php echo $dataHoraTarde?></td>
                                    <?php endif?>
                                <?php endif?>

                        </tr>
                        <?php $contador--;?>
                    <?php endwhile;?>
                        
                <?php else : ?>

                <?php endif?>
            <?php endforeach ?>
            
       </tr>
   </table>
</div>



