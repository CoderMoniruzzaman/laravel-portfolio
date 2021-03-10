<!-- modal -part start -->
<div class="modal fade" id="editserviceModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
            {{-- <div class="alert alert-danger" style="display:none"></div> --}}
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--Sub-Category insert form -->
                <form class="row" id="update_serviceinsert" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="col-lg-12">
                        <div class="editErors" id="editserviceErors"></div>
                    </div>
                    <!--Sub-Category form item -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Service Name</label>
                            <input type="hidden" name="id" id="service_id">
                            <input type="text" name="service_name" id="servicename" class="form-control" required>
                        </div>
                    </div>

                    <!--Sub-Category form item -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Service Icon</label>
                            <input type="text" name="icon" id="serviceicon" class="form-control" required>
                        </div>
                    </div>
                     <!--Sub-Category form item -->
                     <div class="col-lg-12">
                        <div class="form-group">
                            <label>Service description</label>
                            <textarea type="text" name="service_description" id="servicedescription" class="form-control" required rows="4"></textarea>
                        </div>
                    </div>
                    <!--Sub-Category form button -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="action" id="edit_serviceactions" value="submit">
                            <input type="submit" class="button-one" value="submit">
                        </div>
                    </div>
                </form>
                <!--Sub-Category form end -->
            </div>
        </div>
    </div>
  </div>
<!-- modal -part End -->
