<!-- Modal -->
  <div class="modal fade" id="modalAltaPortal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dar de alta en el Portal</h4>
		  <h5 class="modal-title">{{formData.nombre2}} ({{formData.puesto}})</h5>
        </div>
        <div class="modal-body">
		          <div >
					<?php include_once '../views/directorio/miembros/form_altaPortal.php'; ?>
				  </div>
        
      </div>
      
    </div>
  </div>
  
</div>