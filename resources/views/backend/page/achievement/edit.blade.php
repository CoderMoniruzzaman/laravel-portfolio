<!-- Edit modal part start -->
<div class="modal fade" id="editachievementModal" tabindex="-1" role="dialog" aria-labelledby="category-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Achievement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form class="row" action="{{ route('admin.achievementsite.update','edit')}}" method="post"enctype="multipart/form-data">
          @csrf
          {{method_field('put')}}
          <div class="modal-body">
            <input type="hidden" name="achi_id" id="achi_id" value="">
            <!--  form input-->

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Achievement title</label>
                    <input type="text" name="achievement_title" id="achievement_title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Upload Certificate</label>
                    <input type="file" name="achievement_image" class="form-control" >
                    <img id="myachiImage" class="img-fuild pt-2" src="" alt="" width="100">
                </div>
                <div class="form-group">
                    <label>Say something</label>
                    <textarea name="achievement_description" id="achievement_description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Achievement Certificate link</label>
                    <input type="text" name="achievement_url" id="achievement_url" class="form-control">
                </div>
            </div>
            <!--  form submit button -->
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="button-one" >Update</button>
              </div>
            </div>
          </div>
        </form>
        </div>
    </div>
  </div>
<!-- Edit modal part End -->
