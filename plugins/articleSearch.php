<!-- <form class="form-horizontal col-md-8 col-sm-10">
    <div class="form-group">
        <label for="srchTxtBx" class="control-label col-md-2 col-md-offset-2">Search</label>
        <div class="col-md-6 col-sm-6">
            <input type="text" name="srchTxtBx" class="form-control" placeHolder="Search text" value>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2 col-md-offset-2">For:</label>
        <div class="col-md-4 col-sm-4">
           <label class="control-label col-md-2" for="hdLnChkBx">Headline</label>
           <input type="checkbox" name="hdLnChkBx" id="hdLnChkBx" class="form-conrtol">
        </div>
        <div class="col-md-4 col-sm-4">
        <label class="control-label col-md-2" for="TagChkBx">Tags</label>
           <input type="checkbox" name="TagChkBx" id="hdLnChkBx" class="form-conrtol">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-sm-4">
            <input type="submit" name="submitBtn" class="btn btn-success" value="Search">
        </div>
    </div>
</form> -->

<div class="row" id="srchRow">
    <div class="col-md-offset-2 col-md-6 ">
        <div class="input-group">
            <input type="text" name="srchTxtBx" id="srchTxtBx" class="form-control" placeHolder="Head Line...">
            <span class="input-group-btn">
                <button class="btn btn-default dropdwn-toggle"
                        type="button"
                        data-toggle="dropdown"
                        aria_haspopup="true"
                        >Headline <span class="caret"></span></button>
                <ul class="dropdown-menu" id="srchOptDrpDwn">
                    <li><a href="#" tabindex="-1">Headline</a></li>
                    <li><a href="#" tabindex="-1">Summary</a></li>
                    <li><a href="#" tabindex="-1">Author</a></li>
                    <li><a href="#" tabindex="-1">Tags</a></li>
                </ul>
                <button type="button" class="btn btn-success">Search</button>
            </span>
        </div>
        
    </div>
    
</div>
