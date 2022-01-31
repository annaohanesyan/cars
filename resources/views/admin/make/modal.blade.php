<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('updatemake') }}">
        @csrf
        <div class="modal-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationServer01">Make name</label>
                    <input type="text" class="form-control is-valid" id="make_name" name="make_name" placeholder="Make name">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer02">Country</label>
                    <input type="text" class="form-control is-valid" id="country" name="country" placeholder="Country">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="hidden" class="form-control is-valid" id="id" name="id">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>