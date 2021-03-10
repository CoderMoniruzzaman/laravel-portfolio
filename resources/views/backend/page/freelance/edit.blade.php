<!-- Edit modal part start -->
<div class="modal fade" id="editfreelancesiteModal" tabindex="-1" role="dialog" aria-labelledby="category-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Freelance Site</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form class="row" action="{{ route('admin.freelanceesite.update','edit')}}" method="post"enctype="multipart/form-data">
          @csrf
          {{method_field('put')}}
          <div class="modal-body">
            <input type="hidden" name="fee_id" id="fee_id" value="">
            <!--  form input-->
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Freelance site name</label>
                    <input type="text" name="feelancesite_name" id="feelancesite_name" class="form-control">
                </div>
            </div>
            <!--  form input-->
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Freelance site icon</label>
                    <input type="file" name="feelancesite_image" id="feelancesite_image" class="form-control ">
                    <img id="myImage" class="img-fuild pt-2" src="" alt="" width="100">
                </div>
            </div>
             <!-- form input-->
             <div class="col-lg-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="feelancesite_description" id="feelancesite_description" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Freelance site Url</label>
                    <input type="text" name="freelance_url" id="freelance_url" class="form-control" placeholder="Enter Freelance site url" required>
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
