<!-- Modal -->
<div id="confirm_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure want to @yield('modal_action') this data? Please check before perform this action.</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">@yield('modal_action')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>