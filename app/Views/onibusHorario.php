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
                                    <?php $timestamp = strtotime($results->manha) + 60*30; ?>
                                    <?php $dataHora = strftime('%H:%M:%S', $timestamp); ?>
                                    <td style="text-align: center;"><?php echo $dataHora?></td>
                                <?php else : ?>
                                    <?php $dataHora = strtotime($dataHora) + 60*30; ?>
                                    <?php $dataHora = strftime('%H:%M:%S', $dataHora); ?>
                                    <td style="text-align: center;"><?php echo $dataHora?></td>
                                <?php endif?>
                                <?php if($contador > 1):?>
                                    <?php if($contador == 7):?>
                                        <?php $timestamp = strtotime($results->tarde) + 60*30; ?>
                                        <?php $dataHoraTarde = strftime('%H:%M:%S', $timestamp); ?>
                                        <td style="text-align: center;"><?php echo $dataHoraTarde?></td>
                                    <?php else : ?>
                                        <?php $dataHoraTarde = strtotime($dataHoraTarde) + 60*30; ?>
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



