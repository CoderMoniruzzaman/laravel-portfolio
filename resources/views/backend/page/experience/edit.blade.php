<!-- modal -part start -->
<div class="modal fade" id="editexperienceModal" role="dialog">
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
                <form class="row" id="update_experienceinsert" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="col-lg-12">
                        <div class="editErors" id="editexperienceErors"></div>
                    </div>
                    <!--Sub-Category form item -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="hidden" name="id" id="exp_id">
                            <input type="text" name="company_name" id="companyname" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="position" id="positiondata" class="form-control" placeholder="EX: Team leader" required>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="text" name="job_year" id="jobyear" class="form-control" placeholder="EX: 2014-2018" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="job_description" class="form-control" id="jobdescription" cols="30" rows="4" placeholder="" required></textarea>
                        </div>
                    </div>
                    <!--Sub-Category form button -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="action" id="edit_exp" value="submit">
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
