<div id="mySuccess" class="modal fade">
    <div class="modal-dialog modal-success">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>              
                <h4 class="modal-title">Awesome!</h4>   
            </div>
            <div class="modal-body">
                <p class="text-center"><?= !empty($__pageSuccess) ? htmlspecialchars($__pageSuccess) : "Nothing Successfull"  ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div> 

<div id="myError" class="modal fade">
    <div class="modal-dialog modal-success modal-error">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>              
                <h4 class="modal-title">Opps!</h4>   
            </div>
            <div class="modal-body">
                <p class="text-center"><?= !empty($__pageError) ? htmlspecialchars($__pageError) : "Nothing went wrong"  ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div> 