<div class="form-group">
        <input type="hidden" class="form-control" id="form" name="form" value="create">
</div>

<div class="form-group">
    <label class="control-label col-md-2" for="headline">Headline</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="headline" placeholder="Add headline here" onchange="updateArr(this,2)">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-2" for="headLnPic" id="headLnPicLbl">Title Picture</label> 
    <div class="col-md-6">
        <input type="file" name="file[]" id="headLnPic" class="form-control-file" onchange="updateArr(this,5)">
        <label><input type="checkbox" onchange="removePic()" id="headLnPicChkBx">Check to Remove</label>
    </div>
</div>