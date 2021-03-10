<!-- Edit modal part start -->
<div class="modal fade" id="editresearchModal" tabindex="-1" role="dialog" aria-labelledby="category-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Research</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form class="row" action="{{ route('admin.researchsite.update','edit')}}" method="post"enctype="multipart/form-data">
          @csrf
          {{method_field('put')}}
          <div class="modal-body">
            <input type="hidden" name="re_id" id="re_id" value="">
            <!--  form input-->
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Research title</label>
                    <input type="text" name="research_title" id="research_title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Say something</label>
                    <textarea name="research_description" id="research_description" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Research publication link site</label>
                    <input type="text" name="research_publication_link" id="research_publication_link" class="form-control">
                </div>
                <div class="form-group">
                    <label>Research project url</label>
                    <input type="text" name="research_project_url" id="research_project_url" class="form-control">
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
