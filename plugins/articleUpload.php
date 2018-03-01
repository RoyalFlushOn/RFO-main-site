<script>
    $(document).ready(function() {
        $('#hdLnErr').text(hdLnErr);
        $('#artFlErr').text(artFlErr);
        $('#thmbErr').text(thmbErr);
        $('#tagErr').text(tagErr);

        if(headline.length > 0 ){
            $('#headline').val(headline);
        }

        if(tagline.length > 0){
            $('#taglineTxtBx').val(tagline);
        }
        
    });
</script>

<div class="form-group">
        <input type="hidden" class="form-control" id="form" name="form" value="upload">
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="headline">Headline</label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="headline" name="headline" placeholder="Add headline here" value="<?php echo $headline; ?>">
        <label id="hdLnErr" name="hdLnErr" class="control-label text-warning small" ></label>
    </div>
    
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="artFile" id="artFileLbl">Article Content - </br> (Upload .HTML files only)</label> 
    <div class="col-md-6">
        <input type="file" name="file[]" class="form-control-file" onchange="articleFilecheck(this)">
        <img src="images/site-images/file-uploads/appbar.page.check.png" class="img" id="artFileUpload" hidden="true">
        <label id="artFlErr"  name="artFlErr" class="control-label text-warning small"></label>
    </div>
    
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="thmbnlPic" id="thmbnlPicLbl">Thumbnail</label> 
    <div class="col-md-6">
        <input type="file" name="file[]" class="form-control-file" onchange="articleImgcheck(this)">
        <label id="thmbErr" name="thmbErr" class="control-label text-warning small"></label>
    </div>
    
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="taglineTxtBx">Tag Line</label>
    <div class="col-md-6">
        <textarea class="form-control" id="taglineTxtBx" placeholder="Preview text ie tagline here"
                        name="taglineTxtBx" value=""></textarea>
        <label  id="tagErr" name="tagErr" class="control label text-warning "></label>
    </div>
    
</div>

