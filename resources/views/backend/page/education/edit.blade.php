<!-- modal -part start -->
<div class="modal fade" id="editeducationModal" role="dialog">
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
                <form class="row" id="update_educationinsert" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="col-lg-12">
                        <div class="editErors" id="editeducationErors"></div>
                    </div>
                    <!--Sub-Category form item -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>institute Name</label>
                            <input type="hidden" name="id" id="education_id">
                            <input type="text" name="institute_name" id="institutename" class="form-control" placeholder="Enter institute Name" required>
                        </div>
                        <div class="form-group">
                            <label>Degree</label>
                            <input type="text" name="institute_degree" id="institutedegree" class="form-control" placeholder="EX: Bsc in CSE" required>
                        </div>
                        <div class="form-group">
                            <label>Session</label>
                            <input type="text" name="degree_year" id="degreeyear" class="form-control" placeholder="EX: 2014-2018" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="education_description" class="form-control" id="educationdescription" cols="30" rows="4" placeholder="" required></textarea>
                        </div>
                    </div>
                    <!--Sub-Category form button -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="action" id="edit_education" value="submit">
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
