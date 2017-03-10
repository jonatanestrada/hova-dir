<!-- Modal -->
  <div class="modal fade" id="modalSubordinados" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">A su cargo</h4>
		  <h5 class="modal-title">{{jefeSubordinados.nombre_empleado}} ( {{jefeSubordinados.nombre}} )</h5>
        </div>
        <div class="modal-body">
		          <div >
					<?php include_once '../views/directorio/puestos/table_subordinados.php'; ?>
				  </div>
        
      </div>
      
    </div>
  </div>
  
</div>