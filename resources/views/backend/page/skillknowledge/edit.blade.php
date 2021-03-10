<!-- modal -part start -->
<div class="modal fade" id="editknowledgeskillModal" role="dialog">
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
                <form class="row" id="update_knowledgeskillinsert" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="col-lg-12">
                        <div class="editErors" id="knowledgeskillErors"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Skill name</label>
                            <input type="hidden" name="id" id="skillkno_id">
                            <input type="text" name="knowledgeskill_name" id="knowledgeskillname" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <label>Percentage</label>
                            <input type="number" name="percentage" id="percentagedata" class="form-control" placeholder="EX: 80" required>
                        </div>
                        <div class="form-group">
                            <label>Skill bar color</label>
                            <input type="text" name="skill_color" id="skillcolor" class="form-control" placeholder="EX: #4CAF50" required>
                        </div>
                    </div>
                    <!--Sub-Category form button -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="action" id="edit_knowledgeskill" value="submit">
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
