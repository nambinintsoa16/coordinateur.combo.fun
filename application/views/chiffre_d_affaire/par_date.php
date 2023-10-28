<style>
    .aa {
        font-size: 8px;
    }
</style>
  <fieldset class="border p-0"> 
      <legend class="w-auto" style="font-size:11px"><b class="text-sm">
                 ETAT DE VENTE HEBDOMADAIRE PAR TRANCHE D'HEURE ET PAR DATE</b>
    </legend>

<form method="post" action="" class="w-100 row">
        <div class="col-md-3 w-100">
            <label class="label">dates</label>
        </div>
         
        <div class="col-md-4 col-sm-4">
              <input type="date" name="date" class="form-control">
        </div>  
        <div class="col-md-3 col-sm-3">  
              <button class="btn btn-success btn-sm">Valider</button>
        </div> 
       
    </form> 

<div class="table table-responsive col-md-12 p-0 m-0">
<table class="table table-striped table-hover table-bordered dataTables table-responsive table_previsionnel">
     <thead class="thead">
         <tr style="border-bottom: 1px white solid;">
                         <th class="bg-primary text-white"  style="font-size: 10px;">GRAND TOTAL</th>
                        <?php
                            $dts= new dateTime($dt);
                            $dt = $dts->format('Y-m'); 
                            $vente = $this->client_model->get_ca_haours("facture.date like '$dt%'"); 
                           ?>
                        <th   class="bg-primary text-white"><?= number_format($vente->vente);?></th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '07:00' AND '09:00' AND facture.date like '".$dt."%')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white">
                            
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '09:00' AND '11:00' AND facture.date like '".$dt."%')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white"><?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '11:00' AND '13:00' AND facture.date like '".$dt."%')"); 
                                  echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?></th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '13:00' AND '15:00' AND facture.date like '".$dt."%')"); 
                                  echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '15:00' AND '17:00' AND facture.date like '".$dt."%')"); 
                                   echo  $vente == "NULL" ? "0" :  number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '17:00' AND '19:00' AND facture.date like '".$dt."%')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                           <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '19:00' AND '21:00' AND facture.date like '".$dt."%')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                    </tr>       
        <tr  class="bg-primary text-white">
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">Date</th>
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">TOTAL</th> 	
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">[07:00 - 09:00]</th> 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]09:00 - 11:00]</th> 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]11:00 - 13:00]</th> 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]13:00 - 15:00]</th> 	 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]15:00 - 17:00]</th> 	
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]17:00 - 19:00]	</th> 	 	
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]19:00 - 21:00]	</th> 	 					
     </tr>
     </thead>
     <tbody>

        <?php  
           $this->load->model('client_model');
        foreach ($date as $key => $dates):

            ?>
            <tr>
            <th><a href="#" class="date"><?php 
            $date =$dates->format('Y-m-d');
                   echo $date;
              ?></a></th>
            <th><a href="#" class="detail_ca"><?php 
               $data = $this->client_model->get_ca_haours("facture.date ='".$date."'"); 
                echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></a></th>  
           <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '07:00' AND '09:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '09:00' AND '11:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '11:00' AND '13:00' AND facture.date ='".$date."')"); 
              echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '13:00' AND '15:00' AND facture.date ='".$date."')"); 
              echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
            <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '15:00' AND '17:00' AND facture.date ='".$date."')"); 
              echo  $data == "NULL" ? "0" :  number_format($data->vente);
           ?></th>
              <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '17:00' AND '19:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '19:00' AND '21:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
                       
     </tr>
        <?php endforeach;?>
     </tbody>
</table>
</div>
 </fieldset>
 <div class="modal" tabindex="-1" role="dialog" id="modal_detail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="data_content">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

