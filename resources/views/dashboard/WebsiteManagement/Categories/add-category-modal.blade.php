<div class="modal fade" id="category-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="categoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="welcome-heading" id="exampleModalCenterTitle" style="font-size: 17px"></h3>
                <form id="category_form">
                    @csrf
                    <div class="mt-4">
                        {{-- <input type="hidden" name="_method" value="PUT"> --}}
                        <input type="hidden" name="category_id" id="category_id">
                        <label class="label-theme" style="font-size: 140%;margin-bottom:2%">Name</label>
                        <input type="text" name="name" id="category_name" class="form-control"
                            style="border-color: #bdc8d4; height:40px;">
                        <span style="display:none;color:red;font-size: 140%;" id='name_error'></span>
                    </div>
                    {{-- border-color: #0874fc --}}
                    <div class="mt-4">
                        <label class="label-theme" style="font-size: 140%; margin-bottom: 2%">Description</label>
                        <textarea name="description" id="category_description" class="form-control" style="border-color: #bdc8d4; font-size: 140%"></textarea>

                        <span style="display:none;color:red;font-size: 140%;" id='description_error'></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-theme">
                <button type="button" onclick="closeCategoryModal()" class="btn btn-danger"
                    style="font-size: 15px;border-radius:10px" data-bs-dismiss="modal">Cancel
                </button>
                <button type="button" onclick="saveCategory()" class="btn btn-primary submit_btn"
                    style="font-size: 15px;border-radius:10px">Save</button>
            </div>
        </div>
    </div>
</div>
